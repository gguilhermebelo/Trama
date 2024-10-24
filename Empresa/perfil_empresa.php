<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id']))
    if($_SESSIO['id']=='empresa'){
        header("Location: ../Login/login.html");
    exit();
}else{header("location: ../Login/login.html");
}

// Conexão com o banco de dados
include ('../config.php');

// Obtém informações da empresa
$id = $_SESSION['id'];
$stmt = $conexao->prepare("SELECT * FROM empresas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$cnpj_formatado = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $row['cnpj']);
$telefone_formatado = preg_replace('/(\d{2})(\d{4,5})(\d{4})/', '($1) $2-$3', $row['tel']);


?>

<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAMA - MODA SUSTENTÁVEL</title>
  <link rel="stylesheet" href="../SemLogin/perfilstyle.css">
  <link rel="icon" href="..\imagens\trama_logo_small.svg">
  <script src="..\javascript\headerProduto.js" defer></script>
  <script src="..\javascript\menuscript.js" defer></script>
</head>
<body>

<div class="containerbg">
    <div class="container">
        <div class="title">
            <h5>SEU PERFIL</h5>
        </div>
        <div class="information">
            <h1><p>Bem-vindo, <?php echo $row['RazaoSoci']; ?>!</p> </h1>    
            <h3><b>INFORMAÇÕES DA EMPRESA</b></h3>
            <p><b>RAZÃO SOCIAL:</b> <?php echo $row['RazaoSoci']; ?></p>
            <p><b>NOME FANTASIA:</b> <?php echo $row['NomeFanta']; ?></p>
            <p><b>CNPJ:</b> <?php echo $cnpj_formatado; ?></p>
            <h3><b>INFORMAÇÕES DE CONTATO</b></h3>
            <p><b>E-MAIL:</b> <?php echo $row['email']; ?></p>
            <p><b>TELEFONE:</b> <?php echo $telefone_formatado; ?></p>
            <br>
        </div>
        <!-- Botões de logout -->
        <div class="inline-buttons">
            <a href="../Empresa/empresaeditar.php"><button class="logout">EDITAR</button></a>
            <a href="../Agendamento/agendamentoindex.php"><button class="logout">AGENDAR VISITA</button></a>
            <a href="../Agendamento/agendamentodetalhes.php?id=''"><button class="logout">DETALHES DO AGENDAMENTO</button></a>
            <a href="../SemLogin/index.html"><button class="logout">LOGOUT</button></a>
        </div>
    </div>
</div>
<!-- FIM LOGOUT -->

</body>
</html>
