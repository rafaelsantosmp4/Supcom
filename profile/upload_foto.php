<?php
session_start();
require_once('../conexao/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new BancodeDados();
    $db->conecta();
    
    $id = $_SESSION['id'];
    $response = [];

    if (isset($_POST['croppedImage'])) {
        $croppedImageDataURL = $_POST['croppedImage'];

        if (preg_match('/^data:image\/(jpg|jpeg|png);base64,/', $croppedImageDataURL, $matches)) {
            $imageType = $matches[1];
            $imageData = str_replace('data:image/' . $imageType . ';base64,', '', $croppedImageDataURL);
            $imageData = base64_decode($imageData);

            if ($imageData === false) {
                $response['status'] = 'error';
                $response['message'] = 'Falha ao decodificar a imagem.';
            } else {
                $fotoBlob = addslashes($imageData);

                $query = "UPDATE usuarios SET perfil_foto = '$fotoBlob' WHERE id_usuario = '$id'";
                if (mysqli_query($db->con, $query)) {
                    $response['status'] = 'success';
                    $response['message'] = 'Foto de perfil atualizada com sucesso!';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Erro ao atualizar foto de perfil: ' . mysqli_error($db->con);
                }
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Formato de imagem inválido.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'A imagem deve ser menor que 8MB.';
    }

    $db->fechar();
    echo json_encode($response);
}