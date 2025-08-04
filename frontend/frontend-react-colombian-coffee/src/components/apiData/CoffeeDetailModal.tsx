import '../../styles/CoffeeModal.css';
import type { Data } from '../../api/DataInterface';

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
        <img className="modal-image" src={coffee.imagen} alt={coffee.nombre_comun} />
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
          <p><strong>Resistencia:</strong> {coffee.resistencia.tipo}</p>
            <p><strong>Enfermedad:</strong> {coffee.resistencia.enfermedad.nombre}</p>
            <p><strong>Tratamiento:</strong> {coffee.resistencia.enfermedad.tratamiento}</p>

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
