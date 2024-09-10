<?php
session_start();
require_once('../conexao/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new BancodeDados();
    $db->conecta();
    
    $id = $_SESSION['id'];

    if (isset($_POST['croppedImage'])) {
        $croppedImageDataURL = $_POST['croppedImage'];

        if (preg_match('/^data:image\/(jpg|jpeg|png);base64,/', $croppedImageDataURL, $matches)) {
            $imageType = $matches[1];
            $imageData = str_replace('data:image/' . $imageType . ';base64,', '', $croppedImageDataURL);
            $imageData = base64_decode($imageData);

            if ($imageData === false) {
                $errorMessage = 'Falha ao decodificar a imagem.';
            } else {
                $fotoBlob = addslashes($imageData);

                $query = "UPDATE usuarios SET perfil_foto = '$fotoBlob' WHERE id_usuario = '$id'";
                if (mysqli_query($db->con, $query)) {
                    echo "<script>window.location.href = 'index.php';</script>";
                } else {
                    $errorMessage = 'Erro ao atualizar foto de perfil: ' . mysqli_error($db->con);
                }
            }
        } else {
            $errorMessage = 'Formato de imagem inválido.';
        }

        if (isset($errorMessage)) {
            echo "<script>alert('$errorMessage'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Nenhuma imagem cortada recebida.'); window.location.href = 'index.php';</script>";
    }

    $db->fechar();
}
?>
