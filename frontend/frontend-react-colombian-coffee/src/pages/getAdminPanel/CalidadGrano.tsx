import { useEffect, useState } from 'react';
import axios from 'axios';

type CalidadGrano = {
  id: number;
  calidad: string;
  aroma: string;
  sabor: string;
  densidad: number;
  humedad: string;
  tueste: string;
  origen: number;
};

export default function CalidadGranoList() {
  const [calidadesGrano, setCalidadesGrano] = useState<CalidadGrano[]>([]);

  useEffect(() => {
    const fetchCalidadGrano = async () => {
      try {
        const response = await axios.get('http://localhost:8080/calidad_grano');
        setCalidadesGrano(response.data);
      } catch (error) {
        console.error('Error al traer calidad_grano:', error);
      }
    };

    fetchCalidadGrano();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/calidad_grano/${id}`);
      setCalidadesGrano(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar:', error);
    }
  };

  return (
    <div className="data-container">
      {calidadesGrano.map(grano => (
        <div className="data-card" key={grano.id}>
          <p><strong>ID:</strong> {grano.id}</p>
          <p><strong>Calidad:</strong> {grano.calidad}</p>
          <p><strong>Aroma:</strong> {grano.aroma}</p>
          <p><strong>Sabor:</strong> {grano.sabor}</p>
          <p><strong>Densidad:</strong> {grano.densidad}</p>
          <p><strong>Humedad:</strong> {grano.humedad}</p>
          <p><strong>Tueste:</strong> {grano.tueste}</p>
          <p><strong>Origen (Ubicación):</strong> {grano.origen}</p>
          <button className="delete-button" onClick={() => handleDelete(grano.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
