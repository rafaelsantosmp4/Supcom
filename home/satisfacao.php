<?php
include('../conexao/conexao.php');
session_start();

$db = new BancodeDados();
$db->conecta();
$con = $db->con;

$iduser = $_SESSION['id'];
$emocaoValor = $_POST['emocaoSelecionada'];

$query = "UPDATE usuarios SET satisfacao = '$emocaoValor' WHERE id_usuario = '$iduser'";
$result = mysqli_query($db->con, $query);

if ($result) {
    echo "Sucesso!";
} else {
    echo "Erro ao atualizar os dados.";
}
?>