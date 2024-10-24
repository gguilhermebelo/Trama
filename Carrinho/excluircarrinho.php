<?php
include_once('../config.php');

session_start();

// Verifica se o ID do produto está definido e se é um número válido
if(isset($_GET["produto_id"]) && is_numeric($_GET["produto_id"])) {
    $produto_id = $_GET["produto_id"];

    // Remove o item do carrinho na sessão
    if(isset($_SESSION["carrinho"][$produto_id])) {
        unset($_SESSION["carrinho"][$produto_id]);
    }

    // Remove o item do carrinho no banco de dados
    $stmt = $conexao->prepare("DELETE FROM carrinho WHERE produto_id = ?");
    $stmt->bind_param("i", $produto_id);
    if($stmt->execute()) {
        // Redireciona de volta para o carrinho após a remoção
        header("Location: carrinho.php");
        exit();
    } else {
        echo "Erro ao remover o item do carrinho: " . $stmt->error;
    }
} else {
    echo "ID de produto inválido.";
}

$conexao->close();
?>
