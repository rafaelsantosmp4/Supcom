<?php
$pdo = new PDO('mysql:host=localhost;dbname=supcom', 'root', 'prof@etec');

$my_id = $_GET['myid'];
$chat_partner_id = $_GET['idforn'];
$message_id = isset($_GET['message_id']) ? $_GET['message_id'] : null;

// Buscar o nome do parceiro de chat
$stmt = $pdo->prepare("SELECT nome FROM usuarios WHERE id_usuario = ?");
$stmt->execute([$chat_partner_id]);
$partner = $stmt->fetch(PDO::FETCH_ASSOC);
$partner_name = $partner ? $partner['nome'] : 'Ele'; 

if ($message_id) {
    // Buscar uma mensagem específica
    $stmt = $pdo->prepare("SELECT * FROM chat_messages WHERE id = ?");
    $stmt->execute([$message_id]);
    $message = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'partner_name' => $partner_name,
        'message' => $message
    ]);
} else {
    // Buscar todas as mensagens
    $stmt = $pdo->prepare("
        SELECT * FROM chat_messages 
        WHERE (sender_id = ? AND receiver_id = ?) 
           OR (sender_id = ? AND receiver_id = ?)
        ORDER BY created_at ASC
    ");
    $stmt->execute([$my_id, $chat_partner_id, $chat_partner_id, $my_id]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'partner_name' => $partner_name,
        'messages' => $messages
    ]);
}
?>
