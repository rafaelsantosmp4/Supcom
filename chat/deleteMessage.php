<?php
session_start();
include('../conexao/conexao.php');
$db = new BancodeDados();
$db->conecta();

$message_id = mysqli_real_escape_string($db->con, $_GET['message_id']);
$query = "UPDATE chat_messages SET messagetext = '<span id=\"deletedMessageSpan\"> Mensagem apagada!</span>', deleted = 1 WHERE id = '$message_id'";

$response = [];

if (mysqli_query($db->con, $query)) {
    $response['status'] = 'success';
    $response['message'] = 'Mensagem apagada com sucesso.';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Erro ao apagar a mensagem: ' . mysqli_error($db->con);
}

header('Content-Type: application/json');
echo json_encode($response);
?>
