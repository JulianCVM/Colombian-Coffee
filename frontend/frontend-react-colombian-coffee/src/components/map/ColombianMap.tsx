// src/components/map/ColombianMap.tsx
import React, { useEffect, useRef } from 'react';
import type { Data } from '../../api/DataInterface';
import { COLOMBIAN_DEPARTMENTS, findDepartment } from '../data/colombianDepartments';

type ColombianMapProps = {
  filteredCoffees: Data;
  onDepartmentSelect?: (department: string) => void;
};

// Declaramos las variables globales de Leaflet
declare global {
  interface Window {
    L: any;
  }
}

const ColombianMap: React.FC<ColombianMapProps> = ({ filteredCoffees, onDepartmentSelect }) => {
  const mapRef = useRef<HTMLDivElement>(null);
  const mapInstanceRef = useRef<any>(null);
  const markersRef = useRef<any[]>([]);

  // Obtener departamentos únicos de los cafés filtrados
  const getFilteredDepartments = () => {
    const departments = [...new Set(
      filteredCoffees.map(coffee => coffee.calidad_grano_altitud.ubicacion.departamento)
    )].filter(Boolean);
    
    return departments.map(dept => findDepartment(dept)).filter(Boolean);
  };

  // Contar cafés por departamento
  const getCoffeeCountByDepartment = () => {
    const counts: Record<string, number> = {};
    filteredCoffees.forEach(coffee => {
      const dept = coffee.calidad_grano_altitud.ubicacion.departamento;
      if (dept) {
        counts[dept] = (counts[dept] || 0) + 1;
      }
    });
    return counts;
  };

  // Función para generar colores únicos para cada departamento
  const getDepartmentColor = (departmentName: string) => {
    const colors = [
      '#8B4513', '#CD853F', '#A0522D', '#D2691E', '#B22222',
      '#DC143C', '#FF6347', '#FF4500', '#DAA520', '#B8860B',
      '#228B22', '#32CD32', '#6B8E23', '#9ACD32', '#20B2AA',
      '#008B8B', '#4682B4', '#1E90FF', '#6495ED', '#7B68EE'
    ];
    
    // Usar el índice del departamento para asignar un color consistente
    const index = COLOMBIAN_DEPARTMENTS.findIndex(dept => dept.name === departmentName);
    return colors[index % colors.length] || '#8B4513';
  };

  useEffect(() => {
    if (!mapRef.current) return;

    // Cargar Leaflet dinámicamente
    const loadLeaflet = async () => {
      if (!window.L) {
        // Cargar CSS
        const cssLink = document.createElement('link');
        cssLink.rel = 'stylesheet';
        cssLink.href = 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css';
        document.head.appendChild(cssLink);

        // Cargar JS
        const script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js';
        script.onload = initializeMap;
        document.head.appendChild(script);
      } else {
        initializeMap();
      }
    };

    const initializeMap = () => {
      if (mapInstanceRef.current) {
        mapInstanceRef.current.remove();
        mapInstanceRef.current = null;
      }

      // Verificar que el contenedor esté visible antes de inicializar
      if (!mapRef.current || mapRef.current.offsetWidth === 0) {
        setTimeout(initializeMap, 50);
        return;
      }

      // Inicializar el mapa centrado en Colombia
      const map = window.L.map(mapRef.current).setView([4.5709, -74.2973], 6);

      // Agregar capa base
      window.L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
      }).addTo(map);

      mapInstanceRef.current = map;
      
      // Invalidar tamaño después de un breve delay
      setTimeout(() => {
        if (mapInstanceRef.current) {
          mapInstanceRef.current.invalidateSize();
          updateMarkers();
        }
      }, 100);
    };

    loadLeaflet();

    return () => {
      if (mapInstanceRef.current) {
        mapInstanceRef.current.remove();
        mapInstanceRef.current = null;
      }
      // Limpiar la función global
      if ((window as any).selectDepartment) {
        delete (window as any).selectDepartment;
      }
    };
  }, []);

  useEffect(() => {
    if (mapInstanceRef.current) {
      updateMarkers();
    }
  }, [filteredCoffees]);

  // Nuevo useEffect para manejar el redimensionamiento cuando el mapa se vuelve visible
  useEffect(() => {
    if (mapInstanceRef.current && mapRef.current) {
      // Pequeño delay para asegurar que el DOM está listo
      const timer = setTimeout(() => {
        mapInstanceRef.current.invalidateSize();
        updateMarkers();
      }, 100);
      
      return () => clearTimeout(timer);
    }
  }, []); // Se ejecuta cuando el componente se monta

  const updateMarkers = () => {
    if (!window.L || !mapInstanceRef.current) return;

    // Limpiar marcadores existentes
    markersRef.current.forEach(marker => {
      mapInstanceRef.current.removeLayer(marker);
    });
    markersRef.current = [];

    const filteredDepartments = getFilteredDepartments();
    const coffeeCounts = getCoffeeCountByDepartment();

    filteredDepartments.forEach(department => {
      if (!department) return;

      const coffeeCount = coffeeCounts[department.name] || 0;
      const color = getDepartmentColor(department.name);

      // Crear marcador personalizado
      const marker = window.L.circleMarker([department.latitude, department.longitude], {
        radius: Math.max(8, Math.min(20, coffeeCount * 3)),
        fillColor: color,
        color: '#fff',
        weight: 2,
        opacity: 1,
        fillOpacity: 0.7
      });

      // Crear contenido del popup
      const popupContent = `
        <div style="text-align: center; min-width: 150px;">
          <h4 style="margin: 0 0 8px 0; color: ${color};">${department.name}</h4>
          <p style="margin: 4px 0;"><strong>Variedades:</strong> ${coffeeCount}</p>
          ${coffeeCount > 0 ? `<button onclick="window.selectDepartment('${department.name}')" 
            style="background: ${color}; color: white; border: none; padding: 6px 12px; 
            border-radius: 4px; cursor: pointer; margin-top: 8px;">
            Ver variedades
          </button>` : ''}
        </div>
      `;

      marker.bindPopup(popupContent);
      marker.addTo(mapInstanceRef.current);
      markersRef.current.push(marker);

      // Agregar evento click
      marker.on('click', () => {
        if (onDepartmentSelect && coffeeCount > 0) {
          onDepartmentSelect(department.name);
        }
      });
    });

    // Agregar función global para el botón del popup
    (window as any).selectDepartment = (departmentName: string) => {
      if (onDepartmentSelect) {
        onDepartmentSelect(departmentName);
      }
    };
  };

  return (
    <div className="map-container">
      <div className="map-header">
        <h3>Mapa de Departamentos Cafeteros</h3>
        <p>Departamentos con variedades filtradas: {getFilteredDepartments().length}</p>
      </div>
      <div 
        ref={mapRef} 
        style={{ 
          height: '500px', 
          width: '100%', 
          borderRadius: '8px',
          border: '2px solid #8B4513'
        }} 
      />
      <div className="map-legend">
        <h4>Departamentos con Variedades</h4>
        <div className="legend-items">
          {getFilteredDepartments().map(department => {
            if (!department) return null;
            const coffeeCount = getCoffeeCountByDepartment()[department.name] || 0;
            return (
              <div key={department.name} className="legend-item">
                <div 
                  className="legend-color" 
                  style={{ 
                    backgroundColor: getDepartmentColor(department.name),
                    width: '16px',
                    height: '16px',
                    borderRadius: '50%',
                    display: 'inline-block',
                    marginRight: '8px'
                  }}
                />
                <span>{department.name} ({coffeeCount})</span>
              </div>
            );
          })}
        </div>
      </div>
    </div>
  );
};

export default ColombianMap;