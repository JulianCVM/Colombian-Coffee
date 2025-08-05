import { useEffect, useState } from 'react';

interface Ubicacion {
  id: number;
  departamento: string;
  clima: string;
  suelo: string;
  altitud: string;
  temperatura: string;
  practica_cultivo: string;
}

function UbicacionCard() {
  const [ubicaciones, setUbicaciones] = useState<Ubicacion[]>([]);

  useEffect(() => {
    fetch('http://localhost:8080/ubicacion')
      .then((res) => res.json())
      .then((data) => setUbicaciones(data))
      .catch((error) => console.error('Error al obtener datos de ubicación:', error));
  }, []);

  const handleDelete = async (id: number) => {
    try {
      const res = await fetch(`http://localhost:8080/ubicacion/${id}`, {
        method: 'DELETE',
      });

      if (res.ok) {
        setUbicaciones((prev) => prev.filter((ubicacion) => ubicacion.id !== id));
      } else {
        console.error('Error al eliminar');
      }
    } catch (error) {
      console.error('Error de red:', error);
    }
  };

  return (
    <div className="data-card-container">
      {ubicaciones.map((ubicacion) => (
        <div key={ubicacion.id} className="data-card">
          <h2>{ubicacion.departamento}</h2>
          <p><strong>Clima:</strong> {ubicacion.clima}</p>
          <p><strong>Suelo:</strong> {ubicacion.suelo}</p>
          <p><strong>Altitud:</strong> {ubicacion.altitud}</p>
          <p><strong>Temperatura:</strong> {ubicacion.temperatura}</p>
          <p><strong>Práctica de cultivo:</strong> {ubicacion.practica_cultivo}</p>
          <button className="delete-button" onClick={() => handleDelete(ubicacion.id)}>Eliminar</button>
        </div>
    ))}
    </div>
  );

}

export default UbicacionCard;
