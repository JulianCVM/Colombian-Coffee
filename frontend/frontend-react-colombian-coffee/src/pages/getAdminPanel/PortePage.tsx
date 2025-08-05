import { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/GetAdmin.css';

type Porte = {
  id: number;
  porte: string;
  manejo_cultivo: string;
};

export default function Porte() {
  const [portes, setPortes] = useState<Porte[]>([]);

  useEffect(() => {
    const fetchPortes = async () => {
      try {
        const response = await axios.get('http://localhost:8080/porte');
        setPortes(response.data);
      } catch (error) {
        console.error('Error al traer portes:', error);
      }
    };

    fetchPortes();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/porte/${id}`);
      setPortes(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar porte:', error);
    }
  };

  return (
    <div className="data-card-container">
      {portes.map(porte => (
        <div className="data-card" key={porte.id}>
          <p><strong>ID:</strong> {porte.id}</p>
          <p><strong>Porte:</strong> {porte.porte}</p>
          <p><strong>Manejo del cultivo:</strong> {porte.manejo_cultivo}</p>
          <button className="delete-button" onClick={() => handleDelete(porte.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
