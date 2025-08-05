import { useEffect, useState } from 'react';
import axios from 'axios';

type DatosAgronomicos = {
  id: number;
  tiempo_cosecha: string;
  maduracion: string;
  nutricion: string;
  densidad_de_siembra: number;
};

export default function DatosAgronomicosComponent() {
  const [datos, setDatos] = useState<DatosAgronomicos[]>([]);
  const [editando, setEditando] = useState<DatosAgronomicos | null>(null);
  const [formData, setFormData] = useState<DatosAgronomicos>({
    id: 0,
    tiempo_cosecha: '',
    maduracion: '',
    nutricion: '',
    densidad_de_siembra: 0,
  });

  useEffect(() => {
    const fetchDatosAgronomicos = async () => {
      try {
        const response = await axios.get('http://localhost:8080/datos_agronomicos');
        setDatos(response.data);
      } catch (error) {
        console.error('Error al traer datos_agronomicos:', error);
      }
    };

    fetchDatosAgronomicos();
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/datos_agronomicos/${id}`);
      setDatos(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar:', error);
    }
  };

  const handleEdit = (item: DatosAgronomicos) => {
    setEditando(item);
    setFormData(item);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const res = await axios.put(`http://localhost:8080/datos_agronomicos/${formData.id}`, formData);
      if (res.status === 200) {
        setDatos(prev => prev.map(d => d.id === formData.id ? formData : d));
        setEditando(null);
      } else {
        console.error('Error al actualizar datos agronómicos');
      }
    } catch (error) {
      console.error('Error en la solicitud PUT:', error);
    }
  };

  return (
    <div className="data-card-container">
      {editando && (
        <div className="edit-form">
          <h3>Editar Datos Agronómicos</h3>
          <form onSubmit={handleSubmit}>
            <label>
              Tiempo de cosecha:
              <input
                type="text"
                value={formData.tiempo_cosecha}
                onChange={(e) => setFormData({ ...formData, tiempo_cosecha: e.target.value })}
              />
            </label>
            <label>
              Maduración:
              <input
                type="text"
                value={formData.maduracion}
                onChange={(e) => setFormData({ ...formData, maduracion: e.target.value })}
              />
            </label>
            <label>
              Nutrición:
              <input
                type="text"
                value={formData.nutricion}
                onChange={(e) => setFormData({ ...formData, nutricion: e.target.value })}
              />
            </label>
            <label>
              Densidad de siembra:
              <input
                type="number"
                value={formData.densidad_de_siembra}
                onChange={(e) => setFormData({ ...formData, densidad_de_siembra: Number(e.target.value) })}
              />
            </label>
            <button type="submit">Guardar cambios</button>
            <button type="button" onClick={() => setEditando(null)}>Cancelar</button>
          </form>
        </div>
      )}

      {datos.map(item => (
        <div className="data-card" key={item.id}>
          <p><strong>ID:</strong> {item.id}</p>
          <p><strong>Tiempo de cosecha:</strong> {item.tiempo_cosecha}</p>
          <p><strong>Maduración:</strong> {item.maduracion}</p>
          <p><strong>Nutrición:</strong> {item.nutricion}</p>
          <p><strong>Densidad de siembra:</strong> {item.densidad_de_siembra}</p>
          <button onClick={() => handleEdit(item)}>Editar</button>
          <button className="delete-button" onClick={() => handleDelete(item.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}
