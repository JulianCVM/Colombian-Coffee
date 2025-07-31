

import React, { useEffect, useState } from 'react';

// Se define un tipo para las opciones del filtro (los parametros)
type Option = { id: number; label: string };


const FilterPanel = () => {
    // Aca se vuelven a asignar los valores actuales y los valores que va a recibir
  const [porteOptions, setPorteOptions] = useState<Option[]>([]); // El option funciona como una interfaz, que recibe lo que declaramos arriba
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
 
  // yo por que decidi que era buena idea utilizar typescript?
  // para sacar los datos necesitamos el tipo (se relaciona a las tablas 'porte', tama;o, etc)
  // y se utiliza el setter debido al tipo de dato que definimos arriba
  const fetchOptions = async (tipo: string, setter: (opts: Option[]) => void) => {
    const res = await fetch(`/api/filtros.php?tipo=${tipo}`);
    const data = await res.json();
    setter(data); // se termina sacando toda la info de las tablas
  };

  // Esto saca  el valor de los select de html
  const handleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    setFilters({ ...filters, [e.target.name]: e.target.value });
  }; // saca todos los nombres, despues saca la 'clave' y la asocia al valor del select

  return (
    <aside className="filters">
      <h3>Filtros</h3>
      {Object.entries(filters).map(([key, value]) => (
        <div key={key} className="filter">   {/* key es el nombre del filtro, value es el valor seleccionado */}
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
