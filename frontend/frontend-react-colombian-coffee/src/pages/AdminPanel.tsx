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
    },
    {
      title: "Ubicaciones", 
      description: "Administra las regiones y fincas productoras",
      icon: "📍",
      color: "orange",
      route: "/admin/add/ubicacion",
    },
    {
      title: "Tamaño de Grano",
      description: "Configura las clasificaciones de tamaño del grano", 
      icon: "⚖️",
      color: "red",
      route: "/admin/add/tamanho-grano",
    },
    {
      title: "Porte",
      description: "Define los tipos de porte y estructura de las plantas",
      icon: "🌱",
      color: "emerald", 
      route: "/admin/add/porte",
    },
    {
      title: "Condiciones de Cultivo",
      description: "Establece las condiciones ambientales y de cultivo",
      icon: "🌡️",
      color: "blue",
      route: "/admin/add/condiciones",
    },
    {
      title: "Enfermedades",
      description: "Establece las enfermedades que afectan al cultivo de café",
      icon: "🔬",
      color: "pink",
      route: "/admin/add/enfermedad",
    },
    {
      title: "Densidad del grano", 
      description: "Registra la densidad física del grano de café según su estructura",
      icon: "⏱️",
      color: "purple",
      route: "/admin/add/densidad",
    },
    {
      title: "Potencial de rendimiento",
      description: "Define el nivel de producción esperada por planta o hectárea",
      icon: "📈",
      color: "purple",
      route: "/admin/add/potencial-de-rendimiento",
    },
    {
      title: "Calidad del grano",
      description: "Establece los criterios de evaluación física y sensorial del grano", 
      icon: "⭐",
      color: "yellow",
      route: "/admin/add/calidad-de-grano",
    },
    {
      title: "Calidad por altitud",
      description: "Relaciona la altitud de cultivo con la calidad del café producido",
      icon: "🏔️",
      color: "indigo", 
      route: "/admin/add/calidad-por-altitud",
    },
    {
      title: "Resistencias",
      description: "Registra las resistencias naturales o genéticas frente a plagas",
      icon: "🛡️",
      color: "green",
      route: "/admin/add/resistencias",
    },
    {
      title: "Datos agronómicos", 
      description: "Define información clave sobre el manejo y desarrollo de la planta",
      icon: "📊",
      color: "teal",
      route: "/admin/add/datos-agronomicos",
    },
    {
      title: "Variedad",
      description: "Agrega una nueva variedad de café con sus características completas",
      icon: "☕",
      color: "amber",
      route: "/admin/add/variedad",
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

        

        <div className="section-header">
          <div className="section-icon">
            <span>🔎</span>
          </div>
          <h2>GET de Tablas</h2>
        </div>

         <div className="form-cards-container">
          {[
            { title: "Historia Linaje", icon: "📜", route: "/admin/get/historia-linaje", color: "rose" },
            { title: "Ubicaciones", icon: "📍", route: "/admin/get/ubicaciones", color: "orange" },
            { title: "Condiciones", icon: "🌦️", route: "/admin/get/condiciones", color: "cyan" },
            { title: "Porte", icon: "🌱", route: "/admin/get/porte", color: "emerald" },
            { title: "Resistencias", icon: "🛡️", route: "/admin/get/resistencias", color: "green" },
            { title: "Variedades", icon: "☕", route: "/admin/get/variedades", color: "amber" },
            { title: "Densidad", icon: "⚖️", route: "/admin/get/densidad", color: "purple" },
            { title: "Calidad por altitud", icon: "🏔️", route: "/admin/get/calidad-altitud", color: "indigo" },
            { title: "Potencial de rendimiento", icon: "📈", route: "/admin/get/potencial", color: "blue" },
            { title: "Calidad del grano", icon: "⭐", route: "/admin/get/calidad-grano", color: "yellow" },
            { title: "Datos agronómicos", icon: "📊", route: "/admin/get/datos-agronomicos", color: "teal" },
            { title: "Tamaño del grano", icon: "🌾", route: "/admin/get/tamanho", color: "lime" },
            { title: "Enfermedades", icon: "🦠", route: "/admin/get/enfermedades", color: "rose" }
          ].map((item, index) => (
            <div
              key={index}
              className={`form-card card-${item.color}`}
              style={{ animationDelay: `${index * 0.1}s` }}
            >
              <div className={`card-icon icon-${item.color}`}>
                <span>{item.icon}</span>
              </div>

              <div className="card-content">
                <h3>{item.title}</h3>
                <p>Visualiza los datos almacenados en esta tabla</p>
                <Link to={item.route} className={`add-button btn-${item.color}`}>
                  <span>👁️</span>
                  <span>Ver Datos</span>
                </Link>
              </div>

              <div className="card-hover-line"></div>
            </div>
          ))}
        </div>

      </div>
    </div>
  );
};

export default AdminPanel;