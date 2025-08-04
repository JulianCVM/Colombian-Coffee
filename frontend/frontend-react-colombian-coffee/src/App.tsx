import './App.css'
import './index.css'
import Login from './pages/Login'
import HomePage from './pages/HomePage'
import { BrowserRouter, Routes, Route } from 'react-router-dom'
import AdminPanel from './pages/AdminPanel'
import HistoriaForm from './pages/forms/HistoriaForm'
import UbicacionForm from './pages/forms/UbicacionForm'
import TamanhoGranoForm from './pages/forms/TamanhoGrano'
import PorteForm from './pages/forms/PorteForm'
import CondicionesForm from './pages/forms/CondicionesForm'
import EnfermedadesForm from './pages/forms/EnfermedadForm'
import DensidadForm from './pages/forms/DensidadForm'
import CalidadGranoForm from './pages/forms/CalidadGranoForm'
import PotencialForm from './pages/forms/PotencialRendimientoForm'

function App() {

  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route path='/' element={<Login></Login>}/>
          <Route path='/home' element={<HomePage></HomePage>}/>
          <Route path='/admin' element={<AdminPanel></AdminPanel>} />
          <Route path="/admin/add/historia" element={<HistoriaForm />} />
          <Route path="/admin/add/ubicacion" element={<UbicacionForm />} />
          <Route path="/admin/add/tamanho-grano" element={<TamanhoGranoForm />} />
          <Route path="/admin/add/porte" element={<PorteForm />} />
          <Route path="/admin/add/condiciones" element={<CondicionesForm />} />
          <Route path="/admin/add/enfermedad" element={<EnfermedadesForm />} />
          <Route path="/admin/add/densidad" element={<DensidadForm />} />
          <Route path="/admin/add/calidad-grano" element={<CalidadGranoForm />} />
          <Route path="/admin/add/potencial-de-rendimiento" element={<PotencialForm />} />
        </Routes>
      </BrowserRouter>
    </>
  )
}

export default App
