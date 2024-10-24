<?php
// Conexão com o banco de dados
include ("../config.php");

// Função para verificar se o CPF já está cadastrado
function verificaCPF($cpf) {
    global $conexao;
    $sql = "SELECT COUNT(*) FROM clientes WHERE cpf = '$cpf'";
    $result = $conexao->query($sql);
    $row = $result->fetch_assoc();
    return $row['COUNT(*)'] > 0;
}

// Função para verificar se o CNPJ já está cadastrado
function verificaCNPJ($cnpj) {
    global $conexao;
    $sql = "SELECT COUNT(*) FROM empresas WHERE cnpj = '$cnpj'";
    $result = $conexao->query($sql);
    $row = $result->fetch_assoc();
    return $row['COUNT(*)'] > 0;
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['tipo'];
    
    if ($tipo == "cliente") {
        // Coleta os dados do formulário
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $tel = $_POST['tel'];
        $senha = $_POST['senha']; // Senha sem criptografia
        
        // Criptografa a senha
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
        
        // Verifica se o CPF já está cadastrado
        if (verificaCPF($cpf)) {
            echo "<script>alert('CPF já cadastrado.');window.location.href = '../Cadastro/cadastro.html';</script>";
        } else {
            // Insere os dados no banco de dados
            $sql = "INSERT INTO clientes (nome, sobrenome, email, tel, cpf, senha) VALUES ('$nome', '$sobrenome', '$email', '$tel', '$cpf', '$senhaCriptografada')";
            if ($conexao->query($sql) === TRUE) {
                echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href = '../Login/login.html';</script>";
            } else {
                echo "Erro: " . $conexao->error;
            }
        }
    } else if ($tipo == "empresa") {
        // Recebe os dados do formulário
        $cnpj = $_POST['cnpj'];
        $RazaoSoci = $_POST['RazaoSoci'];
        $NomeFanta = $_POST['NomeFanta'];
        $email = $_POST['email'];
        $senha = $_POST['senha']; // Senha sem criptografia
        $tel = $_POST['tel'];
        
        // Criptografa a senha
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
        
        // Verifica se o CNPJ já está cadastrado
        if (verificaCNPJ($cnpj)) {
            echo "<script>alert('CNPJ já cadastrado.');window.location.href = '../Cadastro/cadastro.html';</script>";
        } else {
            // Insere os dados no banco de dados
            $sql = "INSERT INTO empresas (cnpj, RazaoSoci, NomeFanta, tel, email, senha) VALUES ('$cnpj', '$RazaoSoci', '$NomeFanta', '$tel', '$email', '$senhaCriptografada')";
            if ($conexao->query($sql) === TRUE) {
                echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href = '../Login/login.html';</script>";
            } else {
                echo "Erro: " . $conexao->error;
            }
        }
    }
}
?>
