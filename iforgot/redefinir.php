<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo(a)</title>
    <link rel="shortcut icon" href="../medias/logo/Supcom-white.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/basics.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mobile.css">
</head>
<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $darkMode = isset($_POST['dark_mode']);
        setcookie('dark_mode', $darkMode ? '1' : '0', time() + (86400 * 30), "/");
        $_COOKIE['dark_mode'] = $darkMode ? '1' : '0';
    }
    $themeClass = isset($_COOKIE['dark_mode']) && $_COOKIE['dark_mode'] === '1' ? 'dark-mode' : 'light-mode';

    $logoSrc = $themeClass === 'dark-mode' ? '../medias/logo/Black-logo.png' : '../medias/logo/Logo-white.png';
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function() {
        var check = function() {
            var modeClass = $('#left').hasClass('dark-mode') ? 'error' : '';
            if ($('#password').val() === $('#checkpassword').val()) {
                $('#alertPassword').removeClass('error').html('<span><i class="fa fa-check-circle"></i> Senhas correspondem!</span>');
            } else {
                $('#alertPassword').addClass('error').html('<span><i class="fa fa-exclamation-circle"></i> Senhas não correspondem</span>');
            }
        };
        $('#password, #checkpassword').on('input', check);
    });
</script>

<body class="<?php echo $themeClass; ?>">
    <div id="vlibras">
        <div vw class="enabled">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
                <div class="vw-plugin-top-wrapper"></div>
            </div>
        </div>
        <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
        <script>
            new window.VLibras.Widget('https://vlibras.gov.br/app');
        </script>
    </div>

    <div class="imgright logimg"></div>

    <div id="left" class="login <?php echo $themeClass; ?>">
        <form action="updatepass.php" method="post">
            <center><img id="default-logo" src="<?php echo $logoSrc; ?>"></center>
            <h1>Olá <?php echo $_SESSION['nome_temp'];?>, redefina sua senha</h1>
            <p>Crie uma nova senha</p>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <div id="datas">                
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" required/>
                
                <label for="checkpassword">Confirmar senha</label>
                <input type="password" name="checkpassword" id="checkpassword" required/>
                <p id="alertPassword"></p>
            </div>
            
            <button type="submit" class="submit-button">Redefinir</button>
        </form>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>
