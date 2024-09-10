<?php
include('../conexao/conexao.php');
session_start();

$db = new BancodeDados();
$db->conecta();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['id_temp'])) {
        $id_temp = $_SESSION['id_temp'];
        $senha = $_POST['password'];

        $id_temp = mysqli_real_escape_string($db->con, $id_temp);
        $senha = mysqli_real_escape_string($db->con, $senha);

        $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

        $query = "UPDATE usuarios SET senha = '$senha_hashed' WHERE id_usuario = '$id_temp'";

        if (mysqli_query($db->con, $query)) {
            echo "<script>alert('Senha redefinida com sucesso!'); window.location.href='../login/'</script>";
        } else {
            echo "<script>alert('Erro ao atualizar a senha. Tente novamente.'); window.location.href='index.php'</script>";
        }
    } else {
        echo "<script>alert('Sessão expirada ou inválida.'); window.location.href='index.php'</script>";
    }
}

$db->fechar();
?>
