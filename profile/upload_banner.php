<?php
session_start();
require_once('../conexao/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new BancodeDados();
    $db->conecta();
    
    $id = $_SESSION['id'];
    $response = [];

    if (isset($_POST['croppedBannerImage'])) {
        $croppedBannerImageData = $_POST['croppedBannerImage'];
        if (!empty($croppedBannerImageData)) {
            $fotoBlob = base64_decode($croppedBannerImageData);
            if ($fotoBlob === false) {
                $response['status'] = 'error';
                $response['message'] = 'Erro ao processar a imagem cortada.';
            } else {
                $fotoBlob = addslashes($fotoBlob);
                $query = "UPDATE usuarios SET banner_perfil = '$fotoBlob' WHERE id_usuario = '$id'";
                if (mysqli_query($db->con, $query)) {
                    $response['status'] = 'success';
                    $response['message'] = 'Banner atualizado com sucesso!';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Erro ao atualizar o banner: ' . mysqli_error($db->con);
                }
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Imagem cortada está vazia.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Erro - imagem maior que 8MB!';
    }

    $db->fechar();
    echo json_encode($response);
}