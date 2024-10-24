<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id']))
    if($_SESSIO['id']=='cliente'){
        header("Location: ../Login/login.html");
    exit();
}else{header("location: ../Login/login.html");
}

include("../config.php");
?>
<!DOCTYPE html>
<html lang="PT-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TRAMA - MODA SUSTENTÁVEL</title>
  <link rel="stylesheet" href="../SemLogin/novidadesstyle.css">
  <link rel="icon" href="../Imagens/trama_logo_small.svg">
  <script src="../javascript/headerCliente.js" defer></script>
  <script src="../javascript/Footer.js" defer></script>
  <script src="../javascript/menuscript.js" defer></script>
</head>
<body>

<div class="lancamento">
  <p>PRODUTOS</p><br><br> 
    <div class="destaques">
      <?php include_once("../produtos/produtoslogado.php"); ?>
    </div>
</div>

<div vw class="enabled">
  <div vw-access-button class="active"></div>
  <div vw-plugin-wrapper>
    <div class="vw-plugin-top-wrapper"></div>
  </div>
</div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
  new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>

</body>
</html>
