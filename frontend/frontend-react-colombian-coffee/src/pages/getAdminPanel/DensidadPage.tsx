import { useEffect, useState } from 'react';
import axios from 'axios';

type Densidad = {
  id: number;
  porte: number;
  tamanho_grano: number;
  valor_densidad: number;
};

export default function DensidadList() {
  const [densidades, setDensidades] = useState<Densidad[]>([]);

  useEffect(() => {
    const fetchDensidades = async () => {
      try {
        const response = await axios.get('http://localhost:8080/densidad');
        setDensidades(response.data);
      } catch (error) {
        console.error('Error al traer densidades:', error);
      }
    };

    fetchDensidades();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/densidad/${id}`);
      setDensidades(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar densidad:', error);
    }
  };

  return (
    <div className="data-container">
      {densidades.map(densidad => (
        <div className="data-card" key={densidad.id}>
          <p><strong>ID:</strong> {densidad.id}</p>
          <p><strong>ID Porte:</strong> {densidad.porte}</p>
          <p><strong>ID Tamaño Grano:</strong> {densidad.tamanho_grano}</p>
          <p><strong>Valor Densidad:</strong> {densidad.valor_densidad}</p>
          <button className="delete-button" onClick={() => handleDelete(densidad.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
