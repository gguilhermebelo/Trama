<?php
include_once('../config.php');

session_start();

if(isset($_POST["produto_id"]) && !empty($_POST["produto_id"])) {
    $produto_id = $_POST["produto_id"];

    // Verifica se o produto já está no carrinho
    if(isset($_SESSION["carrinho"][$produto_id])) {
        $_SESSION["carrinho"][$produto_id] += 1;
    } else {
        $_SESSION["carrinho"][$produto_id] = 1;
    }

    // Verifica se uma imagem foi enviada
    $caminho_arquivo = ""; // Inicializa a variável $caminho_arquivo

    if(isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
        $nome_arquivo = $_FILES["imagem"]["name"];
        $caminho_arquivo = "../uploads/" . $nome_arquivo;

        // Move a imagem para o diretório de uploads
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho_arquivo);
    }

    // Verifica se o produto já está no carrinho no banco de dados
    $sql_select = "SELECT * FROM carrinho WHERE produto_id = '$produto_id'";
    $result_select = $conexao->query($sql_select);

    if ($result_select->num_rows > 0) {
        // Se o produto já estiver no carrinho, apenas atualiza a quantidade
        $sql_update = "UPDATE carrinho SET quantidade = quantidade + 1 WHERE produto_id = '$produto_id'";
        if ($conexao->query($sql_update) === TRUE) {
            header("Location: ../Cliente/feed.php");
            exit();
        } else {
            header("Location: ../Cliente/feed.php?error=db_error");
            exit();
        }
    } else {
        // Se o produto não estiver no carrinho, insere o produto no carrinho
        $sql_insert = "INSERT INTO carrinho (produto_id, quantidade, produto_imagem) VALUES ('$produto_id', 1, '$caminho_arquivo')";
        if ($conexao->query($sql_insert) === TRUE) {
            header("Location: ../Cliente/feed.php");
            exit();
        } else {
            header("Location: ../Cliente/feed.php?error=db_error");
            exit();
        }
    }
} else {
    header("Location: ../Cliente/feed.php");
    exit();
}
?>