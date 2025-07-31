import '../styles/HomePage.css';
import CoffeeFilter from '../components/filters/CoffeeFilter';


function HomePage() {
    return (
        <>
        <div className='body-container'>
            <div className="header-home">
                <h1 className="header-title">Colombian Coffee</h1>
                <p className="header-text">Catalogo de Variedades de Cafe en Colombia</p>
            </div>
            <div className="content-home">
                <CoffeeFilter />
                
            </div>
        </div>
        </>
        
    );
}

export default HomePage;