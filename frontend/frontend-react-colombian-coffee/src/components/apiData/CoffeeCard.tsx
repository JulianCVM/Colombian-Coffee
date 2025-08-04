import '../../styles/CoffeeCard.css';
import type { Data } from '../../api/DataInterface';
import cafeDefault from '../../assets/cafeDefault.jpg';

type Props = {
  coffee: Data[0];
  onClick: () => void;
};

function CoffeeCard({ coffee, onClick }: Props) {
  return (
    <div className="coffee-card" onClick={onClick}>
      <img className="coffee-image" src={coffee.imagen ? coffee.imagen : cafeDefault} alt={coffee.nombre_comun} />
      <div className="coffee-info">
        <h3>{coffee.nombre_comun}</h3>
        <p>{coffee.descripcion_general.slice(0, 80)}...</p>
        <ul>
          <li><strong>Altitud:</strong> {coffee.altitud_optima_siembra} m</li>
          <li><strong>Porte:</strong> {coffee.porte.porte}</li>
            <li><strong>Grano:</strong> {coffee.tamanho_del_grano.tamanho}</li>

        </ul>
      </div>
    </div>
  );
}

export default CoffeeCard;
