import React, { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/FormsTemplate.css';
import { useNavigate } from 'react-router-dom';

interface Densidad {
  id: number;
  valor_densidad: number;
}

interface Ubicacion {
  id: number;
  departamento: string;
}
const token = localStorage.getItem("token");

const CalidadGranoForm = () => {
  const [densidadOptions, setDensidadOptions] = useState<Densidad[]>([]);
  const [ubicacionOptions, setUbicacionOptions] = useState<Ubicacion[]>([]);

  const [calidad, setCalidad] = useState('');
  const [aroma, setAroma] = useState('');
  const [sabor, setSabor] = useState('');
  const [humedad, setHumedad] = useState('');
  const [tueste, setTueste] = useState('');
  const [densidad, setDensidad] = useState('');
  const [origen, setOrigen] = useState('');

  const navigate = useNavigate();

  useEffect(() => {
    const fetchOptions = async () => {
      try {
        const densidadRes = await axios.get<Densidad[]>('http://localhost:8080/densidad', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        const ubicacionRes = await axios.get<Ubicacion[]>('http://localhost:8080/ubicacion', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        setDensidadOptions(densidadRes.data);
        setUbicacionOptions(ubicacionRes.data);
      } catch (error) {
        console.error('Error cargando datos:', error);
      }
    };
    fetchOptions();
  }, []);

  const handleCancel = () => {
    navigate("/admin");
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://localhost:8080/calidadG', {
        calidad,
        aroma,
        sabor,
        humedad,
        tueste,
        densidad: parseInt(densidad, 10),
        origen: parseInt(origen, 10),
      }, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
      alert(response.data.message || 'Calidad del grano guardada correctamente');
      setCalidad('');
      setAroma('');
      setSabor('');
      setHumedad('');
      setTueste('');
      setDensidad('');
      setOrigen('');
    } catch (error) {
      console.error('Error al enviar datos:', error);
      alert('Hubo un error al enviar los datos');
    }
  };

  return (
    <div className="historia-form-container">
      <h2>🌱 Calidad del Grano</h2>
      <p className="subtitle">Características sensoriales y físicas del grano de café.</p>

      <form onSubmit={handleSubmit} className="historia-form">
        <div className="form-group">
          <label>Calidad *</label>
          <input type="text" value={calidad} onChange={(e) => setCalidad(e.target.value)} required />
        </div>

        <div className="form-group">
          <label>Aroma *</label>
          <input type="text" value={aroma} onChange={(e) => setAroma(e.target.value)} required />
        </div>

        <div className="form-group">
          <label>Sabor *</label>
          <input type="text" value={sabor} onChange={(e) => setSabor(e.target.value)} required />
        </div>

        <div className="form-group">
          <label>Humedad *</label>
          <input type="text" value={humedad} onChange={(e) => setHumedad(e.target.value)} required />
        </div>

        <div className="form-group">
          <label>Tueste *</label>
          <input type="text" value={tueste} onChange={(e) => setTueste(e.target.value)} required />
        </div>

        <div className="form-group">
          <label>Densidad *</label>
          <select value={densidad} onChange={(e) => setDensidad(e.target.value)} required>
            <option value="">Selecciona una densidad</option>
            {densidadOptions.map((d) => (
              <option key={d.id} value={d.id}>#{d.id} - {d.valor_densidad}</option>
            ))}
          </select>
        </div>

        <div className="form-group">
          <label>Origen *</label>
          <select value={origen} onChange={(e) => setOrigen(e.target.value)} required>
            <option value="">Selecciona una ubicación</option>
            {ubicacionOptions.map((u) => (
              <option key={u.id} value={u.id}>{u.departamento}</option>
            ))}
          </select>
        </div>

        <div className="form-buttons">
          <button type="button" className="cancel-btn" onClick={handleCancel}>Cancelar</button>
          <button type="submit" className="submit-btn">💾 Guardar Calidad</button>
        </div>
      </form>
    </div>
  );
};

export default CalidadGranoForm;
