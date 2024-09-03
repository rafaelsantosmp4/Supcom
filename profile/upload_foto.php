<?php
session_start();
require_once('../conexao/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new BancodeDados();
    $db->conecta();
    
    $id = $_SESSION['id'];

    if (isset($_FILES['picture__input'])) {
        $foto = $_FILES['picture__input'];
        $fotoError = $foto['error'];
        $fotoSize = $foto['size'];
        $maxSize = 2 * 1024 * 1024; // 2MB em bytes

        if ($fotoError === UPLOAD_ERR_OK) {
            if ($fotoSize > $maxSize) {
                $errorMessage = 'O arquivo é maior que 2MB.';
            } else {
                $fotoTmpName = $foto['tmp_name'];
                $fotoBlob = addslashes(file_get_contents($fotoTmpName));

                $query = "UPDATE usuarios SET perfil_foto = '$fotoBlob' WHERE id_usuario = '$id'";
                if (mysqli_query($db->con, $query)) {
                    echo "<script>window.location.href = 'index.php';</script>";
                } else {
                    $errorMessage = 'Erro ao atualizar foto de perfil: ' . mysqli_error($db->con);
                }
            }
        } else {
            $uploadErrors = [
                UPLOAD_ERR_INI_SIZE   => 'O arquivo excede o tamanho máximo permitido.',
                UPLOAD_ERR_FORM_SIZE  => 'O arquivo excede o tamanho máximo permitido.',
                UPLOAD_ERR_PARTIAL    => 'O arquivo foi parcialmente carregado.',
                UPLOAD_ERR_NO_FILE    => 'Nenhum arquivo foi enviado.',
                UPLOAD_ERR_NO_TMP_DIR => 'Falta a pasta temporária.',
                UPLOAD_ERR_CANT_WRITE => 'Falha ao gravar o arquivo no disco.',
                UPLOAD_ERR_EXTENSION  => 'Uma extensão do PHP interrompeu o carregamento do arquivo.',
            ];
            
            $errorMessage = isset($uploadErrors[$fotoError]) ? $uploadErrors[$fotoError] : 'Erro desconhecido ao carregar o arquivo.';
        }

        if (isset($errorMessage)) {
            echo "<script>alert('$errorMessage'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('A resolução do arquivo deve ter no máximo 1000x1000 pixels.'); window.location.href = 'index.php';</script>";
    }

    $db->fechar();
}
?>
