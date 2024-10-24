function createFooter() {
    console.log("createFooter function called"); // Log inicial

    const footerHTML = `
      <footer class="text-center footer">
        <div class="footerbox">
          <div class="footerblock">
            <div class="nomeempresa">
              <h4>TRAMA</h4>
              <p><br>RUA DA GLÓRIA, 372, SALA 505 CURITIBA, PARANÁ<br><b>(41) 99139-9175</b></p>
            </div>
            <div class="copyright">
              <p>Copyright © 2023. Criado por Camila Araújo, Guilherme Belo, Yasmin Carmona & Juliano Detiuk.</p>
            </div>
          </div>
        </div>
      </footer>
    `;

    console.log("Footer HTML created");

    document.body.insertAdjacentHTML('beforeend', footerHTML);
    console.log("Footer HTML inserted into the document");

    const style = document.createElement('style');
    style.textContent = `
      .footer {
        color: #2c2c2c;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        width: 100%;
        text-align: center;
        background-image: url("/trama/Imagens/background2.png");
      }
      .footerblock {
        margin: 0;
      }
      .nomeempresa h4 {
        font-size: 25px;
        font-weight: 500;
        padding-top: 20px;
        margin-bottom: -20px;
      }
      .nomeempresa p {
        font-size: 15px;
        padding-bottom: 20px;
        padding-top: -10px;
      }
      .copyright {
        font-size: 10px;
        padding-bottom: 10px;
      }
    `;
    document.head.appendChild(style);
    console.log("Footer styles appended to the document head");
}

document.addEventListener('DOMContentLoaded', createFooter);
console.log("DOMContentLoaded event listener added for footer");
