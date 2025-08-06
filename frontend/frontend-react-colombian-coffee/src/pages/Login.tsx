import React, { useState, useEffect } from 'react';
import { FaUser, FaLock, FaMugHot } from 'react-icons/fa';
import '../styles/Login.css';
import '../index.css';
import logo from '../assets/logo.png';
import login from '../assets/login-partner.png';

function Login() {
  const [user, setUser] = useState("");
  const [pass, setPass] = useState("");
  const [error, setError] = useState("");
  const [msg, setMsg] = useState("");

  useEffect(() => {
    const timer = setTimeout(() => {
      setMsg("");
    }, 5000);
    return () => clearTimeout(timer);
  }, [msg]);

  const handleInputChange = (
    e: React.ChangeEvent<HTMLInputElement>,
    type: "user" | "password"
  ) => {
    setError("");
    const value = e.target.value;

    if (type === "user") {
      setUser(value.toLowerCase());
      if (value === "") setError("Usuario en blanco");
    } else if (type === "password") {
      setPass(value);
      if (value === "") setError("Contraseña en blanco");
    }
  };













  const loginSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
  
    if (user !== "" && pass !== "") {
      try {
        const url = "http://localhost:8080/auth/login";
        const payload = {
          email: user, // Asegúrate que el backend espera `email`
          password: pass
        };
  
        console.log("Enviando login:", payload);
  
        const res = await fetch(url, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
          },
          body: JSON.stringify(payload)
        });
  
        const data = await res.json();
  
        if (res.ok && data.token) {
          localStorage.setItem("token", data.token);
          localStorage.setItem("user", JSON.stringify(data.user));
          setMsg("Login exitoso");
          setError("");
  
          console.log("Usuario autenticado:", data.user);
  
          window.location.href = "/home";
  
        } else {
          setError(data.message || "Credenciales inválidas");
          console.warn("Respuesta con error:", data);
        }
  
      } catch (err) {
        console.error("Error en login:", err);
        setError("Error al conectar con el servidor");
      }
  
    } else {
      setError("Todos los campos son requeridos");
    }
  };
  











  
  return (
    <div className="login-container">
      <form onSubmit={loginSubmit} className="login-form">
        <div className="form-header">
          <div className="logo-circle">
            <img src={logo} alt="Logo" className="logo-img" />
          </div>
          <h2>Inicio de sesión</h2>
          <p>Colombian Coffee Catalog</p>
        </div>

        {error && <p className="error-msg">{error}</p>}
        {msg && <p className="success-msg">{msg}</p>}

        <div className="form-group">
          <label>
            <FaUser /> Usuario
          </label>
          <input
            type="text"
            value={user}
            onChange={(e) => handleInputChange(e, 'user')}
            placeholder="Ingresa tu email"
          />
        </div>

        <div className="form-group">
          <label>
            <FaLock /> Contraseña
          </label>
          <input
            type="password"
            value={pass}
            onChange={(e) => handleInputChange(e, 'password')}
            placeholder="Ingresa tu contraseña"
          />
        </div>

        <button type="submit" className="submit-btn">
          <FaMugHot /> Iniciar Sesión
        </button>
      </form>
      <div className='image-container'>
        <img src={login} alt="" />
      </div>
    </div>
  );
}

export default Login;
