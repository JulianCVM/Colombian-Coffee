import getDataList from "../../api/CoffeeApi";
import { useEffect, useState } from 'react';
import type { Data } from "../../api/DataInterface";

function ApiData() {
    const [coffees, setCoffees] = useState<Data>([]);

    useEffect(() => {
        getDataList()
        .then((data) => {
            console.log('Existen datos en ApiData');
            setCoffees(data);
        })
        .catch((error) => console.error(error));
    }, []);

    return (
        <>
        <div>
        { /* Ejemplo de datos a mostrar */ }
        {coffees.map((coffee) => ( 
            <div key={coffee.nombre_comun}>{coffee.imagen}</div>
        ))}
    </div>
        </>
    )
}

export default ApiData;