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
          <Link to="/historia" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Ubicaciones</h3>
          <p>Administra las regiones y fincas productoras</p>
          <Link to="/ubicacion" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Tamaño de Grano</h3>
          <p>Configura las clasificaciones de tamaño del grano</p>
          <Link to="/admin/tamanho-grano" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Porte</h3>
          <p>Define los tipos de porte y estructura de las plantas</p>
          <Link to="/admin/porte" className="add-button">+ Agregar Nuevo</Link>
        </div>

        <div className="form-card">
          <h3>Condiciones de Cultivo</h3>
          <p>Establece las condiciones ambientales y de cultivo</p>
          <Link to="/admin/condiciones" className="add-button">+ Agregar Nuevo</Link>
        </div>

        {/* Agrega aquí más tarjetas */}
      </div>
    </div>
  );
};

export default AdminPanel;
