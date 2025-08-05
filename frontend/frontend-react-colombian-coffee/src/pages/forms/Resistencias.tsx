
import React, { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/FormsTemplate.css';
import { useNavigate } from 'react-router-dom';

interface CalidadGrano {
  id: number;
  calidad: string;
}

interface Enfermedad {
  id: number;
  nombre: string;
}

const ResistenciaForm = () => {
  const [calidadOptions, setCalidadOptions] = useState<CalidadGrano[]>([]);
  const [enfermedadOptions, setEnfermedadOptions] = useState<Enfermedad[]>([]);

  const [tipo, setTipo] = useState<string>('');
  const [calidadGrano, setCalidadGrano] = useState<string>('');
  const [enfermedad, setEnfermedad] = useState<string>('');

  const navigate = useNavigate();

  useEffect(() => {
    const fetchOptions = async () => {
      try {
        const calidadRes = await axios.get<CalidadGrano[]>('http://localhost:8080/calidadG');
        const enfermedadRes = await axios.get<Enfermedad[]>('http://localhost:8080/enfermedad');

        setCalidadOptions(calidadRes.data);
        setEnfermedadOptions(enfermedadRes.data);
      } catch (error) {
        console.error('Error al cargar opciones:', error);
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
      const response = await axios.post('http://localhost:8080/resistencias', {
        tipo,
        calidad_grano: parseInt(calidadGrano, 10),
        enfermedad: parseInt(enfermedad, 10),
      });
      alert(response.data.message || 'Resistencia guardada correctamente');
      setTipo('');
      setCalidadGrano('');
      setEnfermedad('');
    } catch (error) {
      console.error('Error al enviar datos:', error);
      alert('Hubo un error al enviar los datos');
    }
  };

  return (
    <div className="historia-form-container">
      <h2>🛡️ Resistencia</h2>
      <p className="subtitle">Relaciona la calidad del grano con las enfermedades resistentes.</p>

      <form onSubmit={handleSubmit} className="historia-form">
        <div className="form-group">
          <label>Tipo de Resistencia *</label>
          <input
            type="text"
            value={tipo}
            onChange={(e) => setTipo(e.target.value)}
            placeholder="ej. Alta, Moderada"
            required
          />
        </div>

        <div className="form-group">
          <label>Calidad del Grano *</label>
          <select value={calidadGrano} onChange={(e) => setCalidadGrano(e.target.value)} required>
            <option value="">Selecciona una calidad</option>
            {calidadOptions.map((op) => (
              <option key={op.id} value={op.id}>{op.calidad}</option>
            ))}
          </select>
        </div>

        <div className="form-group">
          <label>Enfermedad *</label>
          <select value={enfermedad} onChange={(e) => setEnfermedad(e.target.value)} required>
            <option value="">Selecciona una enfermedad</option>
            {enfermedadOptions.map((op) => (
              <option key={op.id} value={op.id}>{op.nombre}</option>
            ))}
          </select>
        </div>

        <div className="form-buttons">
          <button type="button" className="cancel-btn" onClick={handleCancel}>Cancelar</button>
          <button type="submit" className="submit-btn">💾 Guardar Resistencia</button>
        </div>
      </form>
    </div>
  );
};

export default ResistenciaForm;
