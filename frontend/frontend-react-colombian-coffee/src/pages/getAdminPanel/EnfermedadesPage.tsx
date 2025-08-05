import { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/GetAdmin.css';

type Enfermedad = {
  id: number;
  nombre: string;
  efectos: string;
  gravedad: string;
  tratamiento: string;
};

export default function Enfermedades() {
  const [enfermedades, setEnfermedades] = useState<Enfermedad[]>([]);
  const [editando, setEditando] = useState<Enfermedad | null>(null);
  const [formData, setFormData] = useState<Enfermedad>({
    id: 0,
    nombre: '',
    efectos: '',
    gravedad: '',
    tratamiento: '',
  });

  useEffect(() => {
    const fetchEnfermedades = async () => {
      try {
        const response = await axios.get('http://localhost:8080/enfermedad');
        setEnfermedades(response.data);
      } catch (error) {
        console.error('Error al traer enfermedades:', error);
      }
    };

    fetchEnfermedades();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/enfermedad/${id}`);
      setEnfermedades(prev => prev.filter(e => e.id !== id));
    } catch (error) {
      console.error('Error al eliminar enfermedad:', error);
    }
  };

  const handleEdit = (enfermedad: Enfermedad) => {
    setEditando(enfermedad);
    setFormData(enfermedad);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const response = await axios.put(
        `http://localhost:8080/enfermedad/${formData.id}`,
        formData
      );
      if (response.status === 200) {
        setEnfermedades(prev =>
          prev.map(e => (e.id === formData.id ? formData : e))
        );
        setEditando(null);
      } else {
        console.error('Error al actualizar enfermedad');
      }
    } catch (error) {
      console.error('Error en PUT:', error);
    }
  };

  return (
    <div className="data-card-container">
      {editando && (
        <div className="edit-form">
          <h3>Editar Enfermedad</h3>
          <form onSubmit={handleSubmit}>
            <label>
              Nombre:
              <input
                type="text"
                value={formData.nombre}
                onChange={(e) => setFormData({ ...formData, nombre: e.target.value })}
              />
            </label>
            <label>
              Efectos:
              <input
                type="text"
                value={formData.efectos}
                onChange={(e) => setFormData({ ...formData, efectos: e.target.value })}
              />
            </label>
            <label>
              Gravedad:
              <input
                type="text"
                value={formData.gravedad}
                onChange={(e) => setFormData({ ...formData, gravedad: e.target.value })}
              />
            </label>
            <label>
              Tratamiento:
              <input
                type="text"
                value={formData.tratamiento}
                onChange={(e) => setFormData({ ...formData, tratamiento: e.target.value })}
              />
            </label>
            <button type="submit">Guardar cambios</button>
            <button type="button" onClick={() => setEditando(null)}>Cancelar</button>
          </form>
        </div>
      )}

      {enfermedades.map(e => (
        <div className="data-card" key={e.id}>
          <p><strong>ID:</strong> {e.id}</p>
          <p><strong>Nombre:</strong> {e.nombre}</p>
          <p><strong>Efectos:</strong> {e.efectos}</p>
          <p><strong>Gravedad:</strong> {e.gravedad}</p>
          <p><strong>Tratamiento:</strong> {e.tratamiento}</p>
          <div className='button-group'>
            <button className='edit-button' onClick={() => handleEdit(e)}>Editar</button>
            <button className="delete-button" onClick={() => handleDelete(e.id)}>Eliminar</button>
          </div>
        </div>
      ))}
    </div>
  );
}
