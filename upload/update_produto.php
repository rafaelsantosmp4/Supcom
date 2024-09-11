<?php
session_start();
require_once('../conexao/conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new BancodeDados();
    $db->conecta();

    $id_forn = $_SESSION['id'];
    $id_produto = $_POST['id_produto_hidden'];

    $nome_produto = mysqli_real_escape_string($db->con, $_POST['nome']);
    $descricao_produto = mysqli_real_escape_string($db->con, $_POST['desc']);
    $qtd_produto = intval($_POST['qtd']);
    $preco_produto = mysqli_real_escape_string($db->con, $_POST['preco']);

    if (isset($_POST['croppedImage']) && !empty($_POST['croppedImage'])) {
        $croppedImageDataURL = $_POST['croppedImage'];

        if (preg_match('/^data:image\/(jpg|jpeg|png);base64,/', $croppedImageDataURL, $matches)) {
            $imageType = $matches[1];
            $imageData = str_replace('data:image/' . $imageType . ';base64,', '', $croppedImageDataURL);
            $imageData = base64_decode($imageData);

            if ($imageData === false) {
                $errorMessage = 'Falha ao decodificar a imagem.';
            } else {
                $fotoBlob = addslashes($imageData);

                $query = "UPDATE produto 
                          SET nome_produto = '$nome_produto', 
                              descricao_produto = '$descricao_produto', 
                              qtd_produto = '$qtd_produto', 
                              preco_produto = '$preco_produto', 
                              foto_prod = '$fotoBlob'
                          WHERE id_produto = '$id_produto' AND id_forn = '$id_forn'";

                if (mysqli_query($db->con, $query)) {
                    $nome_produto_encoded = urlencode($nome_produto);
                    echo "<script>alert('Produto atualizado com sucesso!'); window.location.href = '../product/index.php?id=$id_produto&nome=$nome_produto_encoded';</script>";
                } else {
                    $errorMessage = 'Erro ao atualizar produto: ' . mysqli_error($db->con);
                }
            }
        } else {
            $errorMessage = 'Formato de imagem inválido.';
        }

        if (isset($errorMessage)) {
            echo "<script>alert('$errorMessage'); window.location.href = 'index.php';</script>";
        }
    } else {
        $query = "UPDATE produto 
                  SET nome_produto = '$nome_produto', 
                      descricao_produto = '$descricao_produto', 
                      qtd_produto = '$qtd_produto', 
                      preco_produto = '$preco_produto'
                  WHERE id_produto = '$id_produto' AND id_forn = '$id_forn'";

        if (mysqli_query($db->con, $query)) {
            $nome_produto_encoded = urlencode($nome_produto);
            echo "<script>alert('Produto atualizado com sucesso!'); window.location.href = '../product/index.php?id=$id_produto&nome=$nome_produto_encoded';</script>";
        } else {
            $errorMessage = 'Erro ao atualizar produto: ' . mysqli_error($db->con);
            echo "<script>alert('$errorMessage'); window.location.href = 'index.php';</script>";
        }
    }

    $db->fechar();
}
?>
