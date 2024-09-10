<?php
include('../conexao/conexao.php');
session_start();

$db = new BancodeDados();
$db->conecta();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cnpj = $_POST['cnpj'];
    $telefone = $_POST['tel'];

    $nome = mysqli_real_escape_string($db->con, $nome);
    $email = mysqli_real_escape_string($db->con, $email);
    $cnpj = mysqli_real_escape_string($db->con, $cnpj);
    $telefone = mysqli_real_escape_string($db->con, $telefone);

    $query = "SELECT * FROM usuarios WHERE nome = '$nome' AND email = '$email' AND cnpj = '$cnpj' AND telefone = '$telefone'";
    $result = mysqli_query($db->con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);
        $_SESSION['id_temp'] = $usuario['id_usuario'];
        $_SESSION['nome_temp'] = $usuario['nome'];
        echo "<script>window.location.href='redefinir.php'</script>";
    } else {
        echo "<script>alert('Informações incorretas ou usuário não encontrado.'); window.location.href='index.php'</script>";
    }
}

$db->fechar();
?>