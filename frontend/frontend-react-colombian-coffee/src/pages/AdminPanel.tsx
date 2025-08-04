import { Link } from 'react-router-dom';
import '../styles/AdminPanel.css';

const AdminPanel = () => {
  return (
    <div className="admin-panel">

      <div className="admin-header">
        <h1>Panel de Administración</h1>
        <p>Gestiona y administra todos los aspectos de tu base de datos de café.</p>
      </div>

      <h2 className="form-section-title">Formularios Disponibles</h2>
      <div className="form-cards-container">
        <div className="form-card">
          <h3>Historia de Linaje</h3>
          <p>Gestiona el origen y genealogía de las variedades de café</p>
          <Link to="/admin/add/historia" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Ubicaciones</h3>
          <p>Administra las regiones y fincas productoras</p>
          <Link to="/admin/add/ubicacion" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Tamaño de Grano</h3>
          <p>Configura las clasificaciones de tamaño del grano</p>
          <Link to="/admin/add/tamanho-grano" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Porte</h3>
          <p>Define los tipos de porte y estructura de las plantas</p>
          <Link to="/admin/add/porte" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Condiciones de Cultivo</h3>
          <p>Establece las condiciones ambientales y de cultivo</p>
          <Link to="/admin/add/condiciones" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Enfermedades</h3>
          <p>Establece las enfermedades que afectan al cultivo de café.</p>
          <Link to="/admin/add/enfermedad" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Densidad del grano</h3>
          <p>Registra la densidad física del grano de café según su estructura.</p>
          <Link to="/admin/add/densidad" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Potencial de rendimiento</h3>
          <p>Define el nivel de producción esperada por planta o hectárea.</p>
          <Link to="/admin/add/potencial-de-rendimiento" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Calidad del grano</h3>
          <p>Establece los criterios de evaluación física y sensorial del grano.</p>
          <Link to="/admin/add/calidad-de-grano" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Calidad por altitud</h3>
          <p>Relaciona la altitud de cultivo con la calidad del café producido.</p>
          <Link to="/admin/add/calidad-por-altitud" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Resistencias</h3>
          <p>Registra las resistencias naturales o genéticas frente a plagas o enfermedades.</p>
          <Link to="/admin/add/resistencias" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Datos agronómicos</h3>
          <p>Define información clave sobre el manejo y desarrollo de la planta.</p>
          <Link to="/admin/add/datos-agronomicos" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Variedad</h3>
          <p>Agrega una nueva variedad de café con sus características completas.</p>
          <Link to="/admin/add/variedad" className="add-button">+ Agregar Nuevo</Link>
        </div>

        
      </div>
    </div>
  );
};

export default AdminPanel;
