import React, { useState } from 'react';
import axios from 'axios';
import '../../styles/FormsTemplate.css';
import { useNavigate } from 'react-router-dom';

const TamanhoGranoForm = () => {
  const [tamanho, setTamanho] = useState('');
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
      const response = await axios.post('http://localhost:8080/tamanho', {
        tamanho
      });
      alert(response.data.message);
    } catch (error) {
      console.error('Error al enviar datos:', error);
      alert('Hubo un error al enviar los datos');
    }
  };

  return (
    <div className="historia-form-container">
      <h2>📏 Tamaño de Grano</h2>
      <p className="subtitle">
        Ingresa el tamaño característico del grano de café.
      </p>

      <form onSubmit={handleSubmit} className="historia-form">
        <div className="form-group">
          <label>Tamaño *</label>
          <input
            type="text"
            value={tamanho}
            onChange={(e) => setTamanho(capitalizar(e.target.value))}
            placeholder="ej. Grande, medio, pequeño"
            required
          />
        </div>

        <div className="form-buttons">
          <button type="button" className="cancel-btn" onClick={handleCancel}>
            Cancelar
          </button>

          <button type="submit" className="submit-btn">
            💾 Guardar Tamaño
          </button>
        </div>
      </form>
    </div>
  );
};

export default TamanhoGranoForm;
