<?php
include_once('config.php');

// Corrigir o nome da variável de conexão para $conexao
$sql = "SELECT * FROM produtos";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='produtinho'>";
        echo "<img src='" . $row["imagem"] . "' alt=''>";
        echo "<h2>" . $row["nome"] . "</h2>";
        echo "<p>" . $row["marca"] . "</p>";
        echo "<h3>R$ " . $row["preco"] . "</h3>";
        echo "<form action='../carrinho/adicionar_carrinho.php' method='post' enctype='multipart/form-data'>";
        echo "<input type='hidden' name='produto_id' value='" . $row["id"] . "'>";
        echo "<input type='submit' value='Adicionar ao Carrinho'>";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "0 resultados";
}

$conexao->close();
?>
