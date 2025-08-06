import { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/GetAdmin.css';

type CalidadGrano = {
  id: number;
  calidad: string;
  aroma: string;
  sabor: string;
  densidad: number;
  humedad: string;
  tueste: string;
  origen: number;
};

export default function CalidadGranoCard() {
  const [calidades, setCalidades] = useState<CalidadGrano[]>([]);
  const [editando, setEditando] = useState<CalidadGrano | null>(null);
  const [formData, setFormData] = useState<CalidadGrano>({
    id: 0,
    calidad: '',
    aroma: '',
    sabor: '',
    densidad: 0,
    humedad: '',
    tueste: '',
    origen: 0,
  });

  useEffect(() => {
    const fetchData = async () => {
      try {
        const res = await axios.get('http://localhost:8080/calidadG'); // Ya queda ajustada la ruta
        setCalidades(res.data);
      } catch (error) {
        console.error('Error al traer calidad_grano:', error);
      }
    };

    fetchData();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/calidadG/${id}`);
      setCalidades(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar:', error);
    }
  };

  const handleEdit = (grano: CalidadGrano) => {
    setEditando(grano);
    setFormData(grano);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const res = await axios.put(`http://localhost:8080/calidadG/${formData.id}`, formData);

      if (res.status === 200) {
        setCalidades(prev =>
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
    <div className="data-card-card-container">
      {editando && (
        <div className="edit-form">
          <h3>Editar Calidad de Grano</h3>
          <form onSubmit={handleSubmit}>
            <label>
              Calidad:
              <input
                type="text"
                value={formData.calidad}
                onChange={(e) => setFormData({ ...formData, calidad: e.target.value })}
              />
            </label>
            <label>
              Aroma:
              <input
                type="text"
                value={formData.aroma}
                onChange={(e) => setFormData({ ...formData, aroma: e.target.value })}
              />
            </label>
            <label>
              Sabor:
              <input
                type="text"
                value={formData.sabor}
                onChange={(e) => setFormData({ ...formData, sabor: e.target.value })}
              />
            </label>
            <label>
              Densidad (ID):
              <input
                type="number"
                value={formData.densidad}
                onChange={(e) => setFormData({ ...formData, densidad: Number(e.target.value) })}
              />
            </label>
            <label>
              Humedad:
              <input
                type="text"
                value={formData.humedad}
                onChange={(e) => setFormData({ ...formData, humedad: e.target.value })}
              />
            </label>
            <label>
              Tueste:
              <input
                type="text"
                value={formData.tueste}
                onChange={(e) => setFormData({ ...formData, tueste: e.target.value })}
              />
            </label>
            <label>
              Origen (Ubicación ID):
              <input
                type="number"
                value={formData.origen}
                onChange={(e) => setFormData({ ...formData, origen: Number(e.target.value) })}
              />
            </label>
            <button type="submit">Guardar cambios</button>
            <button type="button" onClick={() => setEditando(null)}>Cancelar</button>
          </form>
        </div>
      )}

      {calidades.map((grano) => (
        <div className="data-card" key={grano.id}>
          <h2>Calidad: {grano.calidad}</h2>
          <p><strong>Aroma:</strong> {grano.aroma}</p>
          <p><strong>Sabor:</strong> {grano.sabor}</p>
          <p><strong>Densidad ID:</strong> {grano.densidad}</p>
          <p><strong>Humedad:</strong> {grano.humedad}</p>
          <p><strong>Tueste:</strong> {grano.tueste}</p>
          <p><strong>Origen (Ubicación ID):</strong> {grano.origen}</p>
          <div className='button-group'>
            <button className='edit-button' onClick={() => handleEdit(grano)}>Editar</button>
            <button className="delete-button" onClick={() => handleDelete(grano.id)}>Eliminar</button>
          </div>
        </div>
      ))}
    </div>
  );
}
