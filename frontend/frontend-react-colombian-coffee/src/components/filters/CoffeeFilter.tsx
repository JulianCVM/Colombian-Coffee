

import React, { useEffect, useState } from 'react';

type Option = { id: number; label: string };

const FilterPanel: React.FC = () => {
  const [porteOptions, setPorteOptions] = useState<Option[]>([]);
  const [tamañoOptions, setTamañoOptions] = useState<Option[]>([]);
  const [departamentos, setDepartamentos] = useState<Option[]>([]);

  const [filters, setFilters] = useState({
    porte: '',
    tamaño: '',
    departamento: '',
  });

  useEffect(() => {
    fetchOptions('porte', setPorteOptions);
    fetchOptions('tamanho_grano', setTamañoOptions);
    fetchOptions('departamento', setDepartamentos);

  }, []);

  const fetchOptions = async (tipo: string, setter: (opts: Option[]) => void) => {
    const res = await fetch(`/api/filtros.php?tipo=${tipo}`);
    const data = await res.json();
    setter(data);
  };

  const handleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    setFilters({ ...filters, [e.target.name]: e.target.value });
  };

  return (
    <aside className="filters">
      <h3>Filtros</h3>
      {Object.entries(filters).map(([key, value]) => (
        <div key={key} className="filter">
          <label htmlFor={key}>{key[0].toUpperCase() + key.slice(1).replace('_', ' ')}</label>
          <select name={key} id={key} value={value} onChange={handleChange}>
            <option value="">Seleccionar {key}</option>
            {(key === 'porte' ? porteOptions
                : key === 'tamaño' ? tamañoOptions
                : key === 'departamento' ? departamentos
                : []
            ).map((opt) => (
              <option key={opt.id} value={opt.id}>{opt.label}</option>
            ))}
          </select>
        </div>
      ))}
    </aside>
  );
};

export default FilterPanel;
