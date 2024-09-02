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
        $darkMode = isset($_SESSION['dark_mode']) ? $_SESSION['dark_mode'] : null;

        session_unset();
        session_destroy();

        session_start();

        if ($darkMode !== null) {
            $_SESSION['dark_mode'] = $darkMode;
        }

        $_SESSION['log'] = "desativado";

        echo "<script>window.location.href = '../';</script>";
    ?>
</body>
</html>
