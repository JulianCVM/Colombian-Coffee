import { useEffect, useState } from 'react';
import axios from 'axios';

type Resistencia = {
  id: number;
  tipo: string;
  calidad_grano: number;
  enfermedad: number;
};

export default function Resistencias() {
  const [resistencias, setResistencias] = useState<Resistencia[]>([]);

  useEffect(() => {
    const fetchResistencias = async () => {
      try {
        const response = await axios.get('http://localhost:8080/resistencias');
        setResistencias(response.data);
      } catch (error) {
        console.error('Error al traer resistencias:', error);
      }
    };

    fetchResistencias();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/resistencias/${id}`);
      setResistencias(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar:', error);
    }
  };

  return (
    <div className="data-container">
      {resistencias.map(resistencia => (
        <div className="data-card" key={resistencia.id}>
          <p><strong>ID:</strong> {resistencia.id}</p>
          <p><strong>Tipo:</strong> {resistencia.tipo}</p>
          <p><strong>Calidad Grano (ID):</strong> {resistencia.calidad_grano}</p>
          <p><strong>Enfermedad (ID):</strong> {resistencia.enfermedad}</p>
          <button className="delete-button" onClick={() => handleDelete(resistencia.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
