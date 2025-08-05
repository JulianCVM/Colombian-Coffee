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
  const [editando, setEditando] = useState<Densidad | null>(null);
  const [formData, setFormData] = useState<Densidad>({
    id: 0,
    porte: 0,
    tamanho_grano: 0,
    valor_densidad: 0,
  });

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

  const handleEdit = (item: Densidad) => {
    setEditando(item);
    setFormData(item);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const response = await axios.put(`http://localhost:8080/densidad/${formData.id}`, formData);
      if (response.status === 200) {
        setDensidades(prev =>
          prev.map(item => (item.id === formData.id ? formData : item))
        );
        setEditando(null);
      } else {
        console.error('Error al actualizar densidad');
      }
    } catch (error) {
      console.error('Error en PUT:', error);
    }
  };

  return (
    <div className="data-card-container">
      {editando && (
        <div className="edit-form">
          <h3>Editar Densidad</h3>
          <form onSubmit={handleSubmit}>
            <label>
              ID Porte:
              <input
                type="number"
                value={formData.porte}
                onChange={(e) => setFormData({ ...formData, porte: Number(e.target.value) })}
              />
            </label>
            <label>
              ID Tamaño Grano:
              <input
                type="number"
                value={formData.tamanho_grano}
                onChange={(e) => setFormData({ ...formData, tamanho_grano: Number(e.target.value) })}
              />
            </label>
            <label>
              Valor Densidad:
              <input
                type="number"
                value={formData.valor_densidad}
                onChange={(e) => setFormData({ ...formData, valor_densidad: Number(e.target.value) })}
              />
            </label>
            <button type="submit">Guardar cambios</button>
            <button type="button" onClick={() => setEditando(null)}>Cancelar</button>
          </form>
        </div>
      )}

      {densidades.map(densidad => (
        <div className="data-card" key={densidad.id}>
          <p><strong>ID:</strong> {densidad.id}</p>
          <p><strong>ID Porte:</strong> {densidad.porte}</p>
          <p><strong>ID Tamaño Grano:</strong> {densidad.tamanho_grano}</p>
          <p><strong>Valor Densidad:</strong> {densidad.valor_densidad}</p>
          <button onClick={() => handleEdit(densidad)}>Editar</button>
          <button className="delete-button" onClick={() => handleDelete(densidad.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
