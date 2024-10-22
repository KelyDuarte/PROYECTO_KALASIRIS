import { BrowserRouter, Route, Routes } from "react-router-dom"
import { Navegacion } from "./Vistas/Vistas Principales/Navbar"
import { Pie_Pagina } from "./Vistas/Vistas Principales/Footer"
import { Index } from "./Vistas/Vistas Principales/Index"
import { Login } from "./Vistas/Vistas Principales/Login"
import { Camisas_Hombre } from "./Vistas/Vistas Hombre/Camisas_Hombre"
import { Camisetas_Hombre } from "./Vistas/Vistas Hombre/Camisetas_Hombre"
import { Camisas_Mujer } from "./Vistas/Vistas Mujer/Camisas_Mujer"
import { Camisetas_Mujer } from "./Vistas/Vistas Mujer/Camisetas_Mujer"
import { Camisas_Niñas } from "./Vistas/Vistas Niñas/Camisas_Niñas"
import { Camisetas_Niñas } from "./Vistas/Vistas Niñas/Camisetas_Niñas"
import { Camisas_Niños } from "./Vistas/Vistas Niños/Camisas_Niños"
import { Camisetas_Niños } from "./Vistas/Vistas Niños/Camisetas_Niños"
import { Camisas_Oferta } from "./Vistas/Vistas ofertas/Camisas_Oferta"
import { Camisetas_Oferta } from "./Vistas/Vistas ofertas/Camisetas_Ofertas"
import React, {useState} from 'react';

function App() {

  const [conectado, setConectado] = useState(false);
  const acceder = (estado)=>{
  }

  return (
      conectado ? <Index/> : <Login acceder={acceder}/>,
      <BrowserRouter>
      <Routes>
        <Route path="/" element={<Index/>}/>
        <Route path="Login" element={<Login/>}/>
        <Route path="Camisas_Mujer" element={<Camisas_Mujer/>}/>
        <Route path="Camisetas_Mujer" element={<Camisetas_Mujer/>}/>
        <Route path="Camisas_Hombre" element={<Camisas_Hombre/>}/>
        <Route path="Camisetas_Hombre" element={<Camisetas_Hombre/>}/>
        <Route path="Camisas_Niños" element={<Camisas_Niños/>}/>
        <Route path="Camisetas_Niños" element={<Camisetas_Niños/>}/>
        <Route path="Camisas_Niñas" element={<Camisas_Niñas/>}/>
        <Route path="Camisetas_Niñas" element={<Camisetas_Niñas/>}/>
        <Route path="Camisas_Oferta" element={<Camisas_Oferta/>}/>
        <Route path="Camisetas_Oferta" element={<Camisetas_Oferta/>}/>
      </Routes>
      </BrowserRouter>
  );
}

export default App
