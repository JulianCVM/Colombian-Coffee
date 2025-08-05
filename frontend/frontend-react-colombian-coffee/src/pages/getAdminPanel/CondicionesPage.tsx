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
  const [editando, setEditando] = useState<Condicion | null>(null);
  const [formData, setFormData] = useState<Condicion>({
    id: 0,
    genetica: '',
    clima: '',
    suelo: '',
    practicas_cultivo: '',
    temperatura: '',
  });

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

  const handleEdit = (cond: Condicion) => {
    setEditando(cond);
    setFormData(cond);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const res = await axios.put(`http://localhost:8080/condicion/${formData.id}`, formData);
      if (res.status === 200) {
        setCondiciones(prev =>
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
    <div className="data-container">
      {editando && (
        <div className="edit-form">
          <h3>Editar Condición</h3>
          <form onSubmit={handleSubmit}>
            <label>
              Genética:
              <input
                type="text"
                value={formData.genetica}
                onChange={(e) => setFormData({ ...formData, genetica: e.target.value })}
              />
            </label>
            <label>
              Clima:
              <input
                type="text"
                value={formData.clima}
                onChange={(e) => setFormData({ ...formData, clima: e.target.value })}
              />
            </label>
            <label>
              Suelo:
              <input
                type="text"
                value={formData.suelo}
                onChange={(e) => setFormData({ ...formData, suelo: e.target.value })}
              />
            </label>
            <label>
              Prácticas de cultivo:
              <input
                type="text"
                value={formData.practicas_cultivo}
                onChange={(e) => setFormData({ ...formData, practicas_cultivo: e.target.value })}
              />
            </label>
            <label>
              Temperatura:
              <input
                type="text"
                value={formData.temperatura}
                onChange={(e) => setFormData({ ...formData, temperatura: e.target.value })}
              />
            </label>
            <button type="submit">Guardar cambios</button>
            <button type="button" onClick={() => setEditando(null)}>Cancelar</button>
          </form>
        </div>
      )}

      {condiciones.map(cond => (
        <div className="data-card" key={cond.id}>
          <p><strong>ID:</strong> {cond.id}</p>
          <p><strong>Genética:</strong> {cond.genetica}</p>
          <p><strong>Clima:</strong> {cond.clima}</p>
          <p><strong>Suelo:</strong> {cond.suelo}</p>
          <p><strong>Prácticas de cultivo:</strong> {cond.practicas_cultivo}</p>
          <p><strong>Temperatura:</strong> {cond.temperatura}</p>
          <div className='button-group'>
            <button className='edit-button' onClick={() => handleEdit(cond)}>Editar</button>
            <button className="delete-button" onClick={() => handleDelete(cond.id)}>Eliminar</button>
          </div>
        </div>
      ))}
    </div>
  );
}
