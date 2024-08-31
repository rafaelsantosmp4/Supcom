<?php
    include('../conexao/conexao.php');
    session_start();

    if (!isset($_SESSION['id'])) {
        die("Erro: Usuário não autenticado.");
    }

    $db = new BancodeDados();
    $db->conecta();
    $con = $db->con;

    if ($con->connect_error) {
        die("Falha na conexão: " . $con->connect_error);
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
        echo "<script>window.location.href='index.php'</script>";
    } else {
        echo "Erro ao atualizar a bio: " . $con->error;
    }
    
    $db->fechar();
?>
