<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <style>
        body {
            background-color: azure;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
        session_start();

        session_unset();
        session_destroy();

        session_start();

        $_SESSION['log'] = "desativado";
    ?>

    <script>
        localStorage.clear();

        window.location.href = '../';
    </script>
</body>
</html>