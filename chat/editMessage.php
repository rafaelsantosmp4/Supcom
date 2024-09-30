<?php
include('../conexao/conexao.php');
$db = new BancodeDados();
$db->conecta();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message_id = $_POST['message_id'];
    $new_message = $_POST['message'];

    $query = "UPDATE chat_messages SET messagetext = '$new_message', edited = 1 WHERE id = $message_id";

    if (mysqli_query($db->con, $query)) {
        echo json_encode(['status' => 'success', 'message' => 'Mensagem editada com sucesso.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($db->con)]);
    }
    
}
?>