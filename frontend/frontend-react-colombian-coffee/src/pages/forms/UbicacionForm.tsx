import React, { useState } from 'react';
import axios from 'axios';
import '../../styles/FormsTemplate.css'; 
import { useNavigate } from 'react-router-dom';


const UbicacionForm = () => {
  const [departamento, setDepartamento] = useState('');
  const [clima, setClima] = useState('');
  const [suelo, setSuelo] = useState('');
  const [altitud, setAltitud] = useState('');
  const [temperatura, setTemperatura] = useState('');
  const [practicaCultivo, setPracticaCultivo] = useState('');

  const navigate = useNavigate();
  
  const handleCancel = () => {
    navigate('/add'); 
  };
  
  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();

    try {
      const response = await axios.post('http://localhost:8080/ubicacion', {
        departamento,
        clima,
        suelo,
        altitud,
        temperatura,
        practica_cultivo: practicaCultivo
      });
      alert(response.data.message);
    } catch (error) {
      console.error('Error al enviar datos:', error);
      alert('Hubo un error al enviar los datos');
    }
  };

  return (
    <div className="historia-form-container">
      <h2>🌍 Ubicación y Ambiente</h2>
      <p className="subtitle">
        Ingresa los datos geográficos, climáticos y de cultivo de la variedad de café.
      </p>

      <form onSubmit={handleSubmit} className="historia-form">
        <div className="form-group">
          <label>Departamento *</label>
          <input
            type="text"
            value={departamento}
            onChange={(e) => setDepartamento(e.target.value)}
            placeholder="ej. Huila"
            required
          />
        </div>

        <div className="form-group">
          <label>Clima *</label>
          <input
            type="text"
            value={clima}
            onChange={(e) => setClima(e.target.value)}
            placeholder="ej. Tropical de montaña"
            required
          />
        </div>

        <div className="form-group">
          <label>Tipo de Suelo *</label>
          <input
            type="text"
            value={suelo}
            onChange={(e) => setSuelo(e.target.value)}
            placeholder="ej. Franco arcilloso"
            required
          />
        </div>

        <div className="form-group">
          <label>Altitud *</label>
          <input
            type="text"
            value={altitud}
            onChange={(e) => setAltitud(e.target.value)}
            placeholder="ej. 1,200 - 1,800 msnm"
            required
          />
        </div>

        <div className="form-group">
          <label>Temperatura *</label>
          <input
            type="text"
            value={temperatura}
            onChange={(e) => setTemperatura(e.target.value)}
            placeholder="ej. 18-22°C"
            required
          />
        </div>

        <div className="form-group">
          <label>Práctica de Cultivo *</label>
          <input
            type="text"
            value={practicaCultivo}
            onChange={(e) => setPracticaCultivo(e.target.value)}
            placeholder="ej. Cultivo en sombra parcial"
            required
          />
        </div>

        <div className="form-buttons">
          <button type="button" className="cancel-btn" onClick={handleCancel}>
            Cancelar
          </button>
          <button type="submit" className="submit-btn">
            📍 Guardar Ubicación
          </button>
        </div>
      </form>
    </div>
  );
};

export default UbicacionForm;
