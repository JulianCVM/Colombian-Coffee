// src/pages/HomePage.tsx
import '../styles/HomePage.css';
import { useEffect, useState } from 'react';
import getDataList from '../api/CoffeeApi';
import type { Data } from '../api/DataInterface';
import CoffeeFilter from '../components/filters/CoffeeFilter';
import ApiData from '../components/apiData/ApiData';
import ColombianMap from '../components/map/ColombianMap';
import '../styles/Map.css';
import Pagination from '../components/Pagination.tsx'



function HomePage() {
  const [allCoffees, setAllCoffees] = useState<Data>([]);
  const [filteredCoffees, setFilteredCoffees] = useState<Data>([]);
  const [loading, setLoading] = useState(true);
  const [showMap, setShowMap] = useState(false);

  const [currentPage, setCurrentPage] = useState(1);
  const cardsPerPage = 6;

  const indexOfLastCard = currentPage * cardsPerPage;
  const indexOfFirstCard = indexOfLastCard - cardsPerPage;
  const currentCoffees = filteredCoffees.slice(indexOfFirstCard, indexOfLastCard);
  const totalPages = Math.ceil(filteredCoffees.length / cardsPerPage);
  
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
    setCurrentPage(1); 
  };
  

  const handleDepartmentSelect = (department: string) => {
    // Filtrar por el departamento seleccionado
    const filtered = allCoffees.filter(coffee => 
      coffee.calidad_grano_altitud.ubicacion.departamento.toLowerCase().includes(department.toLowerCase())
    );
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
            <div className="results-stats">
              <p>Mostrando {filteredCoffees.length} de {allCoffees.length} variedades</p>
            </div>
            <div className="map-controls">
              <button 
                className="map-toggle-btn"
                onClick={() => setShowMap(!showMap)}
              >
                {showMap ? '📋' : '🗺️'} {showMap ? 'Ver Lista' : 'Ver Mapa'}
              </button>
            </div>
          </div>

          {showMap ? (
            <div className="map-section">
              <ColombianMap 
                key={showMap ? 'map-visible' : 'map-hidden'} // Force re-render cuando cambia
                filteredCoffees={filteredCoffees}
                onDepartmentSelect={handleDepartmentSelect}
              />
            </div>
          ) : (
            <>
              <ApiData filteredCoffees={currentCoffees} />
              <Pagination 
                currentPage={currentPage} 
                totalPages={totalPages} 
                onPageChange={(page) => setCurrentPage(page)} 
              />
            </>

          )}
        </section>
      </div>
    </div>
  );
}

export default HomePage;