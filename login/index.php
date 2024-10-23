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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    <div class="imgright logimg"></div>

    <div id="left" class="login <?php echo $themeClass; ?>">
        <form action="" method="post">
            <center><img id="default-logo" src="<?php echo $logoSrc; ?>"></center>
            <h1>Entre na sua conta</h1>
            <p>Não tem uma conta? <a href="../signup/index.php"><i>cadastrar</i></a></p>

            <div id="datas" class='grid <?php echo $themeClass; ?>' style="width: 100%;">
                <div class="contact__box contact__area">
                    <input type="email" name="email" id="email" class='contact__input' required/>
                    <label for="email" id="emaillabel" class="contact__label">E-mail</label>
                </div>

                <div class="contact__box contact__area">
                    <label for="password" id="passwordlabel" class="contact__label" style="margin-top: 17px; z-index: 100;">Senha</label><br>
                    <div class="password-container" style="position: relative;">
                        <input type="password" name="password" id="password" class='contact__input' required/>
                        <span id="togglePassword"><i class="fa fa-eye"></i></span>
                    </div>
                </div>
            </div><br>

            <a href="../iforgot/" class="forgot-password">Esqueceu a senha?</a>
            
            <button type="submit" class="submit-button">Entrar</button>

            <style>
                .contact__area {
                    height: auto;
                }
                .grid {
                    gap: 20px;
                }
            </style>
        </form>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            if (icon.classList.contains('fa-eye')) {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });


        window.addEventListener('load', function() {
            document.querySelector('.loader-container').style.display = 'none';
            document.body.style.pointerEvents = 'inherit';
        });
    </script>
</body>
</html>

<?php
include('../conexao/conexao.php');
$db = new BancodeDados();
$db->conecta();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $email = mysqli_real_escape_string($db->con, $email);
    $senha = mysqli_real_escape_string($db->con, $senha);

    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($db->con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['log'] = 'ativo';
            $_SESSION['id'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['doc_serial'] = $usuario['doc_serial'];
            $_SESSION['telefone'] = $usuario['telefone'];
            $_SESSION['tipo'] = $usuario['tipo_usuario'];
            $_SESSION['data'] = $usuario['data_cadastro'];
            echo "<script>
                    Swal.fire({
                        title: 'Sucesso!',
                        text: 'Bem vindo, ". $usuario['nome']."',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(function() {
                        window.location.href = '../home/';
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Senha incorreta.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        history.go(-1);
                    });
                  </script>";
        }
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Usuário não encontrado.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    history.go(-1);
                });
              </script>";
    }
}

$db->fechar();
?>
