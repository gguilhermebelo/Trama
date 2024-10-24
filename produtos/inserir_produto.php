<?php
include_once('../config.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Prepara os dados para inserção (escape contra injeção de SQL)
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $marca = mysqli_real_escape_string($conexao, $_POST['marca']);
    $preco = floatval($_POST['preco']); // Converte para float
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $imagem = $_FILES['imagem']['name']; // Nome do arquivo de imagem

    // Move a imagem para a pasta uploads
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
    move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file);

    // Insere os dados no banco de dados
    $sql = "INSERT INTO produtos (nome, marca, preco, imagem, descricao) VALUES ('$nome', '$marca', '$preco', '$imagem', '$descricao')";


    if ($conexao->query($sql) === TRUE) {
        header("Location: ../produtos/colocarprodutos.html");
        exit; // Certifique-se de sair do script após o redirecionamento
    } else {
        echo "Erro ao inserir o produto: " . $conexao->error;
    }

    // Fecha a conexão
    $conexao->close();
}
?>

