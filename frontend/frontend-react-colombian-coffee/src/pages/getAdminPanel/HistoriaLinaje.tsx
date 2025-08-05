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
  const [editando, setEditando] = useState<HistoriaLinaje | null>(null);
  const [formData, setFormData] = useState<HistoriaLinaje>({
    id: 0,
    obtenor: '',
    familia: '',
    grupo: '',
  });

  useEffect(() => {
    fetchHistoriaLinaje();
  }, []);

  const fetchHistoriaLinaje = async () => {
    try {
      const response = await axios.get('http://localhost:8080/HistoriaLinaje'); // Ya ajustada
      setHistoriaLinajes(response.data);
    } catch (error) {
      console.error('Error al traer historia_linaje:', error);
    }
  };

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/HistoriaLinaje/${id}`);
      setHistoriaLinajes(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar:', error);
    }
  };

  const handleEdit = (historia: HistoriaLinaje) => {
    setEditando(historia);
    setFormData(historia);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      await axios.put(`http://localhost:8080/HistoriaLinaje/${formData.id}`, formData);
      setHistoriaLinajes(prev =>
        prev.map(item => (item.id === formData.id ? formData : item))
      );
      setEditando(null);
    } catch (error) {
      console.error('Error al actualizar historia_linaje:', error);
    }
  };

  return (
    <div className="data-card-container">
      {editando && (
        <div className="edit-form">
          <h3>Editar Historia de Linaje</h3>
          <form onSubmit={handleSubmit}>
            <label>
              Obtenor:
              <input
                type="text"
                value={formData.obtenor}
                onChange={(e) => setFormData({ ...formData, obtenor: e.target.value })}
              />
            </label>
            <label>
              Familia:
              <input
                type="text"
                value={formData.familia}
                onChange={(e) => setFormData({ ...formData, familia: e.target.value })}
              />
            </label>
            <label>
              Grupo:
              <input
                type="text"
                value={formData.grupo}
                onChange={(e) => setFormData({ ...formData, grupo: e.target.value })}
              />
            </label>
            <button type="submit">Guardar cambios</button>
            <button type="button" onClick={() => setEditando(null)}>Cancelar</button>
          </form>
        </div>
      )}

      {historiaLinajes.map(historia => (
        <div className="data-card" key={historia.id}>
          <p><strong>ID:</strong> {historia.id}</p>
          <p><strong>Obtenor:</strong> {historia.obtenor}</p>
          <p><strong>Familia:</strong> {historia.familia}</p>
          <p><strong>Grupo:</strong> {historia.grupo}</p>
          <div className='button-group'>
            <button className='edit-button' onClick={() => handleEdit(historia)}>Editar</button>
            <button className="delete-button" onClick={() => handleDelete(historia.id)}>Eliminar</button>
          </div>
        </div>
      ))}
    </div>
  );
}
