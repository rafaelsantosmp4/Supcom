<?php
session_start();
require_once('../conexao/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new BancodeDados();
    $db->conecta();

    $id_forn = $_SESSION['id'];

    $nome_produto = mysqli_real_escape_string($db->con, $_POST['nome']);
    $descricao_produto = mysqli_real_escape_string($db->con, $_POST['desc']);
    $qtd_produto = intval($_POST['qtd']);
    $preco_produto = mysqli_real_escape_string($db->con, $_POST['preco']);

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

                $query = "INSERT INTO produto (id_forn, nome_produto, descricao_produto, qtd_produto, preco_produto, foto_prod) 
                          VALUES ('$id_forn', '$nome_produto', '$descricao_produto', '$qtd_produto', '$preco_produto', '$fotoBlob')";

                if (mysqli_query($db->con, $query)) {
                    $id_produto = mysqli_insert_id($db->con);
                    $nome_produto_encoded = urlencode($nome_produto);

                    echo "<script>alert('Produto adicionado com sucesso!'); window.location.href = '../product/index.php?id=$id_produto&nome=$nome_produto_encoded';</script>";
                } else {
                    $errorMessage = 'Erro ao salvar produto: ' . mysqli_error($db->con);
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
