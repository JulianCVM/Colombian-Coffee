import { useEffect, useState } from 'react';
import axios from 'axios';

interface Resistencia {
  id: number;
  tipo: string;
  calidad_grano: number;
  enfermedad: number;
}

function ResistenciasCard() {
  const [resistencias, setResistencias] = useState<Resistencia[]>([]);
  const [editando, setEditando] = useState<Resistencia | null>(null);
  const [formData, setFormData] = useState<Resistencia>({
    id: 0,
    tipo: '',
    calidad_grano: 0,
    enfermedad: 0,
  });

  useEffect(() => {
    axios
      .get('http://localhost:8080/resistencias')
      .then((res) => setResistencias(res.data))
      .catch((error) => console.error('Error al obtener resistencias:', error));
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/resistencias/${id}`);
      setResistencias((prev) => prev.filter((item) => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar:', error);
    }
  };

  const handleEdit = (resistencia: Resistencia) => {
    setEditando(resistencia);
    setFormData(resistencia);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      await axios.put(
        `http://localhost:8080/resistencias/${formData.id}`,
        formData
      );

      setResistencias((prev) =>
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
          <h3>Editar Resistencia</h3>
          <form onSubmit={handleSubmit}>
            <label>
              Tipo:
              <input
                type="text"
                value={formData.tipo}
                onChange={(e) =>
                  setFormData({ ...formData, tipo: e.target.value })
                }
              />
            </label>
            <label>
              Calidad Grano (ID):
              <input
                type="number"
                value={formData.calidad_grano}
                onChange={(e) =>
                  setFormData({
                    ...formData,
                    calidad_grano: Number(e.target.value),
                  })
                }
              />
            </label>
            <label>
              Enfermedad (ID):
              <input
                type="number"
                value={formData.enfermedad}
                onChange={(e) =>
                  setFormData({
                    ...formData,
                    enfermedad: Number(e.target.value),
                  })
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

      {resistencias.map((resistencia) => (
        <div key={resistencia.id} className="data-card">
          <p><strong>ID:</strong> {resistencia.id}</p>
          <p><strong>Tipo:</strong> {resistencia.tipo}</p>
          <p><strong>Calidad Grano (ID):</strong> {resistencia.calidad_grano}</p>
          <p><strong>Enfermedad (ID):</strong> {resistencia.enfermedad}</p>
          <button onClick={() => handleEdit(resistencia)}>Editar</button>
          <button className="delete-button" onClick={() => handleDelete(resistencia.id)}>
            Eliminar
          </button>
        </div>
      ))}
    </div>
  );
}

export default ResistenciasCard;
