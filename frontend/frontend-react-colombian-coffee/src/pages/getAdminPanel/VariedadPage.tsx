import { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/GetAdmin.css';

type Variedad = {
  id: number;
  nombre_comun: string;
  nombre_cientifico: string;
  descripcion_general: string;
  porte: string | number;
  tamanho_del_grano: string | number;
  altitud_optima_siembra: number;
  potencial_de_rendimiento: string | number;
  calidad_grano_altitud: string | number;
  resistencia: string | number;
  datos_agronomicos: string | number;
  historia: string | number;
};

export default function VariedadComponent() {
  const [variedades, setVariedades] = useState<Variedad[]>([]);

  useEffect(() => {
    const fetchVariedades = async () => {
      try {
        const response = await axios.get('http://localhost:8080/variedad');
        setVariedades(response.data);
      } catch (error) {
        console.error('Error al traer variedades:', error);
      }
    };

    fetchVariedades();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/variedad/${id}`);
      setVariedades(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar variedad:', error);
    }
  };

  return (
    <div className="data-container">
      {variedades.map(variedad => (
        <div className="data-card" key={variedad.id}>
          <p><strong>ID:</strong> {variedad.id}</p>
          <p><strong>Nombre común:</strong> {variedad.nombre_comun}</p>
          <p><strong>Nombre científico:</strong> {variedad.nombre_cientifico}</p>
          <p><strong>Descripción general:</strong> {variedad.descripcion_general}</p>
          <p><strong>Porte:</strong> {variedad.porte}</p>
          <p><strong>Tamaño del grano:</strong> {variedad.tamanho_del_grano}</p>
          <p><strong>Altitud óptima de siembra:</strong> {variedad.altitud_optima_siembra} m</p>
          <p><strong>Potencial de rendimiento:</strong> {variedad.potencial_de_rendimiento}</p>
          <p><strong>Calidad grano-altitud:</strong> {variedad.calidad_grano_altitud}</p>
          <p><strong>Resistencia:</strong> {variedad.resistencia}</p>
          <p><strong>Datos agronómicos:</strong> {variedad.datos_agronomicos}</p>
          <p><strong>Historia:</strong> {variedad.historia}</p>
          <button className="delete-button" onClick={() => handleDelete(variedad.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
