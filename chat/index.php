<?php
    include('../conexao/conexao.php');
    $db = new BancodeDados();
    $db->conecta();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
</head>
<body>
    <div class="chat-box">
        <?php
            $sender_id = $_GET['myid'];
            $receiver_id = $_GET['idforn'];

            $sql = "SELECT * FROM messages WHERE sender_id = $sender_id ORDER BY timestamp";
            $result = mysqli_query($db->con, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo"mensagens aqui";
            } else {
                echo"SEM MENSAGENS AINDA";
            }
        ?>
    </div>

    <form method="POST" action="send_message.php">
        <input type="hidden" name="sender_id" value="<?php echo $sender_id; ?>">
        <input type="hidden" name="receiver_id" value="<?php echo $receiver_id; ?>">
        <textarea name="message" rows="3" cols="30" required></textarea>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>