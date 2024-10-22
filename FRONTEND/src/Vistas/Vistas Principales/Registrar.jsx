import {  useState } from "react";
import Swal from "sweetalert2";

export function Registro(){

    //FUNCIONAMIENTO DEL MODULO REGISTRAR//  
    const [nombre, setNombre] = useState ("");
    const [documento, setDocumento] = useState ("");
    const [direccion, setDireccion] = useState ("");
    const [telefono, setTelefono] = useState ("");
    const [correo, setCorreo] = useState ("");
    const [contrasena, setContrasena] = useState ("");

    const INSERTARDATOS = async(e)=>{
        e.preventDefault();
        const url = await fetch("http://localhost/PROYECTO%20KALASIRIS/BACKEND/controlador/clienteControlador.php",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body:JSON.stringify ({"accion":"insertar",nombre, documento, direccion, telefono, correo, contrasena}),
          }
        );
        
        const respuesta = await url.json();
        console.log(respuesta);
        if (respuesta.estado){
          Swal.fire({
            title: "Registro guardado exitosamente!",
            text: "",
            icon: "success",
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Registro no guardado, vuelve a intentarlo...",
            text: "OK",
          });
        }
      }
  
      return (
      <> 
    
    <form onSubmit={INSERTARDATOS}>
    <div className="registro">
      <div className="row">
        <div className="col-sm-4 offset-4 mt-5">
          <div className="card">
            <div className="card-header text-center">
              <h3>👤 Registrarse</h3>
              <p> Tus datos personales se utilizaran para procesar tu pedido, mejorar tu
                experiencia es esta web, gestionar el acceso a tu cuenta y otros
                propositos descritos en nuestra politica de datos
              </p>
              <div className="card-body">

              <div className="input-group mb-3">
                  <span className="input-group-text" id="basic-addon2">👤</span>
                  <input type="text" className="form-control" value={nombre} onChange={(e)=>setNombre(e.target.value)} placeholder="Nombre" aria-label="Username" aria-describedby="basic-addon1"/>
                </div>

                <div className="input-group mb-3">
                  <span className="input-group-text" id="basic-addon2">🪪</span>
                  <input type="number" className="form-control" value={documento} onChange={(e)=>setDocumento(e.target.value)} placeholder="Documento" aria-label="Username" aria-describedby="basic-addon2"/>
                </div>

                <div className="input-group mb-3">
                  <span className="input-group-text" id="basic-addon2">🏠</span>
                  <input type="text" className="form-control" value={direccion} onChange={(e)=>setDireccion(e.target.value)} placeholder="Dirección" aria-label="Username" aria-describedby="basic-addon3"/>
                </div>

                <div className="input-group mb-3">
                  <span className="input-group-text" id="basic-addon2">📱</span>
                  <input type="number" className="form-control" value={telefono} onChange={(e)=>setTelefono(e.target.value)} placeholder="Telefono" aria-label="Username" aria-describedby="basic-addon4"/>
                </div>

                <div className="input-group mb-3">
                  <span className="input-group-text" id="basic-addon2">📧</span>
                  <input type="email" className="form-control" value={correo} onChange={(e)=>setCorreo(e.target.value)} placeholder="Correo" aria-label="Username" aria-describedby="basic-addon5"/>
                </div>

                <div className="input-group mb-3">
                  <span className="input-group-text" id="basic-addon1">🔐</span>
                  <input type="password" className="form-control" value={contrasena} onChange={(e)=>setContrasena(e.target.value)} placeholder="Contraseña" aria-label="Contraseña" aria-describedby="basic-addon6"/>
                </div>

                <button type="submit" className="btn-btn-info btn-lg btn-block btn btn-primary">Registrarse</button>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>
    </form>
    
</> 
);     
}