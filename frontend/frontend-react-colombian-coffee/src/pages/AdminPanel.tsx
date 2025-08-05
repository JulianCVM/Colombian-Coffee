import { useState } from 'react';
import { Link } from 'react-router-dom';
import { 
  Scroll, 
  MapPin, 
  Scale, 
  Sprout, 
  Thermometer, 
  Microscope, 
  Timer, 
  TrendingUp, 
  Star, 
  Mountain, 
  Shield, 
  BarChart3, 
  Coffee,
  ClipboardList,
  Search,
  Cloud,
  Wheat,
  Bug,
  Plus,
  Eye
} from 'lucide-react';
import '../styles/AdminPanel.css';

const AdminPanel = () => {
  const [activeTab, setActiveTab] = useState('forms');

  const formCards = [
    {
      title: "Historia de Linaje",
      description: "Gestiona el origen y genealogía de las variedades de café",
      icon: Scroll,
      route: "/admin/add/historia",
    },
    {
      title: "Ubicaciones", 
      description: "Administra las regiones y fincas productoras",
      icon: MapPin,
      route: "/admin/add/ubicacion",
    },
    {
      title: "Tamaño de Grano",
      description: "Configura las clasificaciones de tamaño del grano", 
      icon: Scale,
      route: "/admin/add/tamanho-grano",
    },
    {
      title: "Porte",
      description: "Define los tipos de porte y estructura de las plantas",
      icon: Sprout,
      route: "/admin/add/porte",
    },
    {
      title: "Condiciones de Cultivo",
      description: "Establece las condiciones ambientales y de cultivo",
      icon: Thermometer,
      route: "/admin/add/condiciones",
    },
    {
      title: "Enfermedades",
      description: "Establece las enfermedades que afectan al cultivo de café",
      icon: Microscope,
      route: "/admin/add/enfermedad",
    },
    {
      title: "Densidad del grano", 
      description: "Registra la densidad física del grano de café según su estructura",
      icon: Timer,
      route: "/admin/add/densidad",
    },
    {
      title: "Potencial de rendimiento",
      description: "Define el nivel de producción esperada por planta o hectárea",
      icon: TrendingUp,
      route: "/admin/add/potencial-de-rendimiento",
    },
    {
      title: "Calidad del grano",
      description: "Establece los criterios de evaluación física y sensorial del grano", 
      icon: Star,
      route: "/admin/add/calidad-de-grano",
    },
    {
      title: "Calidad por altitud",
      description: "Relaciona la altitud de cultivo con la calidad del café producido",
      icon: Mountain,
      route: "/admin/add/calidad-por-altitud",
    },
    {
      title: "Resistencias",
      description: "Registra las resistencias naturales o genéticas frente a plagas",
      icon: Shield,
      route: "/admin/add/resistencias",
    },
    {
      title: "Datos agronómicos", 
      description: "Define información clave sobre el manejo y desarrollo de la planta",
      icon: BarChart3,
      route: "/admin/add/datos-agronomicos",
    },
    {
      title: "Variedad",
      description: "Agrega una nueva variedad de café con sus características completas",
      icon: Coffee,
      route: "/admin/add/variedad",
    }
  ];

  const getCards = [
    { title: "Historia Linaje", icon: Scroll, route: "/admin/get/historia-linaje" },
    { title: "Ubicaciones", icon: MapPin, route: "/admin/get/ubicaciones" },
    { title: "Condiciones", icon: Cloud, route: "/admin/get/condiciones" },
    { title: "Porte", icon: Sprout, route: "/admin/get/porte" },
    { title: "Resistencias", icon: Shield, route: "/admin/get/resistencias" },
    { title: "Variedades", icon: Coffee, route: "/admin/get/variedad" },
    { title: "Densidad", icon: Scale, route: "/admin/get/densidad" },
    { title: "Calidad por altitud", icon: Mountain, route: "/admin/get/calidad-altitud" },
    { title: "Potencial de rendimiento", icon: TrendingUp, route: "/admin/get/potencial" },
    { title: "Calidad del grano", icon: Star, route: "/admin/get/calidad-grano" },
    { title: "Datos agronómicos", icon: BarChart3, route: "/admin/get/datos-agronomicos" },
    { title: "Tamaño del grano", icon: Wheat, route: "/admin/get/tamanho" },
    { title: "Enfermedades", icon: Bug, route: "/admin/get/enfermedades" }
  ];

  const renderCards = (cards, type) => {
    return cards.map((card, index) => {
      const IconComponent = card.icon;
      return (
        <div
          key={index}
          className={`form-card ${type === 'forms' ? 'form-card-add' : 'form-card-view'}`}
          style={{animationDelay: `${index * 0.05}s`}}
        >
          <div className="card-icon-wrapper">
            <div className="card-icon">
              <IconComponent size={24} />
            </div>
          </div>
          
          <div className="card-content">
            <h3>{card.title}</h3>
            <p>{card.description || 'Visualiza los datos almacenados en esta tabla'}</p>
            
            <Link to={card.route} className="add-button">
              {type === 'forms' ? (
                <>
                  <Plus size={16} className="button-icon" />
                  Agregar Nuevo
                </>
              ) : (
                <>
                  <Eye size={16} className="button-icon" />
                  Ver Datos
                </>
              )}
            </Link>
          </div>
        </div>
      );
    });
  };

  return (
    <div className="admin-panel">
      {/* Header */}
      <div className="admin-header">
        <div className="header-content">
          <div className="header-icon">
            <Coffee size={32} />
          </div>
          <div>
            <h1>Panel de Administración</h1>
            <p>Colombian Coffee Catalog</p>
          </div>
        </div>
      </div>

      <div className="admin-content">
        {/* Tab Navigation */}
        <div className="tab-navigation">
          <div className="tab-buttons">
            <button
              className={`tab-button ${activeTab === 'forms' ? 'active' : ''}`}
              onClick={() => setActiveTab('forms')}
            >
              <ClipboardList size={20} />
              <span>Formularios Disponibles</span>
              <div className="tab-indicator"></div>
            </button>
            
            <button
              className={`tab-button ${activeTab === 'tables' ? 'active' : ''}`}
              onClick={() => setActiveTab('tables')}
            >
              <Search size={20} />
              <span>Consultar Tablas</span>
              <div className="tab-indicator"></div>
            </button>
          </div>
        </div>

        {/* Tab Content */}
        <div className="tab-content">
          {activeTab === 'forms' && (
            <div className="tab-panel active" id="forms-panel">
              <div className="section-description">
                <p>Gestiona y agrega nueva información a las diferentes categorías del catálogo de café</p>
              </div>
              <div className="form-cards-container">
                {renderCards(formCards, 'forms')}
              </div>
            </div>
          )}

          {activeTab === 'tables' && (
            <div className="tab-panel active" id="tables-panel">
              <div className="section-description">
                <p>Consulta y visualiza todos los datos almacenados en las diferentes tablas del sistema</p>
              </div>
              <div className="form-cards-container">
                {renderCards(getCards, 'tables')}
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default AdminPanel;