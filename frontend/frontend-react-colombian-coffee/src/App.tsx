import './App.css'
import './index.css'
import Login from './pages/Login'
import HomePage from './pages/HomePage'
import { BrowserRouter, Routes, Route } from 'react-router-dom'
import AddCoffeeForm from './pages/PostForm'

function App() {

  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route path='/' element={<Login></Login>}/>
          <Route path='/Home' element={<HomePage></HomePage>}/>
          <Route path='/Add' element={<AddCoffeeForm></AddCoffeeForm>} />
        </Routes>
      </BrowserRouter>
    </>
  )
}

export default App
