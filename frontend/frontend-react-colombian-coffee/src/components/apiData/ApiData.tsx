import getDataList from "../../api/CoffeeApi";
import { useEffect, useState } from "react";
import type { Data } from "../../api/DataInterface";
import CoffeeCard from "./CoffeeCard";
import CoffeeDetailModal from "./CoffeeDetailModal";
import "./apiData.css";

function ApiData() {
  const [coffees, setCoffees] = useState<Data>([]);
  const [loading, setLoading] = useState(true);
  const [selectedCoffee, setSelectedCoffee] = useState<Data[0] | null>(null);

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
          <CoffeeCard
            key={coffee.nombre_comun}
            coffee={coffee}
            onClick={() => setSelectedCoffee(coffee)}
          />
        ))
      )}
      {selectedCoffee && (
        <CoffeeDetailModal
          coffee={selectedCoffee}
          onClose={() => setSelectedCoffee(null)}
        />
      )}
    </div>
  );
}

export default ApiData;
