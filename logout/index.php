<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
</head>
<style>
    body {
        background-color: azure;
        text-align: center;
    }
</style>
<body>
    <?php
        session_start();
        session_destroy();
        session_unset();
        session_start();
        $_SESSION['log'] = "desativado";
        echo"<script>window.location.href = '../';</script>";
    ?>
</body>
</html>