import React, { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/FormsTemplate.css';
import { useNavigate } from 'react-router-dom';

interface Porte {
  id: number;
  porte: string;
}

interface TamanhoGrano {
  id: number;
  tamanho: string;
}

const DensidadForm = () => {
  const [porteOptions, setPorteOptions] = useState<Porte[]>([]);
  const [tamanhoOptions, setTamanhoOptions] = useState<TamanhoGrano[]>([]);

  const [porte, setPorte] = useState<string>('');
  const [tamanhoGrano, setTamanhoGrano] = useState<string>('');
  const [valorDensidad, setValorDensidad] = useState<string>('');

  const navigate = useNavigate();

  useEffect(() => {
    const fetchOptions = async () => {
      try {
        const porteRes = await axios.get<Porte[]>('http://localhost:8080/porte');
        const tamanhoRes = await axios.get<TamanhoGrano[]>('http://localhost:8080/tamanho_grano');

        setPorteOptions(porteRes.data);
        setTamanhoOptions(tamanhoRes.data);
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
      const response = await axios.post('http://localhost:8080/densidad', {
        porte: parseInt(porte, 10),
        tamanho_grano: parseInt(tamanhoGrano, 10),
        valor_densidad: parseInt(valorDensidad, 10),
      });
      alert(response.data.message || 'Densidad guardada correctamente');
      // Opcional: resetear formulario
      setPorte('');
      setTamanhoGrano('');
      setValorDensidad('');
    } catch (error) {
      console.error('Error al enviar datos:', error);
      alert('Hubo un error al enviar los datos');
    }
  };

  return (
    <div className="historia-form-container">
      <h2>⚖️ Densidad</h2>
      <p className="subtitle">Relaciona el porte y el tamaño del grano con su densidad.</p>

      <form onSubmit={handleSubmit} className="historia-form">
        <div className="form-group">
          <label>Porte *</label>
          <select value={porte} onChange={(e) => setPorte(e.target.value)} required>
            <option value="">Selecciona un porte</option>
            {porteOptions.map((op) => (
              <option key={op.id} value={op.id}>{op.porte}</option>
            ))}
          </select>
        </div>

        <div className="form-group">
          <label>Tamaño de Grano *</label>
          <select value={tamanhoGrano} onChange={(e) => setTamanhoGrano(e.target.value)} required>
            <option value="">Selecciona un tamaño</option>
            {tamanhoOptions.map((op) => (
              <option key={op.id} value={op.id}>{op.tamanho}</option>
            ))}
          </select>
        </div>

        <div className="form-group">
          <label>Valor de Densidad *</label>
          <input
            type="number"
            value={valorDensidad}
            onChange={(e) => setValorDensidad(e.target.value)}
            placeholder="ej. 6"
            required
          />
        </div>

        <div className="form-buttons">
          <button type="button" className="cancel-btn" onClick={handleCancel}>Cancelar</button>
          <button type="submit" className="submit-btn">💾 Guardar Densidad</button>
        </div>
      </form>
    </div>
  );
};

export default DensidadForm;
