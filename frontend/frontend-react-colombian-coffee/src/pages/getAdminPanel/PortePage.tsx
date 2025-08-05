import { useEffect, useState } from 'react';

type Porte = {
  id: number;
  porte: string;
  manejo_cultivo: string;
};

export default function PorteCard() {
  const [portes, setPortes] = useState<Porte[]>([]);
  const [editando, setEditando] = useState<Porte | null>(null);
  const [formData, setFormData] = useState<Porte>({
    id: 0,
    porte: '',
    manejo_cultivo: '',
  });

  useEffect(() => {
    fetch('http://localhost:8080/porte')
      .then((res) => res.json())
      .then((data) => setPortes(data))
      .catch((error) =>
        console.error('Error al obtener datos de porte:', error)
      );
  }, []);

  const handleDelete = async (id: number) => {
    try {
      const res = await fetch(`http://localhost:8080/porte/${id}`, {
        method: 'DELETE',
      });

      if (res.ok) {
        setPortes((prev) => prev.filter((porte) => porte.id !== id));
      } else {
        console.error('Error al eliminar');
      }
    } catch (error) {
      console.error('Error de red:', error);
    }
  };

  const handleEdit = (porte: Porte) => {
    setEditando(porte);
    setFormData(porte);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const res = await fetch(`http://localhost:8080/porte/${formData.id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData),
      });

      if (res.ok) {
        setPortes((prev) =>
          prev.map((item) => (item.id === formData.id ? formData : item))
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
          <h3>Editar Porte</h3>
          <form onSubmit={handleSubmit}>
            <label>
              Porte:
              <input
                type="text"
                value={formData.porte}
                onChange={(e) =>
                  setFormData({ ...formData, porte: e.target.value })
                }
              />
            </label>
            <label>
              Manejo del cultivo:
              <input
                type="text"
                value={formData.manejo_cultivo}
                onChange={(e) =>
                  setFormData({ ...formData, manejo_cultivo: e.target.value })
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

      {portes.map((porte) => (
        <div key={porte.id} className="data-card">
          <h2>{porte.porte}</h2>
          <p><strong>Manejo del cultivo:</strong> {porte.manejo_cultivo}</p>
          <button onClick={() => handleEdit(porte)}>Editar</button>
          <button className="delete-button" onClick={() => handleDelete(porte.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
