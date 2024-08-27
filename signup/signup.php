<?php
include('../conexao/conexao.php');

$db = new BancodeDados();
$db->conecta();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cnpj = $_POST['cnpj'];
    $senha = $_POST['password'];
    $tipo_conta = $_POST['tipoconta'] == 'forn' ? 'fornecedor' : 'lojista';

    $nome = mysqli_real_escape_string($db->con, $nome);
    $email = mysqli_real_escape_string($db->con, $email);
    $cnpj = mysqli_real_escape_string($db->con, $cnpj);
    $senha = mysqli_real_escape_string($db->con, $senha);

    $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

    $query = "INSERT INTO Usuarios (nome, email, senha, cnpj, tipo_usuario) VALUES ('$nome', '$email', '$senha_hashed', '$cnpj', '$tipo_conta')";

    if (mysqli_query($db->con, $query)) {
        echo "Conta criada com sucesso!";
    } else {
        echo "Erro ao criar a conta: " . mysqli_error($db->con);
    }
}

$db->fechar();
?>
