import "./././Styles.css";
import Whatsapp from "../../Imagenes/REDES/Whatsapp.png";
import Facebook from "../../Imagenes/REDES/Facebook.png";
import Instagram from "../../Imagenes/REDES/Instagram.png";

export function Pie_Pagina() {
    return (
     <>
     <div className="whatsapp">
      <a href="https://wa.link/ihad5q">
        <img src={Whatsapp} width="75px" height="75px"/>
      </a> 
     </div>

     
     <div className="facebook">
      <a href="">
        <img src={Facebook} width="75px" height="75px"/>
      </a> 
     </div>

     <div className="instagram">
      <a href="">
        <img src={Instagram} width="75px" height="75px"/>
      </a> 
     </div>

    <div className="container-fluid">
    <footer className="py-5">
      <div className="row">
        <div className="col-6 col-md-2 mb-3">
          <h5>Medios de pago</h5>
          <ul className="nav flex-column">
            <li className="nav-item mb-2">
              <a className="nav-link p-0 text-body-secondary">Tarjetas debito</a>
            </li>
            <li className="nav-item mb-2">
              <a className="nav-link p-0 text-body-secondary">Tarjetas de credito</a>
            </li>
            <li className="nav-item mb-2">
              <a className="nav-link p-0 text-body-secondary">Sistecredito | Addi</a>
            </li>
            <li className="nav-item mb-2">
              <a className="nav-link p-0 text-body-secondary">Efectivo</a>
            </li>
          </ul>
        </div>
        <div className="col-6 col-md-2 mb-3">
          <h5>Información</h5>
          <ul className="nav flex-column">
            <li className="nav-item mb-2">
              <a href="#" className="nav-link p-0 text-body-secondary">Quienes somos</a>
            </li>
            <li className="nav-item mb-2">
              <a href="#" className="nav-link p-0 text-body-secondary">Preguntas frecuentes</a>
            </li>
            <li className="nav-item mb-2">
              <a href="/Login" className="nav-link p-0 text-body-secondary">Mi cuenta | Registrarme</a>
            </li>
            <li className="nav-item mb-2">
              <a href="#" className="nav-link p-0 text-body-secondary">Terminos y condiciones</a>
            </li>
            <li className="nav-item mb-2">
              <a href="#" className="nav-link p-0 text-body-secondary">Tratamiento de datos</a>
            </li>
          </ul>
        </div>

        <div className="col-md-5 offset-md-1 mb-3">
          <form>
            <h5>Suscribete a nuestro boletín</h5>
            <p>
              Resumen mensual de nuestras novedades y descuentos en tus compras
            </p>
            <div className="d-flex flex-column flex-sm-row w-100 gap-2">
              <label htmlFor="newsletter1" className="visually-hidden">Direción de correo electronico</label>
              <input id="newsletter1" type="text" className="form-control" placeholder="Dirección de correo electronico"/>
              <button className="btn btn-primary" type="button">Suscribirse</button>
            </div>
          </form>
        </div>
      </div>
      <div className="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
        <p>© 2023 Company, Inc. All rights reserved.</p>
      </div>
    </footer>
  </div>
  </>  
);
}