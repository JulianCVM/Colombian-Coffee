// filters/CoffeeFilter.tsx
import './Filter.css';
import React from 'react';
import type { Data } from '../../api/DataInterface';

type FilterProps = {
  coffees: Data;
  onFiltersChange: (filteredCoffees: Data) => void;
};

type FilterValues = {
  porte: string;
  tamaño: string;
  departamento: string;
};

const CoffeeFilter: React.FC<FilterProps> = ({ coffees, onFiltersChange }) => {
  const [filters, setFilters] = React.useState<FilterValues>({
    porte: '',
    tamaño: '',
    departamento: '',
  });

  const getUniqueOptions = React.useMemo(() => {
    const portes = [...new Set(coffees.map(coffee => coffee.porte.porte))].filter(Boolean);
    const tamaños = [...new Set(coffees.map(coffee => coffee.tamanho_del_grano.tamanho))].filter(Boolean);
    const departamentos = [...new Set(coffees.map(coffee => coffee.calidad_grano_altitud.ubicacion.departamento))].filter(Boolean);

    return {
      portes: portes.sort(),
      tamaños: tamaños.sort(),
      departamentos: departamentos.sort()
    };
  }, [coffees]);

  // Aplicar filtros
  const applyFilters = React.useCallback((filterValues: FilterValues) => {
    let filtered = [...coffees];

    if (filterValues.porte) {
      filtered = filtered.filter(coffee => 
        coffee.porte.porte.toLowerCase().includes(filterValues.porte.toLowerCase())
      );
    }

    if (filterValues.tamaño) {
      filtered = filtered.filter(coffee => 
        coffee.tamanho_del_grano.tamanho.toLowerCase().includes(filterValues.tamaño.toLowerCase())
      );
    }

    if (filterValues.departamento) {
      filtered = filtered.filter(coffee => 
        coffee.calidad_grano_altitud.ubicacion.departamento.toLowerCase().includes(filterValues.departamento.toLowerCase())
      );
    }

    onFiltersChange(filtered);
  }, [coffees, onFiltersChange]);

  const handleFilterChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    const { name, value } = e.target;
    const newFilters = { ...filters, [name]: value };
    setFilters(newFilters);
    applyFilters(newFilters);
  };

  // Limpiar filtros
  const clearFilters = () => {
    const clearedFilters = { porte: '', tamaño: '', departamento: '' };
    setFilters(clearedFilters);
    onFiltersChange(coffees);
  };

  return (
    <aside className="filters">
      <h3>Filtros</h3>
      
      <div className="filter">
        <label htmlFor="porte">Porte</label>
        <select 
          name="porte" 
          id="porte" 
          value={filters.porte} 
          onChange={handleFilterChange}
        >
          <option value="">Seleccionar porte</option>
          {getUniqueOptions.portes.map((porte) => (
            <option key={porte} value={porte}>{porte}</option>
          ))}
        </select>
      </div>

      <div className="filter">
        <label htmlFor="tamaño">Tamaño</label>
        <select 
          name="tamaño" 
          id="tamaño" 
          value={filters.tamaño} 
          onChange={handleFilterChange}
        >
          <option value="">Seleccionar tamaño</option>
          {getUniqueOptions.tamaños.map((tamaño) => (
            <option key={tamaño} value={tamaño}>{tamaño}</option>
          ))}
        </select>
      </div>

      <div className="filter">
        <label htmlFor="departamento">Departamento</label>
        <select 
          name="departamento" 
          id="departamento" 
          value={filters.departamento} 
          onChange={handleFilterChange}
        >
          <option value="">Seleccionar departamento</option>
          {getUniqueOptions.departamentos.map((departamento) => (
            <option key={departamento} value={departamento}>{departamento}</option>
          ))}
        </select>
      </div>

      <button className="clear-filters-btn" onClick={clearFilters}>
        Limpiar Filtros
      </button>
    </aside>
  );
};

export default CoffeeFilter;