<?php
include('../conexao/conexao.php');
$db = new BancodeDados();
$db->conecta();

$iduser = $_GET['iduser'];

$sql = "SELECT DISTINCT
            CASE
                WHEN sender_id = '$iduser' THEN receiver_id
                ELSE sender_id 
            END AS other_user_id
        FROM chat_messages
        WHERE sender_id = '$iduser' OR receiver_id = '$iduser'";
$conversations = mysqli_query($db->con, $sql);
$userData = [];

while ($row = mysqli_fetch_assoc($conversations)) {
    $otherUserId = $row['other_user_id'];
    
    $userQuery = "SELECT nome FROM usuarios WHERE id_usuario = '$otherUserId'";
    $userResult = mysqli_query($db->con, $userQuery);

    $lastMessageQuery = "
        SELECT messagetext, lida
        FROM chat_messages
        WHERE ((sender_id = '$otherUserId' AND receiver_id = '$iduser')
            OR (sender_id = '$iduser' AND receiver_id = '$otherUserId'))
            AND deleted = 0
        ORDER BY created_at DESC
        LIMIT 1";

    $lastMessageResult = mysqli_query($db->con, $lastMessageQuery);
    $lastMessageRow = mysqli_fetch_assoc($lastMessageResult);
    $lastMessage = isset($lastMessageRow['messagetext']) ? $lastMessageRow['messagetext'] : '<i>Nenhuma mensagem</i>';
    $notificada = isset($lastMessageRow['lida']) && $lastMessageRow['lida'] == 0;

    if ($userRow = mysqli_fetch_assoc($userResult)) {
        $userData[] = [
            'nome' => $userRow['nome'],
            'id' => $otherUserId,
            'ultima_mensagem' => $lastMessage,
            'notificada' => $notificada
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($userData);
?>
