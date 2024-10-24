<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRAMA - MODA SUSTENTÁVEL</title>
    <link rel="stylesheet" href="..\Agendamento\agendamentoadminstyle.css">
    <link rel="icon" href="../imagens/trama_logo_small.svg">
    <script src="../javascript/headerCliente.js" defer></script>
    <script src="../javascript/menuscript.js" defer></script>
    <script src="..\javascript\Footer.js" defer></script>
</head>
<?php
include_once('../config.php');

session_start();
?>
    <br>
    <br>
<body>

<div class="container">
    <h1>Seu Pedido</h1>

    <?php
// Verifica se há produtos no carrinho
if(isset($_SESSION["carrinho"]) && count($_SESSION["carrinho"]) > 0) {
    // Obtém os IDs dos produtos do carrinho
    $carrinho_ids = implode(",", array_keys($_SESSION["carrinho"]));

    // Constrói a consulta SQL para selecionar os produtos do carrinho
    $sql = "SELECT * FROM produtos WHERE id IN ($carrinho_ids)";
    $result = $conexao->query($sql);

    $total = 0; // Inicializa o total a ser pago

    // Verifica se há resultados na consulta
    if ($result->num_rows > 0) {
        echo "<div class='pedido-info'>"; // Inicia uma div para exibir as informações do pedido
        echo "<h2>Itens do Pedido:</h2>"; // Título para os itens do pedido
        echo "<ul>"; // Inicia uma lista não ordenada para os itens
        // Loop para cada produto do carrinho
        while($row = $result->fetch_assoc()) {
            // Calcula o subtotal do item (quantidade * preço)
            $subtotal = $_SESSION["carrinho"][$row["id"]] * $row["preco"];
            // Soma o subtotal ao total geral
            $total += $subtotal;
            // Exibe o nome do produto, quantidade, subtotal
            echo "<li>" . $row["nome"] . " - " . $_SESSION["carrinho"][$row["id"]] . "x - Subtotal: R$ " . number_format($subtotal, 2, ',', '.') . "</li>";
        }
        echo "</ul>"; // Fecha a lista de itens
        // Exibe o total dos itens
        echo "<p>Total dos Itens: R$ " . number_format($total, 2, ',', '.') . "</p>";
        // Exibe o valor fixo do frete
        echo "<p>Frete fixo para todo Brasil: R$ 15,00</p>";
        // Adiciona o valor do frete ao total geral
        $total += 15; 
        // Exibe o total a ser pago, incluindo o frete
        echo "<p><strong>Total a Pagar: R$ " . number_format($total, 2, ',', '.') . "</strong></p>";
        echo "</div>"; // Fecha a div para as informações do pedido
    } else {
        echo "<p>Nenhum produto encontrado no carrinho.</p>"; // Se não houver produtos no carrinho, exibe essa mensagem
    }
} else {
    echo "<p>Seu carrinho está vazio.</p>"; // Se o carrinho estiver vazio, exibe essa mensagem
}

    ?>

    <h2>Informações de Entrega:</h2>
    <form action="processarpedido.php" method="post">
        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" required><br>
        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" required><br>
        <label for="complemento">Complemento:</label>
        <input type="text" id="complemento" name="complemento"><br>
        <label for="logradouro">Logradouro:</label>
        <input type="text" id="logradouro" name="logradouro" required><br>
        <label for="numero">Número:</label>
        <input type="text" id="numero" name="numero" required><br>

        <h2>Forma de Pagamento:</h2>
        <input type="radio" id="pix" name="pagamento" value="pix" required>
        <label for="pix">PIX</label><br>
        <input type="radio" id="cartao" name="pagamento" value="cartao">
        <label for="cartao">Cartão de Crédito</label><br>
        <input type="radio" id="boleto" name="pagamento" value="boleto">
        <label for="boleto">Boleto Bancário</label><br>
        
        <input type="submit" value="Finalizar Compra">
    </form>
</div>
</body>
</html>

<?php
$conexao->close();
?>