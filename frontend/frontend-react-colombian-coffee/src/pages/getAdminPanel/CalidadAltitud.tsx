import { useEffect, useState } from 'react';
import axios from 'axios';

type CalidadAltitud = {
  id: number;
  ubicacion: number;
  calidad: string;
};

export default function CalidadAltitud() {
  const [calidades, setCalidades] = useState<CalidadAltitud[]>([]);

  useEffect(() => {
    const fetchCalidades = async () => {
      try {
        const response = await axios.get('http://localhost:8080/calidad_altitud');
        setCalidades(response.data);
      } catch (error) {
        console.error('Error al traer calidad_altitud:', error);
      }
    };

    fetchCalidades();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/calidad_altitud/${id}`);
      setCalidades(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar:', error);
    }
  };

  return (
    <div className="data-container">
      {calidades.map(calidad => (
        <div className="data-card" key={calidad.id}>
          <p><strong>ID:</strong> {calidad.id}</p>
          <p><strong>Ubicación (ID):</strong> {calidad.ubicacion}</p>
          <p><strong>Calidad:</strong> {calidad.calidad}</p>
          <button className="delete-button" onClick={() => handleDelete(calidad.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
