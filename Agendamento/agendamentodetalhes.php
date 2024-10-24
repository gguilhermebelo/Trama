<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAMA - MODA SUSTENTÁVEL</title>
    <link rel="stylesheet" href="..\Agendamento\agendamentodetalhestyle.css">
    <link rel="icon" href=".\Imagens\trama_logo_small.svg">
    <script src="../javascript/Header.js" defer></script>
    <script src="../javascript/Footer.js" defer></script>
</head>
<body>
<header>
    <div class="logo">
        <a href="../index.html"><img src="../Imagens/trama_logo.png"></a>
    </div>
    <ul>
        <li><a class="navlink" href="../SemLogin/sobre.html">SOBRE</a></li>
        <li><a class="navlink" href="../produtos/visualizar_produtos.php">PRODUTOS</a></li>
        <li><a class="navlink" href="../SemLogin/sustentabilidade.html">SUSTENTABILIDADE</a></li>
    </ul>
</header>

<div class="containerbg">
    <div class="container">
        <?php
        // Inclui o arquivo de configuração do banco de dados
        include_once('../config.php');

        // Verifica se foi fornecido um ID na URL
        if(isset($_GET['id'])) {
            // Obtém o ID do agendamento da URL
            $id = $_GET['id'];

            // Consulta ao banco de dados para recuperar os detalhes do agendamento com o ID fornecido
            $sql = "SELECT * FROM agendamento WHERE id = $id";
            $result = $conexao->query($sql);

            // Verifica se há resultados na consulta
            if ($result->num_rows > 0) {
                // Obtém os dados do agendamento encontrados
                $row = $result->fetch_assoc();
                $nome = $row['nome'];
                $email = $row['email'];
                $telefone = $row['telefone'];
                $endereco = $row['endereco'];
                $data_agendamento = $row['data_agendamento'];
                $status = $row['status'];
                $comentario = $row['comentario'];

                // Exibe os detalhes do agendamento
                echo "<div class='details-container'>";
                echo "<div class='detail'><h5>DETALHES DO AGENDAMENTO</h5></div>";
                echo "<div class='detail'><strong>Nome:</strong> $nome</div>";
                echo "<div class='detail'><strong>Email:</strong> $email</div>";
                echo "<div class='detail'><strong>Telefone:</strong> $telefone</div>";
                echo "<div class='detail'><strong>Endereço:</strong> $endereco</div>";
                echo "<div class='detail'><strong>Data:</strong> $data_agendamento</div>";
                echo "<div class='detail'><strong>Status:</strong> $status</div>";
                echo "<div class='detail'><strong>Comentário:</strong> $comentario</div>";


                echo "</div>";
            } else {
                // Se nenhum detalhe for encontrado para o ID fornecido, exibe uma mensagem
                echo "Nenhum detalhe encontrado.";
            }
            echo '<button class="voltar-button" onclick="window.location.href = \'../Empresa/perfil_empresa.php\';">Voltar</button>';
            // Fecha a conexão com o banco de dados
            $conexao->close();
        } else {
            // Se nenhum ID foi fornecido na URL, exibe uma mensagem informando isso
            echo "ID não fornecido.";
        }
        ?>
    </div>
</div>

<script src="script.js"></script>

</body>
</html>
