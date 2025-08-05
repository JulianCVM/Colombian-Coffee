import './App.css'
import './index.css'
import Login from './pages/Login'
import HomePage from './pages/HomePage'
import { BrowserRouter, Routes, Route } from 'react-router-dom'
import AdminPanel from './pages/AdminPanel'
import HistoriaForm from './pages/forms/HistoriaForm'
import UbicacionForm from './pages/forms/UbicacionForm'

function App() {

  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route path='/' element={<Login></Login>}/>
          <Route path='/Home' element={<HomePage></HomePage>}/>
          <Route path='/Add' element={<AdminPanel></AdminPanel>} />
          <Route path="/historia" element={<HistoriaForm />} />
          <Route path="/ubicacion" element={<UbicacionForm />} />
        </Routes>
      </BrowserRouter>
    </>
  )
}

export default App
