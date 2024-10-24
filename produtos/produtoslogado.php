<?php
// Conexão com o banco de dados
include_once('../config.php');

// Consulta para selecionar todos os produtos do banco de dados
$sql = "SELECT * FROM produtos";
$result = $conexao->query($sql);

// Verifica se há produtos
if ($result->num_rows > 0) {
    // Exibe os produtos
    while($row = $result->fetch_assoc()) {
        echo '<div class="destaques">';
        echo '<div class="produtinho">';
        echo '<img src="../uploads/' . $row['imagem'] . '" alt="">';
        echo '<h2>' . $row['nome'] . '</h2>';
        echo '<p>' . $row['marca'] . '</p>';
        echo '<p>' . $row['descricao'] . '</p>';
        echo '<h3>R$ ' . number_format($row['preco'], 2, ',', '.') . '</h3>';
        echo '<form action="../Carrinho/adicionar_carrinho.php" method="post">';
        echo '<input type="hidden" name="produto_id" value="' . $row['id'] . '">';
        echo '<input type="submit" value="Adicionar ao Carrinho">';
        echo '</form>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "Nenhum produto encontrado.";
}
// Fecha a conexão
$conexao->close();
?>
