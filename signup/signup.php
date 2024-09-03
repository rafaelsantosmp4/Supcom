<?php
include('../conexao/conexao.php');

$db = new BancodeDados();
$db->conecta();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cnpj = $_POST['cnpj'];
    $telefone = $_POST['tel'];
    $senha = $_POST['password'];
    $tipo_conta = $_POST['tipoconta'] == 'forn' ? 'fornecedor' : 'lojista';

    $nome = mysqli_real_escape_string($db->con, $nome);
    $email = mysqli_real_escape_string($db->con, $email);
    $cnpj = mysqli_real_escape_string($db->con, $cnpj);
    $telefone = mysqli_real_escape_string($db->con, $telefone);
    $senha = mysqli_real_escape_string($db->con, $senha);

    $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

    $query = "INSERT INTO Usuarios (nome, bio, email, senha, cnpj, telefone, tipo_usuario) VALUES ('$nome', NULL, '$email', '$senha_hashed', '$cnpj', '$telefone', '$tipo_conta')";

    if (mysqli_query($db->con, $query)) {
        echo "<script>window.location.href='../login/'</script>";
    } else {
        echo "<script>alert('Já existe uma conta cadastrada com esse email, CNPJ ou telefone!'); window.location.href='index.php'</script>";
    }
}

$db->fechar();
?>