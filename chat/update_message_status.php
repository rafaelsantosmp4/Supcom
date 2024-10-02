<?php
include('../conexao/conexao.php');
$db = new BancodeDados();
$db->conecta();

$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['userId'];
$recipientId = $data['recipientId'];

$sql = "UPDATE chat_messages SET lida = 1 
        WHERE (sender_id = '$recipientId' AND receiver_id = '$userId') 
        AND lida = 0";

mysqli_query($db->con, $sql);

header('Content-Type: application/json');
echo json_encode(['status' => 'success']);
?>