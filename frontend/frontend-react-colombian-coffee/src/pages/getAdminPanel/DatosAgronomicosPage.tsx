import { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/GetAdmin.css';

type DatosAgronomicos = {
  id: number;
  tiempo_cosecha: string;
  maduracion: string;
  nutricion: string;
  densidad_de_siembra: number;
};

export default function DatosAgronomicosComponent() {
  const [datos, setDatos] = useState<DatosAgronomicos[]>([]);

  useEffect(() => {
    const fetchDatosAgronomicos = async () => {
      try {
        const response = await axios.get('http://localhost:8080/datos_agronomicos');
        setDatos(response.data);
      } catch (error) {
        console.error('Error al traer datos_agronomicos:', error);
      }
    };

    fetchDatosAgronomicos();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/datos_agronomicos/${id}`);
      setDatos(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar:', error);
    }
  };

  return (
    <div className="data-container">
      {datos.map(item => (
        <div className="data-card" key={item.id}>
          <p><strong>ID:</strong> {item.id}</p>
          <p><strong>Tiempo de cosecha:</strong> {item.tiempo_cosecha}</p>
          <p><strong>Maduración:</strong> {item.maduracion}</p>
          <p><strong>Nutrición:</strong> {item.nutricion}</p>
          <p><strong>Densidad de siembra:</strong> {item.densidad_de_siembra}</p>
          <button className="delete-button" onClick={() => handleDelete(item.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
