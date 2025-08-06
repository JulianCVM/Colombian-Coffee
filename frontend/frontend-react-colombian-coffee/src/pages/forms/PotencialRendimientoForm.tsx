import { useState, useEffect } from 'react';
import axios from 'axios';

interface Condicion {
  id: number;
  condicion: string;
}

interface FormData {
  potencial: string;
  condicion: number;
}

export default function PotencialForm() {
  const [condiciones, setCondiciones] = useState<Condicion[]>([]);
  const [formData, setFormData] = useState<FormData>({
    potencial: '',
    condicion: 0,
  });
  const token = localStorage.getItem("token");

  useEffect(() => {
    const fetchCondiciones = async () => {
      try {
        const response = await axios.get<Condicion[]>('http://localhost:8080/condicion', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        setCondiciones(response.data);
      } catch (error) {
        console.error('Error al obtener condiciones:', error);
      }
    };
    fetchCondiciones();
  }, []);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
    const { name, value } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: name === 'condicion' ? parseInt(value) : value,
    }));
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      await axios.post('http://localhost:8080/potencial', formData, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
      alert('Potencial registrado exitosamente');
    } catch (error) {
      console.error('Error al registrar potencial:', error);
      alert('Error al registrar potencial');
    }
  };

  return (
    <div className="historia-form-container">
      <h2>Registrar Potencial de Rendimiento</h2>
      <p className="subtitle">Datos relacionados con el potencial de rendimiento del café</p>
      <form className="historia-form" onSubmit={handleSubmit}>
        <div className="form-group">
          <label htmlFor="potencial">Potencial</label>
          <input
            type="text"
            id="potencial"
            name="potencial"
            value={formData.potencial}
            onChange={handleChange}
          />
        </div>
        <div className="form-group">
          <label htmlFor="condicion">Condición</label>
          <select
            id="condicion"
            name="condicion"
            value={formData.condicion}
            onChange={handleChange}
          >
            <option value={0}>Seleccione una condición</option>
            {condiciones.map((c) => (
              <option key={c.id} value={c.id}>
                {c.condicion}
              </option>
            ))}
          </select>
        </div>
        <div className="form-buttons">
          <button type="submit" className="submit-btn">Guardar</button>
        </div>
      </form>
    </div>
  );
}
