import React, { useState } from 'react';
import axios from 'axios';
import '../../styles/FormsTemplate.css';
import { useNavigate } from 'react-router-dom';


const HistoriaForm = () => {
  const [obtenor, setObtenor] = useState('');
  const [familia, setFamilia] = useState('');
  const [grupo, setGrupo] = useState('');

  const navigate = useNavigate();

  const handleCancel = () => {
    navigate("/admin");
  };

  const capitalizar = (texto: string) => {
    return texto
      .toLowerCase()
      .replace(/\b\w/g, (char) => char.toUpperCase());
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();

    try {
      const response = await axios.post('http://localhost:8080/HistoriaLinaje', {
        obtenor,
        familia,
        grupo
      });
      alert(response.data.message);
    } catch (error) {
      console.error('Error al enviar datos:', error);
      alert('Hubo un error al enviar los datos');
    }
  };

  return (
    <div className="historia-form-container">
      <h2>🧬 Historia de Linaje</h2>
      <p className="subtitle">
        Ingresa los datos históricos y genéticos de la variedad de café.
      </p>

      <form onSubmit={handleSubmit} className="historia-form">
        <div className="form-group">
          <label>Obtenor *</label>
          <input
            type="text"
            value={obtenor}
            onChange={(e) => setObtenor(capitalizar(e.target.value))}
            placeholder="ej. Cenicafé"
            required
          />
        </div>

        <div className="form-group">
          <label>Familia *</label>
          <input
            type="text"
            value={familia}
            onChange={(e) => setFamilia(capitalizar(e.target.value))}
            placeholder="ej. Bourbon"
            required
          />
        </div>

        <div className="form-group">
          <label>Grupo Genético</label>
          <input
            type="text"
            value={grupo}
            onChange={(e) => setGrupo(capitalizar(e.target.value))}
            placeholder="ej. Arábica tradicional"
            required
          />
        </div>

        <div className="form-buttons">
        <button type="button" className="cancel-btn" onClick={handleCancel}>
            Cancelar
        </button>

          <button type="submit" className="submit-btn">
            💾 Guardar Historia
          </button>
        </div>
      </form>
    </div>
  );
};

export default HistoriaForm;
