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

    const token = localStorage.getItem("token");

    if (!token) {
      alert("No se encontró el token. Por favor inicia sesión nuevamente.");
      return;
    }

    try {
      const response = await axios.post(
        'http://localhost:8080/HistoriaLinaje',
        {
          obtenor: obtenor.trim(),
          familia: familia.trim(),
          grupo: grupo.trim()
        },
        {
          headers: {
            Authorization: `Bearer ${token}`,
            "Content-Type": "application/json"
          }
        }
      );

      const message = response.data?.message || "Historia registrada correctamente.";
      alert(message);
      navigate("/admin");

    } catch (error: any) {
      console.error('Error al enviar datos:', error);
      if (axios.isAxiosError(error)) {
        alert(error.response?.data?.message || 'Error en el servidor.');
      } else {
        alert('Hubo un error al enviar los datos');
      }
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
          <label>Grupo Genético *</label>
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
