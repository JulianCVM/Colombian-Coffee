import { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/GetAdmin.css';

type PotencialRendimiento = {
  id: number;
  potencial: string;
  condicion: number;
};

export default function PotencialRendimientoCard() {
  const [potenciales, setPotenciales] = useState<PotencialRendimiento[]>([]);
  const [editando, setEditando] = useState<PotencialRendimiento | null>(null);
  const [formData, setFormData] = useState<PotencialRendimiento>({
    id: 0,
    potencial: '',
    condicion: 0,
  });

  useEffect(() => {
    const fetchPotenciales = async () => {
      try {
        const response = await axios.get('http://localhost:8080/potencial');
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
      setPotenciales((prev) => prev.filter((item) => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar:', error);
    }
  };

  const handleEdit = (item: PotencialRendimiento) => {
    setEditando(item);
    setFormData(item);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      await axios.put(
        `http://localhost:8080/potencial_rendimiento/${formData.id}`,
        formData
      );

      setPotenciales((prev) =>
        prev.map((item) => (item.id === formData.id ? formData : item))
      );
      setEditando(null);
    } catch (error) {
      console.error('Error al editar:', error);
    }
  };

  return (
    <div className="data-card-container">
      {editando && (
        <div className="edit-form">
          <h3>Editar Potencial de Rendimiento</h3>
          <form onSubmit={handleSubmit}>
            <label>
              Potencial:
              <input
                type="text"
                value={formData.potencial}
                onChange={(e) =>
                  setFormData({ ...formData, potencial: e.target.value })
                }
              />
            </label>
            <label>
              Condición:
              <input
                type="number"
                value={formData.condicion}
                onChange={(e) =>
                  setFormData({ ...formData, condicion: Number(e.target.value) })
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

      {potenciales.map((item) => (
        <div className="data-card" key={item.id}>
          <p><strong>ID:</strong> {item.id}</p>
          <p><strong>Potencial:</strong> {item.potencial}</p>
          <p><strong>Condición:</strong> {item.condicion}</p>
          <div className='button-group'>
            <button className='edit-button' onClick={() => handleEdit(item)}>Editar</button>
            <button className="delete-button" onClick={() => handleDelete(item.id)}>
              Eliminar
            </button>
          </div>
        </div>
      ))}
    </div>
  );
}
