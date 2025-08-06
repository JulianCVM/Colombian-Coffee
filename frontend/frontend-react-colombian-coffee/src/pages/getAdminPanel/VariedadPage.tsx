import { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/GetAdmin.css';

type Variedad = {
  id: number;
  nombre_comun: string;
  nombre_cientifico: string;
  descripcion_general: string;
  porte: string | number;
  tamanho_del_grano: string | number;
  altitud_optima_siembra: number;
  potencial_de_rendimiento: string | number;
  calidad_grano_altitud: string | number;
  resistencia: string | number;
  datos_agronomicos: string | number;
  historia: string | number;
};

const token = localStorage.getItem("token");

export default function VariedadCard() {
  const [variedades, setVariedades] = useState<Variedad[]>([]);
  const [editando, setEditando] = useState<Variedad | null>(null);
  const [formData, setFormData] = useState<Variedad>({
    id: 0,
    nombre_comun: '',
    nombre_cientifico: '',
    descripcion_general: '',
    porte: '',
    tamanho_del_grano: '',
    altitud_optima_siembra: 0,
    potencial_de_rendimiento: '',
    calidad_grano_altitud: '',
    resistencia: '',
    datos_agronomicos: '',
    historia: '',
  });

  useEffect(() => {
    axios.get('http://localhost:8080/variedad', {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })

      .then((res) => {
        console.log(res.data);
        setVariedades(res.data)})
      .catch((error) => console.error('Error al obtener variedades:', error));
  }, []);

  const handleDelete = async (id: number) => {
    try {
      await axios.delete(`http://localhost:8080/variedad/${id}`, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
      setVariedades(prev => prev.filter(item => item.id !== id));
    } catch (error) {
      console.error('Error al eliminar variedad:', error);
    }
  };

  const handleEdit = (variedad: Variedad) => {
    setEditando(variedad);
    setFormData(variedad);
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      await axios.put(`http://localhost:8080/variedad/${formData.id}`, formData, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
      setVariedades(prev =>
        prev.map(item => item.id === formData.id ? formData : item)
      );
      setEditando(null);
    } catch (error) {
      console.error('Error al actualizar variedad:', error);
    }
  };

  return (
    <div className="data-card-container">
      {editando && (
        
        <div className="edit-form">
          <h3>Editar Variedad</h3>
          <form onSubmit={handleSubmit}>
            <label>
              Nombre común:
              <input
                type="text"
                value={formData.nombre_comun}
                onChange={(e) => setFormData({ ...formData, nombre_comun: e.target.value })}
              />
            </label>
            <label>
              Nombre científico:
              <input
                type="text"
                value={formData.nombre_cientifico}
                onChange={(e) => setFormData({ ...formData, nombre_cientifico: e.target.value })}
              />
            </label>
            <label>
              Descripción general:
              <input
                type="text"
                value={formData.descripcion_general}
                onChange={(e) => setFormData({ ...formData, descripcion_general: e.target.value })}
              />
            </label>
            <label>
              Porte:
              <input
                type="text"
                value={formData.porte}
                onChange={(e) => setFormData({ ...formData, porte: e.target.value })}
              />
            </label>
            <label>
              Tamaño del grano:
              <input
                type="text"
                value={formData.tamanho_del_grano}
                onChange={(e) => setFormData({ ...formData, tamanho_del_grano: e.target.value })}
              />
            </label>
            <label>
              Altitud óptima siembra:
              <input
                type="number"
                value={formData.altitud_optima_siembra}
                onChange={(e) => setFormData({ ...formData, altitud_optima_siembra: Number(e.target.value) })}
              />
            </label>
            <label>
              Potencial de rendimiento:
              <input
                type="text"
                value={formData.potencial_de_rendimiento}
                onChange={(e) => setFormData({ ...formData, potencial_de_rendimiento: e.target.value })}
              />
            </label>
            <label>
              Calidad grano-altitud:
              <input
                type="text"
                value={formData.calidad_grano_altitud}
                onChange={(e) => setFormData({ ...formData, calidad_grano_altitud: e.target.value })}
              />
            </label>
            <label>
              Resistencia:
              <input
                type="text"
                value={formData.resistencia}
                onChange={(e) => setFormData({ ...formData, resistencia: e.target.value })}
              />
            </label>
            <label>
              Datos agronómicos:
              <input
                type="text"
                value={formData.datos_agronomicos}
                onChange={(e) => setFormData({ ...formData, datos_agronomicos: e.target.value })}
              />
            </label>
            <label>
              Historia:
              <input
                type="text"
                value={formData.historia}
                onChange={(e) => setFormData({ ...formData, historia: e.target.value })}
              />
            </label>
            <button type="submit">Guardar cambios</button>
            <button type="button" onClick={() => setEditando(null)}>Cancelar</button>
          </form>
        </div>
      )}

      {variedades.map((variedad) => (
        <div key={variedad.id} className="data-card">
          <h2>{variedad.nombre_comun}</h2>
          <p><strong>Nombre científico:</strong> {variedad.nombre_cientifico}</p>
          <p><strong>Descripción general:</strong> {variedad.descripcion_general}</p>
          <p><strong>Porte ID:</strong> {variedad.porte}</p>
          <p><strong>Tamaño del grano ID:</strong> {variedad.tamanho_del_grano}</p>
          <p><strong>Altitud óptima de siembra:</strong> {variedad.altitud_optima_siembra} m</p>
          <p><strong>Potencial de rendimiento ID:</strong> {variedad.potencial_de_rendimiento}</p>
          <p><strong>Calidad grano-altitud ID:</strong> {variedad.calidad_grano_altitud}</p>
          <p><strong>Resistencia ID:</strong> {variedad.resistencia}</p>
          <p><strong>Datos agronómicos ID:</strong> {variedad.datos_agronomicos}</p>
          <p><strong>Historia ID:</strong> {variedad.historia}</p>
          <div className='button-group'>
            <button className='edit-button' onClick={() => handleEdit(variedad)}>Editar</button>
            <button className="delete-button" onClick={() => handleDelete(variedad.id)}>Eliminar</button>
          </div>
        </div>
      ))}
    </div>
  );
}
