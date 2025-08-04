import { useState } from "react";
import type { Data } from "../../api/DataInterface";
import CoffeeCard from "./CoffeeCard";
import CoffeeDetailModal from "./CoffeeDetailModal";
import "./apiData.css";

type ApiDataProps = {
  filteredCoffees: Data;
};

function ApiData({ filteredCoffees }: ApiDataProps) {
  const [selectedCoffee, setSelectedCoffee] = useState<Data[0] | null>(null);

  return (
    <div className="cards-container">
      {filteredCoffees.length === 0 ? (
        <p className="no-results">No se encontraron variedades que coincidan con los filtros seleccionados.</p>
      ) : (
        filteredCoffees.map((coffee) => (
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