<?php
$pdo = new PDO('mysql:host=localhost;dbname=supcom', 'root', 'prof@etec');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
<<<<<<< HEAD
    $sender_id = $_POST['sender_id']; // ID do remetente vindo pelo POST
    $receiver_id = $_POST['receiver_id']; // ID do destinatário vindo pelo POST
    $message = $_POST['message'];

    // Inserir a mensagem no banco de dados
=======
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];
    $message = $_POST['message'];

>>>>>>> 553f1d4b5be739a15f6427d39fe24a678bbfbe89
    $stmt = $pdo->prepare("INSERT INTO chat_messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    $stmt->execute([$sender_id, $receiver_id, $message]);

    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'message' => 'Mensagem enviada com sucesso!']);
}
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 553f1d4b5be739a15f6427d39fe24a678bbfbe89
