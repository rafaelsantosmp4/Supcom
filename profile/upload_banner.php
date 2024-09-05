<?php
session_start();
require_once('../conexao/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new BancodeDados();
    $db->conecta();
    
    $id = $_SESSION['id'];

    if (isset($_POST['croppedBannerImage'])) {
        $croppedBannerImageData = $_POST['croppedBannerImage'];
        if (!empty($croppedBannerImageData)) {
            $fotoBlob = base64_decode($croppedBannerImageData);
            if ($fotoBlob === false) {
                $errorMessage = 'Erro ao processar a imagem cortada.';
                echo "<script>alert('$errorMessage'); window.location.href = 'index.php';</script>";
                exit;
            }
            $fotoBlob = addslashes($fotoBlob);

            $query = "UPDATE usuarios SET banner_perfil = '$fotoBlob' WHERE id_usuario = '$id'";
            if (mysqli_query($db->con, $query)) {
                echo "<script>window.location.href = 'index.php';</script>";
            } else {
                $errorMessage = 'Erro ao atualizar foto de perfil: ' . mysqli_error($db->con);
                echo "<script>alert('$errorMessage'); window.location.href = 'index.php';</script>";
            }
        } else {
            echo "<script>alert('Imagem cortada está vazia.'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Erro - imagem maior que 8MB!'); window.location.href = 'index.php';</script>";
    }

    $db->fechar();
}
?>
