<?php
    include('../conexao/conexao.php');
    $db = new BancodeDados();
    $db->conecta();

    $id = $_GET['id'];

    $query = "SELECT perfil_foto FROM usuarios WHERE id_usuario = '$id'";
    $result = mysqli_query($db->con, $query);
    $foto = mysqli_fetch_assoc($result)['perfil_foto'];

    header("Content-type: image/png");

    if ($foto) {
        echo $foto;
    } else {
        echo file_get_contents('../medias/iconpfp.jpg');
    }

    $db->fechar();
?>