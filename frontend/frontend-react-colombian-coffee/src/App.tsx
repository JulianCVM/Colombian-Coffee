import './App.css'
import './index.css'
import Login from './pages/Login'
import { BrowserRouter, Routes, Route } from 'react-router-dom'

function App() {

  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route path='/' element={<Login></Login>}/>
        </Routes>
      </BrowserRouter>
    </>
  )
}

export default App
