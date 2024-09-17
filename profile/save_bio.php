<?php
    include('../conexao/conexao.php');
    session_start();

    if (!isset($_SESSION['id'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erro: Usuário não autenticado.'
        ]);
        exit;
    }

    $db = new BancodeDados();
    $db->conecta();
    $con = $db->con;

    if ($con->connect_error) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Falha na conexão: ' . $con->connect_error
        ]);
        exit;
    }

    $id = $_SESSION['id'];
    $bio = $con->real_escape_string($_POST['bio']);

    $sql = "SELECT bio FROM usuarios WHERE id_usuario = '$id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $sql = "UPDATE usuarios SET bio = '$bio' WHERE id_usuario = '$id'";
    } else {
        $sql = "INSERT INTO usuarios (id_usuario, bio) VALUES ('$id', '$bio')";
    }

    if ($con->query($sql) === TRUE) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Bio atualizada com sucesso!'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erro ao atualizar a bio: ' . $con->error
        ]);
    }

    $db->fechar();
?>
