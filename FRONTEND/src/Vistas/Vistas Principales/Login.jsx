import {  useState } from "react";
import { Pie_Pagina } from "./Footer";
import { Navegacion } from "./Navbar";
import { useNavigate } from "react-router-dom";
import { Registro } from "./Registrar";

const URL_LOGIN = "http://localhost/PROYECTO%20KALASIRIS/BACKEND/controlador/clienteControlador.php"


export function Login(props) {

  const navigate = useNavigate();
  const [error, setError]= useState(null);
  const [espera, setEspera]= useState(false);
  const [correo, setCorreo] = useState ("");
  const [contrasena, setContrasena] = useState ("");

  /*ENVIO DE DATOS AL SERVIDOR MEDIANTE FETCH Y ASYNC/AWAIT */
  const enviarData = async (url, correo, contrasena)=>
  {
    const respuesta = await fetch(url,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body:JSON.stringify ({"accion":"login",correo,contrasena}),
      }
    );
    

  //console.log(resp);
  const json = await respuesta.json();
  //console.log(json);
  return json;
}

    //FUNCIONAMIENTO DEL MODULO INICIO DE SESION//
    const handleLogin= async()=>{
    setEspera(true);
      
      const respuestaJson= await enviarData(URL_LOGIN, correo,contrasena);
      console.log("respuesta desde el evento", respuestaJson.conectado);
      
      setError(respuestaJson.error);
      if(respuestaJson.conectado){
        return navigate("/");
      }else{
        return navigate("/Login");
      }
      setEspera(false);
    }

    return (
    <>
    <Navegacion/>
    
    <div className="login">
      <div className="row">
        <div className="col-sm-4 offset-4 mt-5">
          <div className="card">
            <div className="card-header text-center">
              <h3>👤 Inicio de Sesión</h3>
              <div className="card-body">
                <div className="input-group mb-3">
                  <span className="input-group-text" id="basic-addon2">📧</span>
                  <input type="email" className="form-control" placeholder="Correo" aria-label="Username" aria-describedby="basic-addon1" value={correo} onChange={(e)=>setCorreo(e.target.value)}/>
                </div>

                <div className="input-group mb-3">
                  <span className="input-group-text" id="basic-addon1">🔐</span>
                  <input type="password" className="form-control" placeholder="Contraseña" aria-label="Contraseña" aria-describedby="basic-addon2" value={contrasena} onChange={(e)=>setContrasena(e.target.value)}/>
                </div>

                {
                  error &&
                  <div className="alert alert-danger">{error}</div>
                }
{/*disabled={espera} */}
                <button  onClick={handleLogin} className="btn-btn-info btn-lg btn-block btn btn-primary">Acceder</button>
                <div className="card-footer">
                  <span>¿Olvido su contraseña?</span> <a href="https://">Recuperar</a>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>
 
<Registro/>
<Pie_Pagina/>
</>
)    
}