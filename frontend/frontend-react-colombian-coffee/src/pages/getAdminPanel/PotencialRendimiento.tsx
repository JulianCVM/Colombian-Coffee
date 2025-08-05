import { useEffect, useState } from 'react';
import axios from 'axios';

type PotencialRendimiento = {
  id: number;
  potencial: string;
  condicion: number; // o puedes expandir esto si luego haces join y traes más datos
};

export default function PotencialRendimiento() {
  const [potenciales, setPotenciales] = useState<PotencialRendimiento[]>([]);

  useEffect(() => {
    const fetchPotenciales = async () => {
      try {
        const response = await axios.get('http://localhost:8080/potencial_rendimiento');
        setPotenciales(response.data);
      } catch (error) {
        console.error('Error al traer potencial_rendimiento:', error);
      }
    };

    fetchPotenciales();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/potencial_rendimiento/${id}`);
      setPotenciales(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar:', error);
    }
  };

  return (
    <div className="data-container">
      {potenciales.map(item => (
        <div className="data-card" key={item.id}>
          <p><strong>ID:</strong> {item.id}</p>
          <p><strong>Potencial:</strong> {item.potencial}</p>
          <p><strong>Condición:</strong> {item.condicion}</p>
          <button className="delete-button" onClick={() => handleDelete(item.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
