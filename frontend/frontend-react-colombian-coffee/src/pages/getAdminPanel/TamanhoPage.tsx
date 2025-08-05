import { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/GetAdmin.css';

type TamanhoGrano = {
  id: number;
  tamanho: string;
};

export default function TamanhoGranoCard() {
  const [tamanhos, setTamanhos] = useState<TamanhoGrano[]>([]);
  const [editando, setEditando] = useState<TamanhoGrano | null>(null);
  const [formData, setFormData] = useState<TamanhoGrano>({
    id: 0,
    tamanho: '',
  });

  useEffect(() => {
    const fetchTamanhos = async () => {
      try {
        const response = await axios.get('http://localhost:8080/tamanho');
        setTamanhos(response.data);
      } catch (error) {
        console.error('Error al traer tamanho_grano:', error);
      }
    };

    fetchTamanhos();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/tamanho/${id}`);
      setTamanhos(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar:', error);
    }
  };

  const handleEdit = (tamanho: TamanhoGrano) => {
    setEditando(tamanho);
    setFormData(tamanho);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const response = await axios.put(
        `http://localhost:8080/tamanho_grano/${formData.id}`,
        formData
      );
      if (response.status === 200) {
        setTamanhos(prev =>
          prev.map(item => (item.id === formData.id ? formData : item))
        );
        setEditando(null);
      } else {
        console.error('Error al actualizar');
      }
    } catch (error) {
      console.error('Error al editar:', error);
    }
  };

  return (
    <div className="data-card-container">
      {editando && (
        <div className="edit-form">
          <h3>Editar Tamaño de Grano</h3>
          <form onSubmit={handleSubmit}>
            <label>
              Tamaño:
              <input
                type="text"
                value={formData.tamanho}
                onChange={(e) =>
                  setFormData({ ...formData, tamanho: e.target.value })
                }
              />
            </label>
            <button type="submit">Guardar cambios</button>
            <button type="button" onClick={() => setEditando(null)}>
              Cancelar
            </button>
          </form>
        </div>
      )}

      {tamanhos.map(tamanho => (
        <div className="data-card" key={tamanho.id}>
          <p><strong>ID:</strong> {tamanho.id}</p>
          <p><strong>Tamaño:</strong> {tamanho.tamanho}</p>
          <button onClick={() => handleEdit(tamanho)}>Editar</button>
          <button className="delete-button" onClick={() => handleDelete(tamanho.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
