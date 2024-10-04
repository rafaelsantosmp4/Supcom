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

            <div id="datas">
                <label for="nome">Nome da empresa</label>
                <input type="text" placeholder="Max. 30 caracteres" name="nome" id="nome" maxlength="30" required/>

                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="xxxxx@email.com" required/>

                <label for="tipoconta">O que pretende na SUPCOM?</label>
                <select name="tipoconta" id="tipoconta">
                    <option value="loj">Encontrar fornecedores para minha empresa</option>
                    <option value="forn">Vender mercadorias da minha empresa fornecedora</option>
                </select>
                
                <label for="cnpj">CNPJ</label>
                <input type="text" name="cnpj" id="cnpj" placeholder="00.000.000/0000-00" maxlength="18" required/>
                
                <label for="tel">Telefone</label>
                <input type="text" name="tel" id="tel" placeholder="(99) 9999-9999" maxlength="14" required/>
                
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" required/>
                
                <label for="checkpassword">Confirmar senha</label>
                <input type="password" name="checkpassword" id="checkpassword" required/>
                <p id="alertPassword"></p>
            </div>
            
            <button type="submit" class="submit-button">Cadastrar</button>
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
    $cnpj = $_POST['cnpj'];
    $telefone = $_POST['tel'];
    $senha = $_POST['password'];
    $tipo_conta = $_POST['tipoconta'] == 'forn' ? 'fornecedor' : 'lojista';

    $nome = mysqli_real_escape_string($db->con, $nome);
    $email = mysqli_real_escape_string($db->con, $email);
    $cnpj = mysqli_real_escape_string($db->con, $cnpj);
    $telefone = mysqli_real_escape_string($db->con, $telefone);
    $senha = mysqli_real_escape_string($db->con, $senha);

    $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

    $query = "INSERT INTO Usuarios (nome, bio, email, senha, cnpj, telefone, tipo_usuario) VALUES ('$nome', NULL, '$email', '$senha_hashed', '$cnpj', '$telefone', '$tipo_conta')";

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
                    text: 'Já existe uma conta cadastrada com esse email, CNPJ ou telefone!',
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