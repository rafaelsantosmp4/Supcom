<?php
session_start();
require_once('../conexao/conexao.php');

$db = new BancodeDados();
$db->conecta();

$id = $_SESSION['id'];

$query = "SELECT banner_perfil FROM usuarios WHERE id_usuario = '$id'";
$result = mysqli_query($db->con, $query);
$foto = mysqli_fetch_assoc($result)['banner_perfil'];

if ($foto) {
    header("Content-type: image/png");
    echo $foto;
} else {
    header("Content-type: image/jpeg");
    echo file_get_contents('../medias/iconpfp.jpg');
}

$db->fechar();
?>
