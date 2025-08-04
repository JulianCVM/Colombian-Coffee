import { useState } from "react";
import '../styles/AddCoffee.css';

export default function AddCoffeeForm() {
  const [formData, setFormData] = useState({
    nombre_comun: "",
    nombre_cientifico: "",
    tipo: "",
    sabor: "",
    region: "",
    altura: "",
    imagen: ""
  });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({ ...prev, [name]: value }));
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const res = await fetch("http://localhost:8080/variedad", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(formData)
      });
  
      const responseData = await res.json();
  
      if (!res.ok) {
        console.error("Error del servidor:", responseData);
        alert(`Error: ${responseData.message || "No se pudo guardar el café"}`);
        return;
      }
  
      console.log("Respuesta del servidor:", responseData);
      alert("Café agregado exitosamente");

      setFormData({
        nombre_comun: "",
        nombre_cientifico: "",
        tipo: "",
        sabor: "",
        region: "",
        altura: "",
        imagen: ""
      });
    } catch (error) {
      console.error("Error en la solicitud:", error);
      alert("Hubo un problema en la conexión con el servidor");
    }
  };
  

  return (
    <form className="coffee-form" onSubmit={handleSubmit}>
      <h2>Agregar nueva variedad de café</h2>
      <input
        type="text"
        name="nombre_comun"
        placeholder="Nombre común"
        value={formData.nombre_comun}
        onChange={handleChange}
        required
      />
      <input
        type="text"
        name="nombre_cientifico"
        placeholder="Nombre científico"
        value={formData.nombre_cientifico}
        onChange={handleChange}
        required
      />
      <input
        type="text"
        name="tipo"
        placeholder="Tipo"
        value={formData.tipo}
        onChange={handleChange}
      />
      <input
        type="text"
        name="sabor"
        placeholder="Sabor"
        value={formData.sabor}
        onChange={handleChange}
      />
      <input
        type="text"
        name="region"
        placeholder="Región"
        value={formData.region}
        onChange={handleChange}
      />
      <input
        type="number"
        name="altura"
        placeholder="Altura (msnm)"
        value={formData.altura}
        onChange={handleChange}
      />
      <input
        type="text"
        name="imagen"
        placeholder="URL de la imagen"
        value={formData.imagen}
        onChange={handleChange}
      />
      <button type="submit">Guardar café</button>
    </form>
  );
}
