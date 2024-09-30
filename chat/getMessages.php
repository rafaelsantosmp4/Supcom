<?php
session_start();
include('../conexao/conexao.php');
$db = new BancodeDados();
$db->conecta();

$my_id = mysqli_real_escape_string($db->con, $_GET['myid']);
$chat_partner_id = mysqli_real_escape_string($db->con, $_GET['idforn']);
$message_id = isset($_GET['message_id']) ? mysqli_real_escape_string($db->con, $_GET['message_id']) : null;

$response = [];

$query = "SELECT nome FROM usuarios WHERE id_usuario = '$chat_partner_id'";
$result = mysqli_query($db->con, $query);
$partner = mysqli_fetch_assoc($result);
$partner_name = $partner ? $partner['nome'] : 'Ele'; 

if ($message_id) {
    $query = "SELECT * FROM chat_messages WHERE id = '$message_id'";
    $result = mysqli_query($db->con, $query);
    $message = mysqli_fetch_assoc($result);

    $response = [
        'partner_name' => $partner_name,
        'message' => $message
    ];
} else {
    $query = "
        SELECT * FROM chat_messages 
        WHERE (sender_id = '$my_id' AND receiver_id = '$chat_partner_id') 
           OR (sender_id = '$chat_partner_id' AND receiver_id = '$my_id')
        ORDER BY created_at ASC
    ";
    $result = mysqli_query($db->con, $query);
    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $response = [
        'partner_name' => $partner_name,
        'messages' => $messages
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
