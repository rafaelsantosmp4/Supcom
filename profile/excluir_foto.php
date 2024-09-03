<?php
session_start();
require_once('../conexao/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new BancodeDados();
    $db->conecta();

    $id = mysqli_real_escape_string($db->con, $_SESSION['id']);

    $query = "UPDATE usuarios SET perfil_foto = NULL WHERE id_usuario = '$id'";
    if (mysqli_query($db->con, $query)) {
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir foto de perfil: " . mysqli_error($db->con) . "'); window.location.href = 'index.php';</script>";
    }

    $db->fechar();
}
?>