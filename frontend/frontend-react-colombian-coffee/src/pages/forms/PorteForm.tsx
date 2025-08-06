import React, { useState } from 'react';
import axios from 'axios';
import '../../styles/FormsTemplate.css';
import { useNavigate } from 'react-router-dom';

const PorteForm = () => {
  const [porte, setPorte] = useState('');
  const [manejoCultivo, setManejoCultivo] = useState('');
  const navigate = useNavigate();

  const handleCancel = () => {
    navigate("/admin");
  };

  const capitalizar = (texto: string) => {
    return texto
      .toLowerCase()
      .replace(/\b\w/g, (char) => char.toUpperCase());
  };
  const token = localStorage.getItem("token");

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://localhost:8080/porte', {
        porte,
        manejo_cultivo: manejoCultivo
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
      <h2>🌿 Porte de la Planta</h2>
      <p className="subtitle">
        Ingresa la altura y el manejo agronómico del porte de la planta.
      </p>

      <form onSubmit={handleSubmit} className="historia-form">
        <div className="form-group">
          <label>Porte *</label>
          <input
            type="text"
            value={porte}
            onChange={(e) => setPorte(capitalizar(e.target.value))}
            placeholder="ej. Alto, Medio, Bajo"
            required
          />
        </div>

        <div className="form-group">
          <label>Manejo del Cultivo *</label>
          <input
            type="text"
            value={manejoCultivo}
            onChange={(e) => setManejoCultivo(capitalizar(e.target.value))}
            placeholder="ej. Requiere podas frecuentes"
            required
          />
        </div>

        <div className="form-buttons">
          <button type="button" className="cancel-btn" onClick={handleCancel}>
            Cancelar
          </button>

          <button type="submit" className="submit-btn">
            💾 Guardar Porte
          </button>
        </div>
      </form>
    </div>
  );
};

export default PorteForm;
