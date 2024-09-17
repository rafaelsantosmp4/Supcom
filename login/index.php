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

            <div id="datas">
                <label for="email" id="emaillabel">E-mail</label>
                <input type="email" name="email" id="email" required/>
                
                <label for="password" id="passwordlabel">Senha</label>
                <input type="password" name="password" id="password" required/>
            </div>

            <a href="../iforgot/" class="forgot-password">Esqueceu a senha?</a>
            
            <button type="submit" class="submit-button">Entrar</button>
        </form>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>

<?php
include('../conexao/conexao.php');
session_start();

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
            $_SESSION['cnpj'] = $usuario['cnpj'];
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
