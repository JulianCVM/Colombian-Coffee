import React, { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/FormsTemplate.css';
import { useNavigate } from 'react-router-dom';

interface Ubicacion {
  id: number;
  departamento: string;
}
const token = localStorage.getItem("token");

const CalidadAltitudForm = () => {
  const [ubicacionOptions, setUbicacionOptions] = useState<Ubicacion[]>([]);
  const [ubicacion, setUbicacion] = useState('');
  const [calidad, setCalidad] = useState('');

  const navigate = useNavigate();

  useEffect(() => {
    const fetchUbicaciones = async () => {
      try {
        const res = await axios.get<Ubicacion[]>('http://localhost:8080/ubicacion', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        setUbicacionOptions(res.data);
      } catch (error) {
        console.error('Error al cargar ubicaciones:', error);
      }
    };
    fetchUbicaciones();
  }, []);

  const handleCancel = () => {
    navigate("/admin");
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://localhost:8080/calidadAlt', {
        ubicacion: parseInt(ubicacion, 10),
        calidad,
      }, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
      alert(response.data.message || 'Calidad por altitud guardada correctamente');
      setUbicacion('');
      setCalidad('');
    } catch (error) {
      console.error('Error al enviar datos:', error);
      alert('Hubo un error al enviar los datos');
    }
  };

  return (
    <div className="historia-form-container">
      <h2>📍 Calidad por Altitud</h2>
      <p className="subtitle">Asocia una calidad general a una ubicación (altitud).</p>

      <form onSubmit={handleSubmit} className="historia-form">
        <div className="form-group">
          <label>Ubicación *</label>
          <select value={ubicacion} onChange={(e) => setUbicacion(e.target.value)} required>
            <option value="">Selecciona una ubicación</option>
            {ubicacionOptions.map((u) => (
              <option key={u.id} value={u.id}>{u.departamento}</option>
            ))}
          </select>
        </div>

        <div className="form-group">
          <label>Calidad *</label>
          <input
            type="text"
            value={calidad}
            onChange={(e) => setCalidad(e.target.value)}
            required
          />
        </div>

        <div className="form-buttons">
          <button type="button" className="cancel-btn" onClick={handleCancel}>Cancelar</button>
          <button type="submit" className="submit-btn">💾 Guardar Calidad</button>
        </div>
      </form>
    </div>
  );
};

export default CalidadAltitudForm;
