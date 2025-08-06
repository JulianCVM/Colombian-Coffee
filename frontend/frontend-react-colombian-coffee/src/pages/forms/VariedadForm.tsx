import React, { useEffect, useState } from 'react';
import axios from 'axios';
import '../../styles/FormsTemplate.css';
import { useNavigate } from 'react-router-dom';


interface Porte {
  id: number;
  tipo: string;
}

interface TamanhoGrano {
  id: number;
  tamanho: string;
}

interface PotencialRendimiento {
  id: number;
  potencial: string;
}

interface CalidadAltitud {
  id: number;
  calidad: string;
}

interface Resistencia {
  id: number;
  tipo: string;
}

interface DatosAgronomicos {
  id: number;
}

interface HistoriaLinaje {
  id: number;
  origen: string;
}
const token = localStorage.getItem("token");

const VariedadForm = () => {
  const [nombreComun, setNombreComun] = useState('');
  const [nombreCientifico, setNombreCientifico] = useState('');
  const [descripcionGeneral, setDescripcionGeneral] = useState('');
  const [porte, setPorte] = useState('');
  const [tamanhoGrano, setTamanhoGrano] = useState('');
  const [altitudOptima, setAltitudOptima] = useState('');
  const [potencial, setPotencial] = useState('');
  const [calidadAltitud, setCalidadAltitud] = useState('');
  const [resistencia, setResistencia] = useState('');
  const [datosAgronomicos, setDatosAgronomicos] = useState('');
  const [historia, setHistoria] = useState('');


  const [porteOptions, setPorteOptions] = useState<Porte[]>([]);
  const [granoOptions, setGranoOptions] = useState<TamanhoGrano[]>([]);
  const [potencialOptions, setPotencialOptions] = useState<PotencialRendimiento[]>([]);
  const [calidadOptions, setCalidadOptions] = useState<CalidadAltitud[]>([]);
  const [resistenciaOptions, setResistenciaOptions] = useState<Resistencia[]>([]);
  const [agronomicosOptions, setAgronomicosOptions] = useState<DatosAgronomicos[]>([]);
  const [historiaOptions, setHistoriaOptions] = useState<HistoriaLinaje[]>([]);

  const navigate = useNavigate();

  useEffect(() => {
    const fetchOptions = async () => {
      try {
        const [
          porteRes,
          granoRes,
          potencialRes,
          calidadRes,
          resistenciaRes,
          agronomicosRes,
          historiaRes
        ] = await Promise.all([
          axios.get<Porte[]>('http://localhost:8080/porte', {
            headers: {
              Authorization: `Bearer ${token}`
            }
          }),
          axios.get<TamanhoGrano[]>('http://localhost:8080/tamanho', {
            headers: {
              Authorization: `Bearer ${token}`
            }
          }),
          axios.get<PotencialRendimiento[]>('http://localhost:8080/potencial', {
            headers: {
              Authorization: `Bearer ${token}`
            }
          }),
          axios.get<CalidadAltitud[]>('http://localhost:8080/calidadAlt', {
            headers: {
              Authorization: `Bearer ${token}`
            }
          }),
          axios.get<Resistencia[]>('http://localhost:8080/resistencias', {
            headers: {
              Authorization: `Bearer ${token}`
            }
          }),
          axios.get<DatosAgronomicos[]>('http://localhost:8080/datoAgro', {
            headers: {
              Authorization: `Bearer ${token}`
            }
          }),
          axios.get<HistoriaLinaje[]>('http://localhost:8080/HistoriaLinaje', {
            headers: {
              Authorization: `Bearer ${token}`
            }
          })
        ]);

        setPorteOptions(porteRes.data);
        setGranoOptions(granoRes.data);
        setPotencialOptions(potencialRes.data);
        setCalidadOptions(calidadRes.data);
        setResistenciaOptions(resistenciaRes.data);
        setAgronomicosOptions(agronomicosRes.data);
        setHistoriaOptions(historiaRes.data);
      } catch (error) {
        console.error('Error al cargar opciones:', error);
      }
    };

    fetchOptions();
  }, []);

  const handleCancel = () => {
    navigate('/admin');
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const res = await axios.post('http://localhost:8080/variedad', {
        nombre_comun: nombreComun,
        nombre_cientifico: nombreCientifico,
        descripcion_general: descripcionGeneral,
        porte: parseInt(porte),
        tamanho_del_grano: parseInt(tamanhoGrano),
        altitud_optima_siembra: parseFloat(altitudOptima),
        potencial_de_rendimiento: parseInt(potencial),
        calidad_grano_altitud: parseInt(calidadAltitud),
        resistencia: parseInt(resistencia),
        datos_agronomicos: parseInt(datosAgronomicos),
        historia: parseInt(historia)
      }, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
      alert(res.data.message || 'Variedad guardada correctamente');
      setNombreComun('');
      setNombreCientifico('');
      setDescripcionGeneral('');
      setPorte('');
      setTamanhoGrano('');
      setAltitudOptima('');
      setPotencial('');
      setCalidadAltitud('');
      setResistencia('');
      setDatosAgronomicos('');
      setHistoria('');
    } catch (error) {
      console.error('Error al enviar datos:', error);
      alert('Hubo un error al guardar la variedad');
    }
  };

  return (
    <div className="historia-form-container">
      <h2>🌿 Nueva Variedad</h2>
      <p className="subtitle">Ingresa la información de una nueva variedad de café.</p>

      <form onSubmit={handleSubmit} className="historia-form">
        <div className="form-group">
          <label>Nombre Común *</label>
          <input type="text" value={nombreComun} onChange={(e) => setNombreComun(e.target.value)} required />
        </div>

        <div className="form-group">
          <label>Nombre Científico *</label>
          <input type="text" value={nombreCientifico} onChange={(e) => setNombreCientifico(e.target.value)} required />
        </div>

        <div className="form-group">
          <label>Descripción General *</label>
          <textarea value={descripcionGeneral} onChange={(e) => setDescripcionGeneral(e.target.value)} required />
        </div>

        <div className="form-group">
          <label>Porte *</label>
          <select value={porte} onChange={(e) => setPorte(e.target.value)} required>
            <option value="">Selecciona un porte</option>
            {porteOptions.map(p => (
              <option key={p.id} value={p.id}>{p.tipo}</option>
            ))}
          </select>
        </div>

        <div className="form-group">
          <label>Tamaño del Grano *</label>
          <select value={tamanhoGrano} onChange={(e) => setTamanhoGrano(e.target.value)} required>
            <option value="">Selecciona un tamaño</option>
            {granoOptions.map(g => (
              <option key={g.id} value={g.id}>{g.tamanho}</option>
            ))}
          </select>
        </div>

        <div className="form-group">
          <label>Altitud Óptima de Siembra (msnm) *</label>
          <input
            type="number"
            step="0.01"
            value={altitudOptima}
            onChange={(e) => setAltitudOptima(e.target.value)}
            required
          />
        </div>

        <div className="form-group">
          <label>Potencial de Rendimiento *</label>
          <select value={potencial} onChange={(e) => setPotencial(e.target.value)} required>
            <option value="">Selecciona un potencial</option>
            {potencialOptions.map(po => (
              <option key={po.id} value={po.id}>{po.potencial}</option>
            ))}
          </select>
        </div>

        <div className="form-group">
          <label>Calidad vs Altitud *</label>
          <select value={calidadAltitud} onChange={(e) => setCalidadAltitud(e.target.value)} required>
            <option value="">Selecciona una relación</option>
            {calidadOptions.map(ca => (
              <option key={ca.id} value={ca.id}>{ca.calidad}</option>
            ))}
          </select>
        </div>

        <div className="form-group">
          <label>Resistencia *</label>
          <select value={resistencia} onChange={(e) => setResistencia(e.target.value)} required>
            <option value="">Selecciona una resistencia</option>
            {resistenciaOptions.map(re => (
              <option key={re.id} value={re.id}>{re.tipo}</option>
            ))}
          </select>
        </div>

        <div className="form-group">
          <label>Datos Agronómicos *</label>
          <select value={datosAgronomicos} onChange={(e) => setDatosAgronomicos(e.target.value)} required>
            <option value="">Selecciona un conjunto</option>
            {agronomicosOptions.map(da => (
              <option key={da.id} value={da.id}>{`ID: ${da.id}`}</option>
            ))}
          </select>
        </div>

        <div className="form-group">
          <label>Historia / Linaje *</label>
          <select value={historia} onChange={(e) => setHistoria(e.target.value)} required>
            <option value="">Selecciona una historia</option>
            {historiaOptions.map(hi => (
              <option key={hi.id} value={hi.id}>{hi.origen}</option>
            ))}
          </select>
        </div>

        <div className="form-buttons">
          <button type="button" className="cancel-btn" onClick={handleCancel}>Cancelar</button>
          <button type="submit" className="submit-btn">💾 Guardar Variedad</button>
        </div>
      </form>
    </div>
  );
};

export default VariedadForm;
