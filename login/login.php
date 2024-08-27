<?php
include('../conexao/conexao.php');
session_start();

$db = new BancodeDados();
$db->conecta();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $email = mysqli_real_escape_string($db->con, $email);
    $senha = mysqli_real_escape_string($db->con, $senha);

    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($db->con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['log'] = 'ativo';
            $_SESSION['id'] = $usuario['id_usuario'];
            echo "<script>window.location.href='../home/'</script>";
        } else {
            echo "<script>alert('Senha incorreta.'); window.location.href='index.php'</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado. Email incorreto.'); window.location.href='index.php'</script>";
    }
}

$db->fechar();
?>
