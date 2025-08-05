import { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/GetAdmin.css';

type CalidadAltitud = {
  id: number;
  ubicacion: number;
  calidad: string;
};

export default function CalidadAltitud() {
  const [calidades, setCalidades] = useState<CalidadAltitud[]>([]);
  const [editando, setEditando] = useState<CalidadAltitud | null>(null);
  const [formData, setFormData] = useState<CalidadAltitud>({ id: 0, ubicacion: 0, calidad: '' });


  const handleEdit = (calidad: CalidadAltitud) => {
    setEditando(calidad);
    setFormData(calidad);
  };
  

  useEffect(() => {
    const fetchCalidades = async () => {
      try {
        const response = await axios.get('http://localhost:8080/calidadAlt');
        setCalidades(response.data);
      } catch (error) {
        console.error('Error al traer calidad_altitud:', error);
      }
    };

    fetchCalidades();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/calidadAlt/${id}`);
      setCalidades(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar:', error);
    }
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      await axios.put(`http://localhost:8080/calidad_altitud/${formData.id}`, formData);
      setCalidades(prev =>
        prev.map(item => item.id === formData.id ? formData : item)
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
          <h3>Editar Calidad</h3>
          <form onSubmit={handleSubmit}>
            <label>
              Ubicación (ID):
              <input
              type="number"
              value={formData.ubicacion}
              onChange={(e) => setFormData({ ...formData, ubicacion: Number(e.target.value) })}
              />
            </label>
            <label>
              Calidad:
              <input
                type="text"
                value={formData.calidad}
                onChange={(e) => setFormData({ ...formData, calidad: e.target.value })}
              />
            </label>
            <button type="submit">Guardar cambios</button>
            <button type="button" onClick={() => setEditando(null)}>Cancelar</button>
          </form>
  </div>
)}

      {calidades.map(calidad => (
        <div className="data-card" key={calidad.id}>
          <p><strong>ID:</strong> {calidad.id}</p>
          <p><strong>Ubicación (ID):</strong> {calidad.ubicacion}</p>
          <p><strong>Calidad:</strong> {calidad.calidad}</p>
          <div className='button-group'>
            <button className='edit-button' onClick={() => handleEdit(calidad)}>Editar</button>
            <button className='delete-button' onClick={() => handleDelete(calidad.id)}>Eliminar</button>
          </div>
    </div>
    
))}

    </div>
  );
}
