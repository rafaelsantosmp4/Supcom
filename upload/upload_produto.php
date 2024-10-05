<?php
session_start();
require_once('../conexao/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new BancodeDados();
    $db->conecta();

    $id_forn = $_SESSION['id'];
    $response = [];

    $nome_produto = mysqli_real_escape_string($db->con, $_POST['nome']);
    
    $descricao_produto = $_POST['desc'];
    $descricao_produto = trim($descricao_produto);
    $descricao_produto = preg_replace('/^\s*\n|\n\s*$/', '', $descricao_produto);
    
    $qtd_produto = intval($_POST['qtd']);
    $preco_produto = mysqli_real_escape_string($db->con, $_POST['preco']);

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

                $query = "INSERT INTO produto (id_forn, nome_produto, descricao_produto, qtd_produto, preco_produto, foto_prod) 
                          VALUES ('$id_forn', '$nome_produto', '$descricao_produto', '$qtd_produto', '$preco_produto', '$fotoBlob')";

                if (mysqli_query($db->con, $query)) {
                    $id_produto = mysqli_insert_id($db->con);
                    $nome_produto_encoded = urlencode($nome_produto);

                    $response['status'] = 'success';
                    $response['message'] = 'Produto adicionado com sucesso!';
                    $response['redirectUrl'] = "../product/index.php?id=$id_produto&nome=$nome_produto_encoded";
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Erro ao adicionar produto: ' . mysqli_error($db->con);
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
?>
