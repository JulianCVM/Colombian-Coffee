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
        setTimeout(function() {
            setMsg("");
        }, 5000)
    })


    const handleInputChange = (
        e: React.ChangeEvent<HTMLInputElement>, type: "user" | "password") => {
        setError("");
        const value = e.target.value;
      
        if (type === "user") {
          setUser(value);
          if (value === "") setError("Usuario en blanco");
        } else if (type === "password") {
          setPass(value);
          if (value === "") setError("Contraseña en blanco");
        }
      };
      

    const loginSubmit = (e: React.FormEvent) => {
        e.preventDefault();
    
        if (user !== "" && pass !== "") {
          const url = "http://localhost/colombian-coffee/public/api/login.php";
          const headers = {
            "Accept": "application/json",
            "Content-Type": "application/json"
          };
    
          const data = { user, pass };
    
          fetch(url, {
            method: "POST",
            headers: headers,
            body: JSON.stringify(data)
          })
            .then(res => res.json())
            .then(res => {
              if (res.success) {
                setMsg("Login exitoso");
                setError("");
              } else {
                setError(res.message || "Credenciales inválidas");
              }
            })
            .catch(() => {
              setError("Error al conectar con el servidor");
            });
    
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
            <h2>Panel de Administración</h2>
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
              placeholder="Ingresa tu usuario"
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
