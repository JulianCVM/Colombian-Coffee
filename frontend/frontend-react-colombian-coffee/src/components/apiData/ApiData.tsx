import getDataList from "../../api/CoffeeApi";
import { useEffect, useState } from 'react';
import type { Data } from "../../api/DataInterface";
import './apiData.css';

function ApiData() {
    const [coffees, setCoffees] = useState<Data>([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
      getDataList()
        .then((data) => {
          setCoffees(data);
          setLoading(false);
        })
        .catch((error) => {
          console.error(error);
          setLoading(false);
        });
    }, []);
    

    return (
        <div className="cards-container">
          {loading ? (
            <p>Cargando datos...</p>
          ) : coffees.length === 0 ? (
            <p>No se encontraron variedades de café.</p>
          ) : (
            coffees.map((coffee) => (
              <div className="coffee-card" key={coffee.nombre_comun}>
                <img className="coffee-image" src={coffee.imagen} alt={coffee.nombre_comun} />
                <div className="coffee-info">
                  <h3 className="coffee-name">{coffee.nombre_comun}</h3>
                  <p className="coffee-description">{coffee.descripcion_general}</p>
                  <ul className="coffee-details">
                    <li><strong>Altitud óptima:</strong> {coffee.altitud_optima_siembra}</li>
                    <li><strong>Porte:</strong> {coffee.porte}</li>
                    <li><strong>Tamaño del grano:</strong> {coffee.tamanho_del_grano}</li>
                    <li><strong>Resistencia:</strong> {coffee.resistencia}</li>
                  </ul>
                </div>
              </div>
            ))
          )}
        </div>
      );
      
      
}

export default ApiData;