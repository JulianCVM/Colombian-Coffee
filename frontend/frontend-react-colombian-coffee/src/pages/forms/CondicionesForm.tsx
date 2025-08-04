import React, { useState } from 'react';
import axios from 'axios';
import '../../styles/FormsTemplate.css';
import { useNavigate } from 'react-router-dom';

const CondicionesForm = () => {
  const [genetica, setGenetica] = useState('');
  const [clima, setClima] = useState('');
  const [suelo, setSuelo] = useState('');
  const [practicasCultivo, setPracticasCultivo] = useState('');
  const [temperatura, setTemperatura] = useState('');

  const navigate = useNavigate();

  const handleCancel = () => {
    navigate("/admin");
  };

  const capitalizar = (texto: string) => {
    return texto
      .toLowerCase()
      .replace(/[_\s]+/g, ' ')
      .replace(/\b\w/g, (char) => char.toUpperCase());
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://localhost:8080/condiciones', {
        genetica,
        clima,
        suelo,
        practicas_cultivo: practicasCultivo,
        temperatura
      });
      alert(response.data.message);
    } catch (error) {
      console.error('Error al enviar datos:', error);
      alert('Hubo un error al enviar los datos');
    }
  };

  return (
    <div className="historia-form-container">
      <h2>🌱 Condiciones Ambientales</h2>
      <p className="subtitle">
        Registra las condiciones de crecimiento ideales para esta variedad.
      </p>

      <form onSubmit={handleSubmit} className="historia-form">
        <div className="form-group">
          <label>Genética *</label>
          <input
            type="text"
            value={genetica}
            onChange={(e) => setGenetica(capitalizar(e.target.value))}
            placeholder="ej. Arábica Tradicional"
            required
          />
        </div>

        <div className="form-group">
          <label>Clima *</label>
          <input
            type="text"
            value={clima}
            onChange={(e) => setClima(capitalizar(e.target.value))}
            placeholder="ej. Húmedo, Templado"
            required
          />
        </div>

        <div className="form-group">
          <label>Suelo *</label>
          <input
            type="text"
            value={suelo}
            onChange={(e) => setSuelo(capitalizar(e.target.value))}
            placeholder="ej. Franco Arcilloso"
            required
          />
        </div>

        <div className="form-group">
          <label>Prácticas de Cultivo *</label>
          <input
            type="text"
            value={practicasCultivo}
            onChange={(e) => setPracticasCultivo(capitalizar(e.target.value))}
            placeholder="ej. Sombra Parcial, Poda"
            required
          />
        </div>

        <div className="form-group">
          <label>Temperatura *</label>
          <input
            type="text"
            value={temperatura}
            onChange={(e) => setTemperatura(capitalizar(e.target.value))}
            placeholder="ej. 18-22°C"
            required
          />
        </div>

        <div className="form-buttons">
          <button type="button" className="cancel-btn" onClick={handleCancel}>
            Cancelar
          </button>

          <button type="submit" className="submit-btn">
            💾 Guardar Condiciones
          </button>
        </div>
      </form>
    </div>
  );
};

export default CondicionesForm;
