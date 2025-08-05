import { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/GetAdmin.css';

type HistoriaLinaje = {
  id: number;
  obtenor: string;
  familia: string;
  grupo: string;
};

export default function HistoriaLinaje() {
  const [historiaLinajes, setHistoriaLinajes] = useState<HistoriaLinaje[]>([]);

  useEffect(() => {
    const fetchHistoriaLinaje = async () => {
      try {
        const response = await axios.get('http://localhost:8080/HistoriaLinaje');
        setHistoriaLinajes(response.data);
      } catch (error) {
        console.error('Error al traer historia_linaje:', error);
      }
    };

    fetchHistoriaLinaje();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/HistoriaLinaje/${id}`);
      setHistoriaLinajes(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar:', error);
    }
  };

  return (
    <div className="data-container">
      {historiaLinajes.map(historia => (
        <div className="data-card" key={historia.id}>
          <p><strong>ID:</strong> {historia.id}</p>
          <p><strong>Obtenor:</strong> {historia.obtenor}</p>
          <p><strong>Familia:</strong> {historia.familia}</p>
          <p><strong>Grupo:</strong> {historia.grupo}</p>
          <button className="delete-button" onClick={() => handleDelete(historia.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
