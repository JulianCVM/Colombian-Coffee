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
import CalidadAltitudForm from './pages/forms/CalidadAltitud'
import ResistenciaForm from './pages/forms/Resistencias'
import DatosAgronomicosForm from './pages/forms/DatosAgronomicos'
import VariedadForm from './pages/forms/VariedadForm'
import CalidadAltitud from './pages/getAdminPanel/CalidadAltitud'
import CalidadGranoList from './pages/getAdminPanel/CalidadGrano'
import Condiciones from './pages/getAdminPanel/CondicionesPage'
import DatosAgronomicosComponent from './pages/getAdminPanel/DatosAgronomicosPage'
import DensidadList from './pages/getAdminPanel/DensidadPage'
import Enfermedades from './pages/getAdminPanel/EnfermedadesPage'
import HistoriaLinaje from './pages/getAdminPanel/HistoriaLinaje'
import Porte from './pages/getAdminPanel/PortePage'
import PotencialRendimiento from './pages/getAdminPanel/PotencialRendimiento'
import Resistencias from './pages/getAdminPanel/ResistenciaPage'
import TamanhoGrano from './pages/getAdminPanel/TamanhoPage'
import UbicacionCard from './pages/getAdminPanel/UbicacionesPage'
import VariedadComponent from './pages/getAdminPanel/VariedadPage'

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
          <Route path="/admin/add/calidad-de-grano" element={<CalidadGranoForm />} />
          <Route path="/admin/add/potencial-de-rendimiento" element={<PotencialForm />} />
          <Route path="/admin/add/calidad-por-altitud" element={<CalidadAltitudForm />} />
          <Route path="/admin/add/resistencias" element={<ResistenciaForm />} />
          <Route path="/admin/add/datos-agronomicos" element={<DatosAgronomicosForm />} />
          <Route path="/admin/add/variedad" element={<VariedadForm />} />


          <Route path="/admin/get/calidad-altitud" element={<CalidadAltitud />} />
          <Route path="/admin/get/calidad-grano" element={<CalidadGranoList />} />
          <Route path="/admin/get/condiciones" element={<Condiciones />} />
          <Route path="/admin/get/datos-agronomicos" element={<DatosAgronomicosComponent />} />
          <Route path="/admin/get/densidad" element={<DensidadList />} />
          <Route path="/admin/get/enfermedades" element={<Enfermedades />} />
          <Route path="/admin/get/historia" element={<HistoriaLinaje />} />
          <Route path="/admin/get/porte" element={<Porte />} />
          <Route path="/admin/get/potencial-rendimiento" element={<PotencialRendimiento />} />
          <Route path="/admin/get/resistencias" element={<Resistencias />} />
          <Route path="/admin/get/tamanho" element={<TamanhoGrano />} />
          <Route path="/admin/get/ubicaciones" element={<UbicacionCard />} />
          <Route path="/admin/get/variedad" element={<VariedadComponent />} />

        </Routes>
      </BrowserRouter>
    </>
  )
}

export default App
