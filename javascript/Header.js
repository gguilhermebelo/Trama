function createHeader() {
  const headerHTML = `
    <header>
    <div class="logo">
        <a href="../SemLogin/index.html"><img src="../Imagens/trama_logo.png"></a>
    </div>
    <div class="hamburger-menu">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
    <ul>
        <li><a class="navlink" href="../SemLogin/index.html">SOBRE</a></li>
        <li><a class="navlink" href="../SemLogin/Marcas.html">NOSSAS MARCAS</a></li>
        <li><a class="navlink" href="../SemLogin/sustentabilidade.html">SUSTENTABILIDADE</a></li>
    </ul>

    <a href="../Login/login.html">
        <button class="login-btn">LOGIN</button>
    </a>
  `;

  document.body.insertAdjacentHTML('afterbegin', headerHTML);

  const style = document.createElement('style');
  style.textContent = `
    header {
      height: 100px;
      width: 100%;
      position: fixed;
      top: 0;
      background-color: #fff;
      z-index: 1000;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px; /* Adicionado espaçamento interno */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    ul {
      margin: 0;
      padding: 0;
      list-style: none;
      display: flex;
      justify-content: flex-start; /* Alinhar os links à esquerda */
      flex-grow: 1; /* Os links ocuparão o espaço restante */
    }
    li {
      padding: 15px;
    }
    .logo {
      height: 75px;
      margin-right: 50px; /* Move a logo para a direita */
      margin-left: 50px;
      margin-top: 15px;
      margin-bottom: 15px;
    }
    .logo img {
      height: 100%;
    }
    .navlink {
      color: #2c2c2c;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      text-transform: uppercase;
      text-decoration: none;
      letter-spacing: .25em;
      position: relative;
    }
    .navlink:hover::after {
      width: 100%;
      right: 0;
    }
    .navlink::after {
      background: none repeat scroll 0 0 transparent;
      bottom: 2;
      content: "";
      display: block;
      height: 4px;
      right: 0;
      position: absolute;
      background: linear-gradient(to left, #c1d0ab, #eaefea 100%);
      transition: width .5s ease 0s, right .5s ease 0s;
      width: 0;
    }
    .login-btn {
      float: right;
      background-color: #759358;
      border: none;
      color: #fff;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      font-size: 14px;
      font-family: 'Segoe UI', sans-serif; 
      letter-spacing: 2px;
      cursor: pointer;
      border-radius: 20px;
      transition: background-color 0.3s ease;
      margin-right: 80px; /* Adiciona margem à esquerda */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .login-btn:hover {
      background-color: #000;
      color: #eaefea;
    }
  `;
  document.head.appendChild(style);
}

document.addEventListener('DOMContentLoaded', createHeader);
