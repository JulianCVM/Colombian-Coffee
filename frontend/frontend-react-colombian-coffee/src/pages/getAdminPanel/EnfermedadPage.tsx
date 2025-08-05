import { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/GetAdmin.css';

type Enfermedad = {
  id: number;
  nombre: string;
  efectos: string;
  gravedad: string;
  tratamiento: string;
};

export default function Enfermedades() {
  const [enfermedades, setEnfermedades] = useState<Enfermedad[]>([]);

  useEffect(() => {
    const fetchEnfermedades = async () => {
      try {
        const response = await axios.get('http://localhost:8080/enfermedades');
        setEnfermedades(response.data);
      } catch (error) {
        console.error('Error al traer enfermedades:', error);
      }
    };

    fetchEnfermedades();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/enfermedades/${id}`);
      setEnfermedades(prev => prev.filter(e => e.id !== id));
    } catch (error) {
      console.error('Error al eliminar enfermedad:', error);
    }
  };

  return (
    <div className="data-container">
      {enfermedades.map(e => (
        <div className="data-card" key={e.id}>
          <p><strong>ID:</strong> {e.id}</p>
          <p><strong>Nombre:</strong> {e.nombre}</p>
          <p><strong>Efectos:</strong> {e.efectos}</p>
          <p><strong>Gravedad:</strong> {e.gravedad}</p>
          <p><strong>Tratamiento:</strong> {e.tratamiento}</p>
          <button className="delete-button" onClick={() => handleDelete(e.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
