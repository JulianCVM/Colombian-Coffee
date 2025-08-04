import '../styles/HomePage.css';
import CoffeeFilter from '../components/filters/CoffeeFilter';
import ApiData from '../components/apiData/ApiData';


function HomePage() {
    return (
        <div className="body-container">
          <div className="header-home">
            <h1 className="header-title">Colombian Coffee</h1>
            <p className="header-text">Catálogo de Variedades de Café en Colombia</p>
          </div>
      
          <div className="main-home">
            <aside className="sidebar-home">
              <CoffeeFilter />
            </aside>
      
            <section className="cards-home">
              <ApiData />
            </section>
          </div>
        </div>
      );
      
      
}

export default HomePage;