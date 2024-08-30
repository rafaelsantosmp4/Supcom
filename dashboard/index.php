<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Bem vindo(a)</title>
    <link rel="shortcut icon" href="../medias/logo/Supcom-white.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/basics.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mobile.css">
</head>
<?php
    session_start();
    if($_SESSION['log'] != "ativo") {
        echo"<script>alert('Você precisa entrar na sua conta para continuar.'); window.location.href = '../login/index.php';</script>";
    }
?>
<header>
    <a href="../home" id="button-logo-index"><img width="120px" id="default-logo" src="../medias/logo/Logo-white.png"></a>
    <nav id="mobile-nav">
        <ul>
            <li><a href="../home">Início</a></li>
            <li><a href="../forns/">Fornecedores</a></li>
            <li><a href="../about/">Sobre nós</a></li>
            <li><a href="../contact/">Fale conosco</a></li>
            <li class="config-menu">
                <div style="font-size: 40pt; padding: 10px 30px;"  id="config-button" onclick="toggleConfigMenu()">Configurações <i class="fa fa-caret-down"></i></div>
                <ul id="config-options" class="config-options">
                    <li>CONFIGS HERE</li>
                </ul>
            </li>
        </ul>
    </nav>
    <div style="justify-content: center; align-items: center; display: flex;">
        <button class="config-toggle" id="config_toggle" onclick="config_toggle()"><i class="fa fa-gear"></i></button>
        <div id='account-button' onclick='toggleAccountMenu()' style="position: relative;">
            <?php
                include('../conexao/conexao.php');
                $db = new BancodeDados();
                $db->conecta();
                $iduser = $_SESSION['id'];
                $query = "SELECT * FROM usuarios WHERE id_usuario = '$iduser'";
                $result = mysqli_query($db->con, $query);
                $usuario = mysqli_fetch_assoc($result);
                $nome = $usuario['nome'];
                echo "Bem-vindo, $nome";
                $db->fechar();
            ?>
            <i class='fa fa-caret-down'></i>
        </div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <div id='account-options'>
            <ul>
                <li><a href='../dashboard/'>Dashboard <i class="fa fa-table" style="font-family: FontAwesome;"></i></a></li>
                <li><a href='../logout/'>Sair da conta <i class="fa fa-sign-out" style="font-family: FontAwesome;"></i></a></li>
            </ul>
        </div>
    </div>

    <button class="menu-toggle" id="menu_toggle" onclick="menu_toggle()">&#9776;</button>
</header>

<nav id="configpcnav" class="configpcnav">        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div id="closenav"><i class="fa fa-times"></i></div>
    <ul>
        <li>CONFIGS HERE</li>
    </ul>
</nav>

<div class="overlay2" id="overlay2"></div>
<div class="overlay3" id="overlay3"></div>

<body>
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

    <div class="overlay"></div>

    <?php
    require_once('../conexao/conexao.php');
    $db = new BancodeDados();
    $db->conecta();

    $id = $_SESSION['id'];
    $nome = $_SESSION['nome'];
    $email = $_SESSION['email'];
    $cnpj = $_SESSION['cnpj'];
    $telefone = $_SESSION['telefone'];
    $tipo = $_SESSION['tipo'];
    $data = $_SESSION['data'];
    $datacerta = new DateTime($data);
    $formatted_date = $datacerta->format('d/m/Y');
    $formatted_time = $datacerta->format('H:i:s');

    $query = "SELECT * FROM usuarios WHERE id_usuario = '$id'";
    $result = mysqli_query($db->con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);
        if($usuario['bio'] != null) {
            $_SESSION['bio'] = $usuario['bio'];
        } else {
            $_SESSION['bio'] = "<a href='bio/'>Adicione uma bio para seu perfil! <i class='fa fa-pencil' style='font-family: FontAwesome;'></i></a>";
        }
    }
    $bio = $_SESSION['bio'];
    echo "email: $email<br>cnpj: $cnpj <br> telefone: $telefone <br> Tipo da conta: $tipo <br> data de cadastro: $formatted_date <br> Hora de cadastro: $formatted_time";
    ?>
    <div id="profile">
        <div class="banner-sobreposto"></div>
        <div id="pfp">
            <img src='https://www.tailorbrands.com/wp-content/uploads/2020/07/amazon-logo.jpg'>
            <div id="nomebio">
                <h1><?php echo"$nome" ?></h1>
                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
                <p><?php echo $bio; ?></p>
            </div>
        </div>
    </div>

    <div id="container">
        <div id="conteudo">
        </div>
    </div>

</body>

<?php include '../universal/footer.php';?>

<script src="../js/script.js"></script>
</html>