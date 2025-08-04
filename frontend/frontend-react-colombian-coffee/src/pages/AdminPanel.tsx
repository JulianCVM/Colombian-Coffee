import { Link } from 'react-router-dom';
import '../styles/AdminPanel.css';

const AdminPanel = () => {
  const formCards = [
    {
      title: "Historia de Linaje",
      description: "Gestiona el origen y genealogía de las variedades de café",
      icon: "📜",
      color: "emerald",
      route: "/admin/add/historia",
      status: "Verde"
    },
    {
      title: "Ubicaciones", 
      description: "Administra las regiones y fincas productoras",
      icon: "📍",
      color: "orange",
      route: "/admin/add/ubicacion",
      status: "Pergamino"
    },
    {
      title: "Tamaño de Grano",
      description: "Configura las clasificaciones de tamaño del grano", 
      icon: "⚖️",
      color: "red",
      route: "/admin/add/tamanho-grano",
      status: "Seleccionado"
    },
    {
      title: "Porte",
      description: "Define los tipos de porte y estructura de las plantas",
      icon: "🌱",
      color: "emerald", 
      route: "/admin/add/porte",
      status: "En Desarrollo"
    },
    {
      title: "Condiciones de Cultivo",
      description: "Establece las condiciones ambientales y de cultivo",
      icon: "🌡️",
      color: "blue",
      route: "/admin/add/condiciones",
      status: "Verde"
    },
    {
      title: "Enfermedades",
      description: "Establece las enfermedades que afectan al cultivo de café",
      icon: "🔬",
      color: "pink",
      route: "/admin/add/enfermedad",
      status: "En Riesgo"
    },
    {
      title: "Densidad del grano", 
      description: "Registra la densidad física del grano de café según su estructura",
      icon: "⏱️",
      color: "purple",
      route: "/admin/add/densidad",
      status: "Cereza Madura"
    },
    {
      title: "Potencial de rendimiento",
      description: "Define el nivel de producción esperada por planta o hectárea",
      icon: "📈",
      color: "purple",
      route: "/admin/add/potencial-de-rendimiento",
      status: "Proyección"
    },
    {
      title: "Calidad del grano",
      description: "Establece los criterios de evaluación física y sensorial del grano", 
      icon: "⭐",
      color: "yellow",
      route: "/admin/add/calidad-de-grano",
      status: "Óptima"
    },
    {
      title: "Calidad por altitud",
      description: "Relaciona la altitud de cultivo con la calidad del café producido",
      icon: "🏔️",
      color: "indigo", 
      route: "/admin/add/calidad-por-altitud",
      status: "Calculado"
    },
    {
      title: "Resistencias",
      description: "Registra las resistencias naturales o genéticas frente a plagas",
      icon: "🛡️",
      color: "green",
      route: "/admin/add/resistencias",
      status: "Variable"
    },
    {
      title: "Datos agronómicos", 
      description: "Define información clave sobre el manejo y desarrollo de la planta",
      icon: "📊",
      color: "teal",
      route: "/admin/add/datos-agronomicos",
      status: "Diagnóstico"
    },
    {
      title: "Variedad",
      description: "Agrega una nueva variedad de café con sus características completas",
      icon: "☕",
      color: "amber",
      route: "/admin/add/variedad",
      status: "Óptima"
    }
  ];

  return (
    <div className="admin-panel">
      {/* Animated background particles */}
      <div className="background-particles">
        <div className="particle particle-1"></div>
        <div className="particle particle-2"></div>
        <div className="particle particle-3"></div>
        <div className="particle particle-4"></div>
      </div>

      <div className="admin-content">
        {/* Header Section */}
        <div className="admin-header">
          <div className="header-icon">
            <span>☕</span>
          </div>
          
          <h1>Panel de Administración</h1>
          
          <p>Gestiona y administra todos los aspectos de tu base de datos de café con nuestro sistema integral</p>
          
          <div className="header-divider"></div>
        </div>



        {/* Section Title */}  
        <div className="section-header">
          <div className="section-icon">
            <span>📋</span>
          </div>
          <h2>Formularios Disponibles</h2>
        </div>

        {/* Cards Grid */}
        <div className="form-cards-container">
          {formCards.map((card, index) => (
            <div 
              key={index}
              className={`form-card card-${card.color}`}
              style={{animationDelay: `${index * 0.1}s`}}
            >
              {/* Status badge */}
              <div className="card-status">
                <span>{card.status}</span>
              </div>

              {/* Icon */}
              <div className={`card-icon icon-${card.color}`}>
                <span>{card.icon}</span>
              </div>

              {/* Content */}
              <div className="card-content">
                <h3>{card.title}</h3>
                <p>{card.description}</p>

                {/* Action button */}
                <Link to={card.route} className={`add-button btn-${card.color}`}>
                  <span>+</span>
                  <span>Agregar Nuevo</span>
                </Link>
              </div>

              {/* Hover effect line */}
              <div className="card-hover-line"></div>
            </div>
          ))}
        </div>

        {/* Footer info */}
        <div className="admin-footer">
          <div className="footer-info">
            <span>🖥️</span>
            <span>Console</span>
          </div>
        </div>
      </div>
    </div>
  );
};

export default AdminPanel;