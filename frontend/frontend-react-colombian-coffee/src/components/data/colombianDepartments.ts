// src/data/colombianDepartments.ts
export type DepartmentCoordinates = {
  name: string;
  latitude: number;
  longitude: number;
  region: string;
};

export const COLOMBIAN_DEPARTMENTS: DepartmentCoordinates[] = [
  // Región Andina
  { name: "Antioquia", latitude: 6.2518, longitude: -75.5636, region: "Andina" },
  { name: "Boyacá", latitude: 5.4539, longitude: -73.3616, region: "Andina" },
  { name: "Caldas", latitude: 5.0689, longitude: -75.2174, region: "Andina" },
  { name: "Cundinamarca", latitude: 5.0214, longitude: -74.0508, region: "Andina" },
  { name: "Huila", latitude: 2.5358, longitude: -75.5278, region: "Andina" },
  { name: "Nariño", latitude: 1.2136, longitude: -77.2811, region: "Andina" },
  { name: "Norte de Santander", latitude: 7.8939, longitude: -72.5078, region: "Andina" },
  { name: "Quindío", latitude: 4.5389, longitude: -75.6614, region: "Andina" },
  { name: "Risaralda", latitude: 5.3158, longitude: -75.9928, region: "Andina" },
  { name: "Santander", latitude: 6.6437, longitude: -73.6516, region: "Andina" },
  { name: "Tolima", latitude: 4.0925, longitude: -75.1545, region: "Andina" },
  
  // Región Caribe
  { name: "Atlántico", latitude: 10.7964, longitude: -74.7814, region: "Caribe" },
  { name: "Bolívar", latitude: 9.5904, longitude: -75.0836, region: "Caribe" },
  { name: "Cesar", latitude: 9.3132, longitude: -73.6533, region: "Caribe" },
  { name: "Córdoba", latitude: 8.7539, longitude: -75.8814, region: "Caribe" },
  { name: "La Guajira", latitude: 11.5444, longitude: -72.9114, region: "Caribe" },
  { name: "Magdalena", latitude: 10.4139, longitude: -74.4058, region: "Caribe" },
  { name: "Sucre", latitude: 9.1619, longitude: -75.3958, region: "Caribe" },
  
  // Región Pacífica
  { name: "Cauca", latitude: 2.4817, longitude: -76.6053, region: "Pacífica" },
  { name: "Chocó", latitude: 5.6944, longitude: -76.6581, region: "Pacífica" },
  { name: "Valle del Cauca", latitude: 3.8009, longitude: -76.6413, region: "Pacífica" },
  
  // Región Orinoquía
  { name: "Arauca", latitude: 7.0897, longitude: -70.7619, region: "Orinoquía" },
  { name: "Casanare", latitude: 5.7589, longitude: -71.9542, region: "Orinoquía" },
  { name: "Meta", latitude: 4.1420, longitude: -73.6266, region: "Orinoquía" },
  { name: "Vichada", latitude: 4.4217, longitude: -69.2914, region: "Orinoquía" },
  
  // Región Amazonía
  { name: "Amazonas", latitude: -2.1889, longitude: -70.9364, region: "Amazonía" },
  { name: "Caquetá", latitude: 1.6136, longitude: -75.6058, region: "Amazonía" },
  { name: "Guainía", latitude: 2.5664, longitude: -67.9292, region: "Amazonía" },
  { name: "Guaviare", latitude: 2.1131, longitude: -72.6475, region: "Amazonía" },
  { name: "Putumayo", latitude: 0.4892, longitude: -75.3431, region: "Amazonía" },
  { name: "Vaupés", latitude: 1.2500, longitude: -70.2333, region: "Amazonía" },
  
  // Distrito Capital
  { name: "Bogotá D.C.", latitude: 4.7110, longitude: -74.0721, region: "Capital" }
];

export const getRegionColor = (region: string): string => {
  const colors: Record<string, string> = {
    "Andina": "#8B4513",      // Marrón café
    "Caribe": "#20B2AA",      // Turquesa
    "Pacífica": "#228B22",    // Verde bosque
    "Orinoquía": "#DAA520",   // Dorado
    "Amazonía": "#006400",    // Verde oscuro
    "Capital": "#DC143C"      // Rojo carmesí
  };
  return colors[region] || "#666666";
};

export const findDepartment = (departmentName: string): DepartmentCoordinates | undefined => {
  return COLOMBIAN_DEPARTMENTS.find(dept => 
    dept.name.toLowerCase().includes(departmentName.toLowerCase()) ||
    departmentName.toLowerCase().includes(dept.name.toLowerCase())
  );
};