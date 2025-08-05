
import { useEffect, useState } from 'react';
import axios from 'axios';

type TamanhoGrano = {
  id: number;
  tamanho: string;
};

export default function TamanhoGrano() {
  const [tamanhos, setTamanhos] = useState<TamanhoGrano[]>([]);

  useEffect(() => {
    const fetchTamanhos = async () => {
      try {
        const response = await axios.get('http://localhost:8080/tamanho_grano');
        setTamanhos(response.data);
      } catch (error) {
        console.error('Error al traer tamanho_grano:', error);
      }
    };

    fetchTamanhos();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/tamanho_grano/${id}`);
      setTamanhos(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar:', error);
    }
  };

  return (
    <div className="data-container">
      {tamanhos.map(tamanho => (
        <div className="data-card" key={tamanho.id}>
          <p><strong>ID:</strong> {tamanho.id}</p>
          <p><strong>Tamaño:</strong> {tamanho.tamanho}</p>
          <button className="delete-button" onClick={() => handleDelete(tamanho.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
