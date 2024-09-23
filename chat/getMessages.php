<?php
$pdo = new PDO('mysql:host=localhost;dbname=supcom', 'root', 'prof@etec');

$my_id = $_GET['myid'];
$chat_partner_id = $_GET['idforn'];

<<<<<<< HEAD
// Buscar o nome do parceiro de chat
$stmt = $pdo->prepare("SELECT nome FROM usuarios WHERE id_usuario = ?");
$stmt->execute([$chat_partner_id]);
$partner = $stmt->fetch(PDO::FETCH_ASSOC);
$partner_name = $partner ? $partner['nome'] : 'Ele'; 
=======
$stmt = $pdo->prepare("SELECT nome FROM usuarios WHERE id_usuario = ?");
$stmt->execute([$chat_partner_id]);
$partner = $stmt->fetch(PDO::FETCH_ASSOC);
$partner_name =  $partner['nome'];
>>>>>>> 553f1d4b5be739a15f6427d39fe24a678bbfbe89

$stmt = $pdo->prepare("
    SELECT * FROM chat_messages 
    WHERE (sender_id = ? AND receiver_id = ?) 
       OR (sender_id = ? AND receiver_id = ?)
    ORDER BY created_at ASC
");
$stmt->execute([$my_id, $chat_partner_id, $chat_partner_id, $my_id]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode([
    'partner_name' => $partner_name,
    'messages' => $messages
]);
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 553f1d4b5be739a15f6427d39fe24a678bbfbe89
