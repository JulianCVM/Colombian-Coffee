import React, { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/FormsTemplate.css';
import { useNavigate } from 'react-router-dom';

interface Densidad {
  id: number;
  valor_densidad: number;
}

const DatosAgronomicosForm = () => {
  const [tiempoCosecha, setTiempoCosecha] = useState<string>('');
  const [maduracion, setMaduracion] = useState<string>('');
  const [nutricion, setNutricion] = useState<string>('');
  const [densidadSiembra, setDensidadSiembra] = useState<string>('');
  const [densidadOptions, setDensidadOptions] = useState<Densidad[]>([]);

  const navigate = useNavigate();

  useEffect(() => {
    const fetchDensidades = async () => {
      try {
        const res = await axios.get<Densidad[]>('http://localhost:8080/densidad');
        setDensidadOptions(res.data);
      } catch (error) {
        console.error('Error al cargar densidades:', error);
      }
    };
    fetchDensidades();
  }, []);

  const handleCancel = () => {
    navigate("/admin");
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://localhost:8080/datoAgro', {
        tiempo_cosecha: tiempoCosecha,
        maduracion,
        nutricion,
        densidad_de_siembra: parseInt(densidadSiembra, 10),
      });
      alert(response.data.message || 'Datos agronómicos guardados correctamente');
      setTiempoCosecha('');
      setMaduracion('');
      setNutricion('');
      setDensidadSiembra('');
    } catch (error) {
      console.error('Error al enviar datos:', error);
      alert('Hubo un error al enviar los datos');
    }
  };

  return (
    <div className="historia-form-container">
      <h2>🌱 Datos Agronómicos</h2>
      <p className="subtitle">Información sobre el cultivo y condiciones de siembra del café.</p>

      <form onSubmit={handleSubmit} className="historia-form">
        <div className="form-group">
          <label>Tiempo de Cosecha *</label>
          <input
            type="text"
            value={tiempoCosecha}
            onChange={(e) => setTiempoCosecha(e.target.value)}
            placeholder="ej. 8 meses"
            required
          />
        </div>

        <div className="form-group">
          <label>Maduración *</label>
          <input
            type="text"
            value={maduracion}
            onChange={(e) => setMaduracion(e.target.value)}
            placeholder="ej. Rápida"
            required
          />
        </div>

        <div className="form-group">
          <label>Nutrición *</label>
          <input
            type="text"
            value={nutricion}
            onChange={(e) => setNutricion(e.target.value)}
            placeholder="ej. Orgánica, NPK"
            required
          />
        </div>

        <div className="form-group">
          <label>Densidad de Siembra *</label>
          <select value={densidadSiembra} onChange={(e) => setDensidadSiembra(e.target.value)} required>
            <option value="">Selecciona una densidad</option>
            {densidadOptions.map((op) => (
              <option key={op.id} value={op.id}>
                {op.valor_densidad}
              </option>
            ))}
          </select>
        </div>

        <div className="form-buttons">
          <button type="button" className="cancel-btn" onClick={handleCancel}>Cancelar</button>
          <button type="submit" className="submit-btn">💾 Guardar Datos</button>
        </div>
      </form>
    </div>
  );
};

export default DatosAgronomicosForm;
