<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho</title>
    <link rel="stylesheet" href="carrinhostyle.css">
    <link rel="icon" href="../Imagens/trama_logo_small.svg">
    <script src="../javascript/headerCliente.js" defer></script>
</head>
<body>

<div class="bg">
    <div class="container">
        <h1>MEU CARRINHO</h1><br>

        <?php
            session_start();
            if (!isset($conexao)) {
                // Definir as variáveis de conexão com o banco de dados
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "trama";
    
                // Criar a conexão
                $conexao = new mysqli($servername, $username, $password, $dbname);
    
                // Verificar a conexão
                if ($conexao->connect_error) {
                    die("Conexão falhou: " . $conexao->connect_error);
                }
            }

            // Verifica se há produtos no carrinho
            if (isset($_SESSION["carrinho"]) && count($_SESSION["carrinho"]) > 0) {
                $carrinho_ids = implode(",", array_keys($_SESSION["carrinho"])); // Usamos array_keys para obter apenas os IDs dos produtos

                // Constrói a consulta SQL após definir $carrinho_ids
                $sql = "SELECT * FROM produtos WHERE id IN ($carrinho_ids)";
                $result = $conexao->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='item-carrinho'>";
                        echo "<img src='../uploads/" . $row["imagem"] . "' alt=''>";
                        echo "<h2>" . $row["nome"] . "</h2>";
                        echo "<p>" . $row["marca"] . "</p>";
                        echo "<h3>R$ " . $row["preco"] . "</h3>";
                        echo "<form action='editarcarrinho.php' method='post'>";
                        echo "<input type='hidden' name='produto_id' value='" . $row["id"] . "'>";
                        echo "<input type='number' name='quantidade' value='" . $_SESSION["carrinho"][$row["id"]] . "' min='1'><br><br>";
                        echo "<input type='submit' name='atualizar' value='Atualizar Quantidade'>";
                        echo "</form>";
                        // Formulário para exclusão
                        echo "<form action='excluircarrinho.php' method='GET'>";
                        echo "<input type='hidden' name='produto_id' value='" . $row["id"] . "'>";
                        echo "<input type='submit' name='remover' value='Remover do Carrinho'>";
                        echo "</form>";
                        echo "</div>";
                        echo "<a href='../Cliente/feed.php'>Voltar ao Feed</a>";
                    }
                } else {
                    echo "Nenhum produto encontrado no carrinho.";
                }
            } else {
                echo "<br>Seu carrinho está vazio. <br><a href='../Cliente/feed.php'>Voltar ao Feed</a><br>";
            }
            ?>

            <a href='../Pedido/pedido.php'><button class="botao">Finalizar Compra</button></a>

            <?php
             $conexao->close();
            ?>

    </div>
</div>
</body>
</html>