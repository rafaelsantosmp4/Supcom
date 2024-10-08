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

    <div id="voltarbut">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <a href="../"><button class="back-toggle"><i class="fa fa-chevron-left"></i></button></a>
    </div>
    <div class="imgright signupimg"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        window.addEventListener('load', function() {
            document.querySelector('.loader-container').style.display = 'none';
            document.body.style.pointerEvents = 'inherit';
        });

        $(document).ready(function() {
            $('#cnpj').mask('00.000.000/0000-00');
            $('#tel').mask('(00) 0000-0000');

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

    <div id="left" class="login <?php echo $themeClass; ?>">
        <form action="" method="post">
            <center><img id="default-logo" src="<?php echo $logoSrc; ?>" alt="Logo"></center>
            <h1>Recupere sua senha!</h1>
            <p>Apresente todas as informações EXATAS da empresa:</p>

            <div id="datas">
                <label for="nome">Nome da empresa</label>
                <input type="text" name="nome" id="nome" required/>

                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="xxxxx@email.com" required/>
                
                <label for="cnpj">CNPJ</label>
                <input type="text" name="cnpj" id="cnpj" placeholder="00.000.000/0000-00" maxlength="18" required/>
                
                <label for="tel">Telefone</label>
                <input type="text" name="tel" id="tel" placeholder="(99) 9999-9999" maxlength="14" required/>
            </div>
            
            <button type="submit" class="submit-button">Verificar cadastro</button>
        </form>
    </div>

    <?php
        include('../conexao/conexao.php');
        session_start();

        $db = new BancodeDados();
        $db->conecta();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $cnpj = $_POST['cnpj'];
            $telefone = $_POST['tel'];

            $nome = mysqli_real_escape_string($db->con, $nome);
            $email = mysqli_real_escape_string($db->con, $email);
            $cnpj = mysqli_real_escape_string($db->con, $cnpj);
            $telefone = mysqli_real_escape_string($db->con, $telefone);

            $query = "SELECT * FROM usuarios WHERE nome = '$nome' AND email = '$email' AND cnpj = '$cnpj' AND telefone = '$telefone'";
            $result = mysqli_query($db->con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $usuario = mysqli_fetch_assoc($result);
                $_SESSION['id_temp'] = $usuario['id_usuario'];
                $_SESSION['nome_temp'] = $usuario['nome'];
                echo "<script>window.location.href='redefinir.php'</script>";
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Informações incorretas ou usuário não encontrado.',
                        icon: 'error',
                        confirmButtonText: 'Tentar novamente'
                    }).then(function() {
                        history.go(-1);
                    });
                  </script>";
            }
        }

        $db->fechar();
    ?>
    <script src="../js/script.js"></script>
</body>
</html>