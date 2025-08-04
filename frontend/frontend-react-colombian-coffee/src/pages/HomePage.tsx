import '../styles/HomePage.css';
import { useEffect, useState } from 'react';
import getDataList from '../api/CoffeeApi';
import type { Data } from '../api/DataInterface';
import CoffeeFilter from '../components/filters/CoffeeFilter';
import ApiData from '../components/apiData/ApiData';

function HomePage() {
  const [allCoffees, setAllCoffees] = useState<Data>([]);
  const [filteredCoffees, setFilteredCoffees] = useState<Data>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    getDataList()
      .then((data) => {
        setAllCoffees(data);
        setFilteredCoffees(data);
        setLoading(false);
      })
      .catch((error) => {
        console.error(error);
        setLoading(false);
      });
  }, []);

  const handleFiltersChange = (filtered: Data) => {
    setFilteredCoffees(filtered);
  };

  if (loading) {
    return (
      <div className="body-container">
        <div className="loading">Cargando datos...</div>
      </div>
    );
  }

  return (
    <div className="body-container">
      <div className="header-home">
        <h1 className="header-title">Colombian Coffee</h1>
        <p className="header-text">Catálogo de Variedades de Café en Colombia</p>
      </div>

      <div className="main-home">
        <aside className="sidebar-home">
          <CoffeeFilter 
            coffees={allCoffees}
            onFiltersChange={handleFiltersChange}
          />
        </aside>

        <section className="cards-home">
          <div className="results-info">
            <p>Mostrando {filteredCoffees.length} de {allCoffees.length} variedades</p>
          </div>
          <ApiData filteredCoffees={filteredCoffees} />
        </section>
      </div>
    </div>
  );
}

export default HomePage;