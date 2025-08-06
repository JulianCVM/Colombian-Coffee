import React, { useState } from 'react';
import axios from 'axios';
import '../../styles/FormsTemplate.css';
import { useNavigate } from 'react-router-dom';

const EnfermedadesForm = () => {
  const [nombre, setNombre] = useState('');
  const [efectos, setEfectos] = useState('');
  const [gravedad, setGravedad] = useState('');
  const [tratamiento, setTratamiento] = useState('');
  const navigate = useNavigate();

  const handleCancel = () => {
    navigate("/admin");
  };
  const token = localStorage.getItem("token");

  const capitalizar = (texto: string) => {
    return texto
      .toLowerCase()
      .replace(/[_\s]+/g, ' ')
      .replace(/\b\w/g, (char) => char.toUpperCase());
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://localhost:8080/enfermedad', {
        nombre,
        efectos,
        gravedad,
        tratamiento
      }, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
      alert(response.data.message);
    } catch (error) {
      console.error('Error al enviar datos:', error);
      alert('Hubo un error al enviar los datos');
    }
  };

  return (
    <div className="historia-form-container">
      <h2>🦠 Enfermedades del Café</h2>
      <p className="subtitle">
        Ingresa información sobre enfermedades que afectan esta variedad.
      </p>

      <form onSubmit={handleSubmit} className="historia-form">
        <div className="form-group">
          <label>Nombre *</label>
          <input
            type="text"
            value={nombre}
            onChange={(e) => setNombre(capitalizar(e.target.value))}
            placeholder="ej. Roya, Antracnosis"
            required
          />
        </div>

        <div className="form-group">
          <label>Efectos *</label>
          <input
            type="text"
            value={efectos}
            onChange={(e) => setEfectos(capitalizar(e.target.value))}
            placeholder="ej. Defoliación, pérdida de calidad"
            required
          />
        </div>

        <div className="form-group">
          <label>Gravedad *</label>
          <input
            type="text"
            value={gravedad}
            onChange={(e) => setGravedad(capitalizar(e.target.value))}
            placeholder="ej. Alta, Media, Baja"
            required
          />
        </div>

        <div className="form-group">
          <label>Tratamiento *</label>
          <input
            type="text"
            value={tratamiento}
            onChange={(e) => setTratamiento(capitalizar(e.target.value))}
            placeholder="ej. Fungicida, poda sanitaria"
            required
          />
        </div>

        <div className="form-buttons">
          <button type="button" className="cancel-btn" onClick={handleCancel}>
            Cancelar
          </button>

          <button type="submit" className="submit-btn">
            💾 Guardar Enfermedad
          </button>
        </div>
      </form>
    </div>
  );
};

export default EnfermedadesForm;
