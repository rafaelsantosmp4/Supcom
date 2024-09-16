<?php
session_start();
require_once('../conexao/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new BancodeDados();
    $db->conecta();

    $id_produto = $_POST['id_produto_hidden'];

    $query = "DELETE FROM `produto` WHERE id_produto = '$id_produto'";
    if (mysqli_query($db->con, $query)) {
        echo "<script>window.location.href = '../forns/';</script>";
    } else {
        echo "<script>alert('Erro ao excluir produto: " . mysqli_error($db->con) . "'); window.location.href = 'index.php';</script>";
    }

    $db->fechar();
}
?>