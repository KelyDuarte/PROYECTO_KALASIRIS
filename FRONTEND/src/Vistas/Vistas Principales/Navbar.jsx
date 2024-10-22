import "./././Styles.css";
import Logo from "../../Imagenes/PRINCIPAL/LOGO.png";
import Login from "../../Imagenes/PRINCIPAL/LOGIN.png"

export function Navegacion() {
  
  return (
    <>
    <a href="/">
     <img src={Logo} class="rounded mx-auto d-block"  alt=""/>
    </a>  
    <header>
      <h6>Envios GRATIS por compras superiores a $100.000 🚚</h6>
    </header>

    <nav className="navbar navbar-expand-lg bg-body-tertiary">
      <div className="container-fluid">
        <a className="navbar-brand" href="#"></a>
        <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span className="navbar-toggler-icon"></span>
        </button>

        <div className="collapse navbar-collapse" id="navbarSupportedContent">
          <ul className="navbar-nav mx-auto mb-2 mb-lg-0">
                  <li className="nav-item dropdown">
                    <a className="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Mujer
                    </a>
                    <ul className="dropdown-menu">
                      <li><a className="dropdown-item" href="/Camisas_Mujer">Camisas</a></li>
                      <li><a className="dropdown-item" href="/Camisetas_Mujer">Camisetas</a></li>
                    </ul>
                  </li>

                  <li className="nav-item dropdown">
                    <a className="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Hombre
                    </a>
                    <ul class="dropdown-menu">
                      <li><a className="dropdown-item" href="/Camisas_Hombre">Camisas</a></li>
                      <li><a className="dropdown-item" href="/Camisetas_Hombre">Camisetas</a></li>
                    </ul>
                  </li>

                  <li className="nav-item dropdown">
                    <a className="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Niños
                    </a>
                    <ul className="dropdown-menu">
                      <li><a className="dropdown-item" href="/Camisas_Niños">Camisas</a></li>
                      <li><a className="dropdown-item" href="/Camisetas_Niños">Camisetas</a></li>
                    </ul>
                  </li>

                  <li className="nav-item dropdown">
                    <a className="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Niñas
                    </a>
                    <ul class="dropdown-menu">
                      <li><a className="dropdown-item" href="/Camisas_Niñas">Camisas</a></li>
                      <li><a className="dropdown-item" href="/Camisetas_Niñas">Camisetas</a></li>
                    </ul>
                  </li>

                  <li className="nav-item dropdown">
                    <a className="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Ofertas
                    </a>
                    <ul class="dropdown-menu">
                      <li><a className="dropdown-item" href="/Camisas_Oferta">Camisas</a></li>
                      <li><a className="dropdown-item" href="/Camisetas_Oferta">Camisetas</a></li>
                    </ul>
                  </li>
                  <div className="Login">
                <a href="/Login">
                  <img src={Login} width="50px" height="50px"/>
                </a>
                </div>
          </ul>
        </div>
      </div>
                          
              </nav>
            </>

  );
}