<?php
session_start();
include('../conexao/conexao.php');
$db = new BancodeDados();
$db->conecta();

$message_id = mysqli_real_escape_string($db->con, $_GET['message_id']);
$edited_message = mysqli_real_escape_string($db->con, $_GET['edited_message']);
$message_id = mysqli_real_escape_string($db->con, $_GET['message_id']);
$query = "UPDATE chat_messages SET messagetext = '$edited_message', edited = 1 WHERE id = '$message_id'";

$response = [];

if (mysqli_query($db->con, $query)) {
    $response['status'] = 'success';
    $response['message'] = 'Mensagem editada com sucesso.';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Erro ao editar a mensagem: ' . mysqli_error($db->con);
}

header('Content-Type: application/json');
echo json_encode($response);
?>