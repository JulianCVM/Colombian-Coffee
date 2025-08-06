import { useEffect, useState } from 'react';
import '../../styles/GetAdmin.css';

interface Ubicacion {
  id: number;
  departamento: string;
  clima: string;
  suelo: string;
  altitud: string;
  temperatura: string;
  practica_cultivo: string;
}


function UbicacionCard() {
  const [ubicaciones, setUbicaciones] = useState<Ubicacion[]>([]);
  const [editando, setEditando] = useState<Ubicacion | null>(null);
  const [formData, setFormData] = useState<Ubicacion>({
    id: 0,
    departamento: '',
    clima: '',
    suelo: '',
    altitud: '',
    temperatura: '',
    practica_cultivo: '',
  });

  const token = localStorage.getItem("token");

  useEffect(() => {
    fetch('http://localhost:8080/ubicacion', {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
      .then((res) => res.json())
      .then((data) => setUbicaciones(data))
      .catch((error) =>
        console.error('Error al obtener datos de ubicación:', error)
      );
  }, []);

  const handleDelete = async (id: number) => {
    try {
      const res = await fetch(`http://localhost:8080/ubicacion/${id}`, {
        method: 'DELETE',
        headers: {
          Authorization: `Bearer ${token}`
        }
      });

      if (res.ok) {
        setUbicaciones((prev) => prev.filter((ubicacion) => ubicacion.id !== id));
      } else {
        console.error('Error al eliminar');
      }
    } catch (error) {
      console.error('Error de red:', error);
    }
  };

  const handleEdit = (ubicacion: Ubicacion) => {
    setEditando(ubicacion);
    setFormData(ubicacion);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const res = await fetch(`http://localhost:8080/ubicacion/${formData.id}`, {
        method: 'PUT',
        headers: {
           'Content-Type': 'application/json',
          Authorization: `Bearer ${token}`
          },
        body: JSON.stringify(formData),
      });

      if (res.ok) {
        setUbicaciones((prev) =>
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
          <h3>Editar Ubicación</h3>
          <form onSubmit={handleSubmit}>
            <label>
              Departamento:
              <input
                type="text"
                value={formData.departamento}
                onChange={(e) => setFormData({ ...formData, departamento: e.target.value })}
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
              Altitud:
              <input
                type="text"
                value={formData.altitud}
                onChange={(e) => setFormData({ ...formData, altitud: e.target.value })}
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
            <label>
              Práctica de cultivo:
              <input
                type="text"
                value={formData.practica_cultivo}
                onChange={(e) =>
                  setFormData({ ...formData, practica_cultivo: e.target.value })
                }
              />
            </label>
            <button type="submit">Guardar cambios</button>
            <button type="button" onClick={() => setEditando(null)}>Cancelar</button>
          </form>
        </div>
      )}

      {ubicaciones.map((ubicacion) => (
        <div key={ubicacion.id} className="data-card">
          <h2>{ubicacion.departamento}</h2>
          <p><strong>Clima:</strong> {ubicacion.clima}</p>
          <p><strong>Suelo:</strong> {ubicacion.suelo}</p>
          <p><strong>Altitud:</strong> {ubicacion.altitud}</p>
          <p><strong>Temperatura:</strong> {ubicacion.temperatura}</p>
          <p><strong>Práctica de cultivo:</strong> {ubicacion.practica_cultivo}</p>
          <div className='button-group'>
            <button className="edit-button"onClick={() => handleEdit(ubicacion)}>Editar</button>
            <button className="delete-button" onClick={() => handleDelete(ubicacion.id)}>Eliminar</button>
          </div>
        </div>
      ))}
    </div>
  );
}

export default UbicacionCard;
