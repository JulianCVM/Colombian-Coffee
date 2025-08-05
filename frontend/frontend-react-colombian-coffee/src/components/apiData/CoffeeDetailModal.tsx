import '../../styles/CoffeeModal.css';
import type { Data } from '../../api/DataInterface';
import cafeDefault from '../../assets/cafeDefault.jpg';

type Props = {
  coffee: Data[0];
  onClose: () => void;
};

function CoffeeDetailModal({ coffee, onClose }: Props) {
  return (
    <div className="modal-overlay" onClick={onClose}>
      <div className="modal-content" onClick={(e) => e.stopPropagation()}>
        <button className="close-button" onClick={onClose}>✕</button>
        <h2>{coffee.nombre_comun}</h2>
        <h4><i>{coffee.nombre_cientifico}</i></h4>
        <img className="modal-image" src={coffee.imagen ? coffee.imagen : cafeDefault} alt={coffee.nombre_comun} />
        <p>{coffee.descripcion_general}</p>

        <div className="modal-section">
          <h3>Características Morfológicas</h3>
          <p><strong>Porte:</strong> {coffee.porte.porte}</p>
          <p><strong>Manejo de cultivo:</strong> {coffee.porte.manejo_cultivo}</p>
          <p><strong>Tamaño del grano:</strong> {coffee.tamanho_del_grano.tamanho}</p>
        </div>

        <div className="modal-section">
          <h3>Datos Agronómicos</h3>
          <p><strong>Altitud óptima:</strong> {coffee.altitud_optima_siembra} m</p>
          <p><strong>Potencial de rendimiento:</strong> {coffee.potencial_de_rendimiento.potencial}</p>
          <p><strong>Condición genética:</strong> {coffee.potencial_de_rendimiento.condicion.genetica}</p>
          <p><strong>Clima:</strong> {coffee.potencial_de_rendimiento.condicion.clima}</p>
          <p><strong>Suelo:</strong> {coffee.potencial_de_rendimiento.condicion.suelo}</p>
          <p><strong>Prácticas de cultivo:</strong> {coffee.potencial_de_rendimiento.condicion.practicas_cultivo}</p>
          <p><strong>Temperatura:</strong> {coffee.potencial_de_rendimiento.condicion.temperatura}</p>
        </div>

        <div className="modal-section">
          <h3>Calidad y Ubicación</h3>
          <p><strong>Calidad (por altitud):</strong> {coffee.calidad_grano_altitud.calidad}</p>
          <p><strong>Departamento:</strong> {coffee.calidad_grano_altitud.ubicacion.departamento}</p>
          <p><strong>Clima:</strong> {coffee.calidad_grano_altitud.ubicacion.clima}</p>
          <p><strong>Suelo:</strong> {coffee.calidad_grano_altitud.ubicacion.suelo}</p>
          <p><strong>Altitud:</strong> {coffee.calidad_grano_altitud.ubicacion.altitud}</p>
          <p><strong>Temperatura:</strong> {coffee.calidad_grano_altitud.ubicacion.temperatura}</p>
          <p><strong>Práctica de cultivo:</strong> {coffee.calidad_grano_altitud.ubicacion.practica_cultivo}</p>
        </div>

        <div className="modal-section">
          <h3>Calidad del Grano</h3>
          <p><strong>Calidad:</strong> {coffee.calidad_grano.calidad}</p>
          <p><strong>Aroma:</strong> {coffee.calidad_grano.aroma}</p>
          <p><strong>Sabor:</strong> {coffee.calidad_grano.sabor}</p>
          <p><strong>Densidad:</strong> {coffee.calidad_grano.densidad} cm</p>
          <p><strong>Humedad:</strong> {coffee.calidad_grano.humedad}</p>
          <p><strong>Tueste:</strong> {coffee.calidad_grano.tueste}</p>
        </div>

        <div className="modal-section">
          <h3>Resistencia</h3>
          <p><strong>Tipo de resistencia:</strong> {coffee.resistencia.tipo}</p>
          <p><strong>Calidad del grano (resistencia):</strong> {coffee.resistencia.calidad_grano.calidad}</p>
          <p><strong>Enfermedad:</strong> {coffee.resistencia.enfermedad.nombre}</p>
          <p><strong>Efectos:</strong> {coffee.resistencia.enfermedad.efectos}</p>
          <p><strong>Gravedad:</strong> {coffee.resistencia.enfermedad.gravedad}</p>
          <p><strong>Tratamiento:</strong> {coffee.resistencia.enfermedad.tratamiento}</p>
        </div>

        <div className="modal-section">
          <h3>Datos Agronómicos Adicionales</h3>
          <p><strong>Tiempo de cosecha:</strong> {coffee.datos_agronomicos.tiempo_cosecha}</p>
          <p><strong>Maduración:</strong> {coffee.datos_agronomicos.maduracion}</p>
          <p><strong>Nutrición:</strong> {coffee.datos_agronomicos.nutricion}</p>
          <p><strong>Densidad de siembra:</strong> {coffee.datos_agronomicos.densidad_de_siembra}</p>
          <p><strong>Valor densidad:</strong> {coffee.datos_agronomicos.densidad.valor_densidad}</p>
        </div>

        <div className="modal-section">
          <h3>Historia y Linaje</h3>
          <p><strong>Obtenor:</strong> {coffee.historia.obtenor}</p>
          <p><strong>Familia:</strong> {coffee.historia.familia}</p>
          <p><strong>Grupo:</strong> {coffee.historia.grupo}</p>
        </div>
      </div>
    </div>
  );
}

export default CoffeeDetailModal;
