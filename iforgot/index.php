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
        $(document).ready(function() {
            var behavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            options = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(behavior.apply({}, arguments), options);
                }
            };
            $('#tel').mask(behavior, options);

            var options = {
                onKeyPress: function (cpf, ev, el, op) {
                    var masks = ['000.000.000-000', '00.000.000/0000-00'];
                    $('#doc_serial').mask((cpf.length > 14) ? masks[1] : masks[0], op);
                }
            }
            $('#doc_serial').length > 11 ? $('#doc_serial').mask('00.000.000/0000-00', options) : $('#doc_serial').mask('000.000.000-00#', options);

            $('#doc_serial').on('input', function() {
                var cnpjValue = $(this).val();
                if (cnpjValue.length > 14) {
                    $('label[for="doc_serial"]').text('CNPJ');
                } else {
                    $('label[for="doc_serial"]').text('CPF');
                }
            });

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

        window.addEventListener('load', function() {
            document.querySelector('.loader-container').style.display = 'none';
            document.body.style.pointerEvents = 'inherit';
        });
    </script>

    <div id="left" class="login <?php echo $themeClass; ?>">
        <form action="" method="post">
            <center><img id="default-logo" src="<?php echo $logoSrc; ?>" alt="Logo"></center>
            <h1>Recupere sua senha!</h1>
            <p>Apresente todas as informações EXATAS da empresa:</p>

            <div id="datas" class='grid <?php echo $themeClass; ?>' style="width: 100%;">
                <div class="contact__box contact__area">
                    <label for="nome" class="contact__label">Nome da empresa</label>
                    <input type="text" name="nome" id="nome" class="contact__input" required />
                </div>

                <div class="contact__box contact__area">
                    <label for="email" class="contact__label">E-mail</label>
                    <input type="email" name="email" id="email" placeholder="xxxxx@email.com" class="contact__input" required />
                </div>

                <div class="contact__box contact__area">
                    <label for="doc_serial" class="contact__label">CPF/CNPJ</label>
                    <input type="text" name="doc_serial" id="doc_serial" maxlength="18" class="contact__input" required />
                </div>

                <div class="contact__box contact__area">
                    <label for="tel" class="contact__label">Telefone</label>
                    <input type="text" class="tel contact__input" name="tel" id="tel" maxlength="15" required />
                </div><br>
            </div>
            
            <button type="submit" class="submit-button">Verificar cadastro</button>
        </form>
        
        <style>
            .contact__area {
                height: auto;
            }
            .grid {
                gap: 20px;
            }
        </style>
    </div>

    <?php
        include('../conexao/conexao.php');
        session_start();

        $db = new BancodeDados();
        $db->conecta();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $doc_serial = $_POST['doc_serial'];
            $telefone = $_POST['tel'];

            $nome = mysqli_real_escape_string($db->con, $nome);
            $email = mysqli_real_escape_string($db->con, $email);
            $doc_serial = mysqli_real_escape_string($db->con, $doc_serial);
            $telefone = mysqli_real_escape_string($db->con, $telefone);

            $query = "SELECT * FROM usuarios WHERE nome = '$nome' AND email = '$email' AND doc_serial = '$doc_serial' AND telefone = '$telefone'";
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