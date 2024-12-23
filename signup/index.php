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

    <div id="left" class="signup <?php echo $themeClass; ?>">
        <form action="" method="post">
            <center><img id="default-logo" src="<?php echo $logoSrc; ?>" alt="Logo"></center>
            <h1>Cadastre sua empresa na SUPCOM!</h1>
            <p>Já tem uma conta? <a href="../login/index.php"><i>entrar</i></a></p>

            <div id="datas" class='grid <?php echo $themeClass; ?>' style="width: 100%;">                
                <div class="contact__box contact__area">
                    <input type="text" placeholder="Max. 30 caracteres" name="nome" id="nome" maxlength="30" class='contact__input' required />
                    <label for="nome" class="contact__label">Nome da empresa</label>
                </div>

                <div class="contact__box contact__area">
                    <input type="email" name="email" id="email" class='contact__input' required />
                    <label for="email" id="emaillabel" class="contact__label">E-mail</label>
                </div>

                <div class="contact__box contact__area">
                    <label for="tipoconta" id="tipocontalabel" class="contact__label">O que pretende na SUPCOM?</label>
                    <select name="tipoconta" id="tipoconta" class="contact__input" style="padding-top: 15px; height: 60px;">
                        <option value="loj">Encontrar fornecedores para minha empresa</option>
                        <option value="forn">Vender mercadorias da minha empresa fornecedora</option>
                    </select>
                </div>

                <div class="contact__box contact__area">
                    <label for="doc_serial" class="contact__label">CPF/CNPJ</label>
                    <input type="text" name="doc_serial" id="doc_serial" maxlength="18" class="contact__input" required />
                </div>

                <div class="contact__box contact__area">
                    <label for="tel" class="contact__label">Telefone</label>
                    <input type="text" class="tel contact__input" name="tel" id="tel" maxlength="15" required />
                </div>

                <div class="contact__box contact__area">
                    <label for="password" class="contact__label">Senha</label>
                    <input type="password" name="password" id="password" class="contact__input" required />
                </div>

                <div class="contact__box contact__area">
                    <label for="checkpassword" class="contact__label">Confirmar senha</label>
                    <input type="password" name="checkpassword" id="checkpassword" class="contact__input" required />
                </div>

                <div class="contact__box contact__area">
                    <div style="display: flex; align-items: center;">
                        <input type="checkbox" id="terms" name="terms" required style="width: 60px; margin-right: 20px; margin-top: 0px;">
                        <label for="terms" class="contact__label" id="concordo">
                            Eu li e concordo com os <a href="../legal/termos-uso.php" target="_blank">Termos de Uso</a> e a <a href="../legal/privacidade.php" target="_blank">Política de Privacidade</a>.
                        </label>
                    </div>
                </div>

                <style>
                    #concordo {
                        position: inherit;
                        padding: 0;
                    }
                </style>

                <p id="alertPassword"></p>
            </div>
            
            <button type="submit" id="submitButton" class="submit-button">Cadastrar</button>

            <script>
                window.addEventListener('load', function() {
                    const checkbox = document.getElementById('terms');
                    const submitButton = document.getElementById('submitButton');

                    function toggleSubmitButton() {
                        submitButton.disabled = !checkbox.checked;
                    }

                    toggleSubmitButton();

                    checkbox.addEventListener('change', toggleSubmitButton);
                });
            </script>

            <style>
                .contact__area {
                    height: auto;
                }
                .grid {
                    gap: 20px;
                }
                .submit-button:disabled {
                    background-color: #ccc;
                    color: #999;
                    cursor: not-allowed;
                    opacity: 0.7;
                }
            </style>
        </form>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>

<?php
include('../conexao/conexao.php');

$db = new BancodeDados();
$db->conecta();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $doc_serial = $_POST['doc_serial'];
    $telefone = $_POST['tel'];
    $senha = $_POST['password'];
    $tipo_conta = $_POST['tipoconta'] == 'forn' ? 'fornecedor' : 'lojista';

    echo"<script></script>";

    $nome = mysqli_real_escape_string($db->con, $nome);
    $email = mysqli_real_escape_string($db->con, $email);
    $doc_serial = mysqli_real_escape_string($db->con, $doc_serial);
    $telefone = mysqli_real_escape_string($db->con, $telefone);
    $senha = mysqli_real_escape_string($db->con, $senha);

    $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

    $query = "INSERT INTO Usuarios (nome, bio, email, senha, doc_serial, telefone, tipo_usuario) VALUES ('$nome', NULL, '$email', '$senha_hashed', '$doc_serial', '$telefone', '$tipo_conta')";

    if (mysqli_query($db->con, $query)) {
        echo "<script>
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Cadastro realizado com sucesso. Você pode fazer login agora.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(function() {
                    window.location.href = '../login/';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Já existe uma conta cadastrada com esse email, CPF/CNPJ ou telefone!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'index.php';
                });
              </script>";
    }
}

$db->fechar();
?>
<script>
    window.addEventListener('load', function() {
        document.body.style.overflow = 'inherit';
    });
</script>