<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id']))
    if($_SESSIO['id']=='empresa'){
        header("Location: ../Login/login.html");
    exit();
}else{header("location: ../Login/login.html");
}


include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
    // Exclui a conta da empresa do banco de dados
    $id = $_SESSION['id'];
    $stmt = $conexao->prepare("DELETE FROM empresas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Limpa a sessão e redireciona para a página de login
    session_unset();
    session_destroy();
    header("Location: ../Login/login.html");
    exit();
} else {
    header("Location: ../Empresa/perfil_empresa.php");
    exit();
}
?>