<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo(a)</title>
    <link rel="shortcut icon" href="../medias/logo/Supcom-white.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/basics.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mobile.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4/bootstrap-4.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<?php
    session_start();
    $themeClass = isset($_COOKIE['dark_mode']) && $_COOKIE['dark_mode'] === '1' ? 'dark-mode' : 'light-mode';

    $logoSrc = $themeClass === 'dark-mode' ? '../medias/logo/Black-logo.png' : '../medias/logo/Logo-white.png';
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    window.addEventListener('load', function() {
        document.querySelector('.loader-container').style.display = 'none';
        document.body.style.pointerEvents = 'inherit';
    });

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
<div class="loader-container">
  <div class="loader <?php echo $themeClass; ?>"></div>
  <span class="loader-text">Carregando...</span>
</div>
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
        <form action="" method="post">
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

    <?php
        include('../conexao/conexao.php');
        session_start();

        $db = new BancodeDados();
        $db->conecta();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_SESSION['id_temp'])) {
                $id_temp = $_SESSION['id_temp'];
                $senha = $_POST['password'];

                $id_temp = mysqli_real_escape_string($db->con, $id_temp);
                $senha = mysqli_real_escape_string($db->con, $senha);

                $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

                $query = "UPDATE usuarios SET senha = '$senha_hashed' WHERE id_usuario = '$id_temp'";

                if (mysqli_query($db->con, $query)) {
                    echo "<script>
                        Swal.fire({
                            title: 'Sucesso!',
                            text: 'Senha redefinida com sucesso!',
                            icon: 'success',
                            timer: 1300,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.href = '../login/';
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            title: 'Erro!',
                            text: 'Erro ao atualizar a senha.',
                            icon: 'error',
                            confirmButtonText: 'Tentar novamente'
                        }).then(function() {
                            window.location.href = 'index.php';
                        });
                    </script>";
                }
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Sessão expirada ou inválida.',
                        icon: 'error',
                        confirmButtonText: 'Tentar novamente'
                    }).then(function() {
                        window.location.href = 'index.php';
                    });
                </script>";
            }
        }

        $db->fechar();
    ?>
    <script src="../js/script.js"></script>
</body>
</html>
