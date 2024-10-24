<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAMA - MODA SUSTENTÁVEL</title>
    <link rel="stylesheet" href="..\SemLogin\novidadesstyle.css">
    <link rel="icon" href="..\imagens\trama_logo_small.svg">
    <script src="..\javascript\headerProduto.js" defer></script>
    <script src="..\javascript\Footer.js" defer></script>
</head>
<body>


<div class="containerbg">
    <div class="container">
        <BR>
        <div class="title">
            <p>SEUS PRODUTOS</p><br>
        </div>
            <?php
            include_once('../config.php');

            session_start();

            // Verifica se foi solicitada a exclusão de algum produto
            if(isset($_GET['delete_id'])) {
                $id = $_GET['delete_id'];
        
    
                $sql_delete = "DELETE FROM produtos WHERE id = $id";
        
                if ($conexao->query($sql_delete) === TRUE) {
                    echo "Produto excluído com sucesso.";
                } else {
                    echo "Erro ao excluir o produto: " . $conexao->error;
                }
            }


            $sql = "SELECT * FROM produtos";
            $resultado = $conexao->query($sql);

            if ($resultado->num_rows > 0) {
                        // Exibe os dados de cada produto
                while($row = $resultado->fetch_assoc()) {
                    echo "<div class=","produtinho",">";
                    echo "<img src='../uploads/" . $row['imagem'] . "' width='200'><br>";
                    echo "<h1>" . $row['nome'] . "</h1>";
                    echo "<h2>" . $row['marca'] . "</h2>";
                    echo "<h4>" . $row['descricao'] . "</h4>";
                    echo "<h5>R$" . number_format($row['preco'], 2, ',', '.') . "</h5>";
                    echo "<a href='?delete_id=" . $row['id'] . "'>EXCLUIR</a><br><br></div>"; 
                }
            } else {
                echo "Nenhum produto encontrado.";
            }
                echo " <br><br><div class=","voltar-btn",">
                               <a href='../produtos/colocarprodutos.html'>VOLTAR</a>
                       </div><br><Br>";

            $conexao->close();
            ?>

    </div>
</div>
</body>
</html>