import { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/GetAdmin.css';

type Condicion = {
  id: number;
  genetica: string;
  clima: string;
  suelo: string;
  practicas_cultivo: string;
  temperatura: string;
};

export default function Condiciones() {
  const [condiciones, setCondiciones] = useState<Condicion[]>([]);

  useEffect(() => {
    const fetchCondiciones = async () => {
      try {
        const response = await axios.get('http://localhost:8080/condicion');
        setCondiciones(response.data);
      } catch (error) {
        console.error('Error al traer condiciones:', error);
      }
    };

    fetchCondiciones();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/condicion/${id}`);
      setCondiciones(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar:', error);
    }
  };

  return (
    <div className="data-card-container">
      {condiciones.map(cond => (
        <div className="data-card" key={cond.id}>
          <p><strong>ID:</strong> {cond.id}</p>
          <p><strong>Genética:</strong> {cond.genetica}</p>
          <p><strong>Clima:</strong> {cond.clima}</p>
          <p><strong>Suelo:</strong> {cond.suelo}</p>
          <p><strong>Prácticas de cultivo:</strong> {cond.practicas_cultivo}</p>
          <p><strong>Temperatura:</strong> {cond.temperatura}</p>
          <button className="delete-button" onClick={() => handleDelete(cond.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
