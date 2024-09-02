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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['dark_mode'] = isset($_POST['dark_mode']);
    }
    $themeClass = isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] ? 'dark-mode' : 'light-mode';

    $logoSrc = $themeClass === 'dark-mode' ? '../medias/logo/Black-logo.png' : '../medias/logo/Logo-white.png';


    if($_SESSION['log'] != "ativo") {
        echo"<script>alert('Você precisa entrar na sua conta para continuar.'); window.location.href = '../login/index.php';</script>";
    }
?>

<nav id="configpcnav" class="configpcnav <?php echo $themeClass; ?>">        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div id="closenav"><i class="fa fa-times <?php echo $themeClass; ?>"></i></div>
    <ul>
        <li>MODO ESCURO:</li>
        <div class="theme-switcher">
            <form id="theme-form" method="POST" action="">
                <label class="switch">
                    <input type="checkbox" id="dark_mode" name="dark_mode" <?php if (isset($_SESSION['dark_mode']) && $_SESSION['dark_mode']) echo 'checked'; ?>>
                    <span class="toggle-slider round"></span>
                </label>
            </form>
        </div>
    </ul>
</nav>
<script>
    document.getElementById('dark_mode').addEventListener('change', function() {
        localStorage.setItem('showConfigNav', 'true');
        setTimeout(() => {
            document.getElementById('theme-form').submit();
        }, 300);
    });

    window.addEventListener('load', function() {
        const configNavPc = document.getElementById('configpcnav');
        if (localStorage.getItem('showConfigNav') === 'true') {
            if (configNavPc) {
                configNavPc.classList.add('no-transition');
                overlay2.classList.add('show');
                configNavPc.classList.add('show');
                localStorage.removeItem('showConfigNav');
                
                setTimeout(() => {
                    configNavPc.classList.remove('no-transition');
                }, 0);
            }
        }
    });
</script>

<header class='<?php echo $themeClass; ?>'>
    <a href="../home" id="button-logo-index"><img width="120px" id="default-logo" src="<?php echo $logoSrc; ?>"></a>
    <nav id="mobile-nav">
        <ul>
            <li><a href="../home">Início</a></li>
            <li><a href="../forns/">Fornecedores</a></li>
            <li><a href="../about/">Sobre nós</a></li>
            <li><a href="../contact/">Fale conosco</a></li>
            <li class="config-menu">
                <div style="font-size: 40pt; padding: 10px 30px;" id="config-button" onclick="toggleConfigMenu()">Configurações <i class="fa fa-caret-down"></i></div>
                <ul id="config-options" class="config-options">
                    <li>CONFIGS HERE</li>
                </ul>
            </li>
        </ul>
    </nav>
    <div style="justify-content: center; align-items: center; display: flex;">
        <button class="config-toggle <?php echo $themeClass; ?>" id="config_toggle" onclick="config_toggle()"><i class="fa fa-gear"></i></button>
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
        <div id='account-options' class="<?php echo $themeClass; ?>">
            <ul>
                <li><a href='../profile/'>Perfil <i class="fa fa-user" style="font-family: FontAwesome;"></i></a></li>
                <li><a href='../dashboard/'>Dashboard <i class="fa fa-table" style="font-family: FontAwesome;"></i></a></li>
                <li><a href='../logout/'>Sair da conta <i class="fa fa-sign-out" style="font-family: FontAwesome;"></i></a></li>
            </ul>
        </div>
    </div>

    <button class="menu-toggle" id="menu_toggle" onclick="menu_toggle()">&#9776;</button>
</header>

<div class="overlay2" id="overlay2"></div>
<div class="overlay3" id="overlay3"></div>
<div class="overlaybio" id="overlaybio"></div>

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

    <nav id="addbio" class="addbio <?php echo $themeClass; ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <div id="closebio"><i class="fa fa-times <?php echo $themeClass; ?>"></i></div>
        <ul>
            <li>ATUALIZE SUA BIO:</li> 
            <form id="bioForm" method="POST" action="save_bio.php">
                <textarea name="bio" id="bio" rows="4" cols="50" maxlength="200" placeholder="max. 200 caracteres"></textarea>
                <li><input type="submit" class="submit-button bio" value="Salvar"></li>
            </form>
        </ul>
    </nav>

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
                $_SESSION['bio'] = "<p onmouseenter='updatebio()' onmouseleave='resetbio()' id='attbio'>" . $usuario['bio'] . "</p>";
                echo"<script>textarea = document.getElementById('bio'); textarea.innerHTML = '" . $usuario['bio'] . "'; </script>";
            } else {
                $_SESSION['bio'] = "<p> <a style='text-decoration: underline; cursor: pointer;' onclick='addbio()'>Adicione uma bio para seu perfil! <i class='fa fa-pencil' style='font-family: FontAwesome;'></i></a></p>";
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
                <?php echo $bio; ?>
            </div>
        </div>
    </div>

    <div id="container">
        <div id="conteudo">
        </div>
    </div>
</body>


<script>
    document.getElementById('bio').addEventListener('keypress', function(e) {
        var key = e.which || e.keyCode;
        if (key === 13) {
            e.preventDefault();
            document.getElementById("bioForm").submit();
        }
    });
    function addbio() {
        const addbio = document.getElementById('addbio');
        const overlaybio = document.querySelector('.overlaybio');
        if (addbio) {
            addbio.classList.toggle('show');
            overlaybio.classList.toggle('show');
        }
    }
    overlaybio.addEventListener('click', () => {
        const addbio = document.getElementById('addbio');
        if (addbio) {
            addbio.classList.remove('show');
            overlaybio.classList.remove('show');
        }
    });
    closebio = document.getElementById("closebio");
    closebio.addEventListener('click', () => {
    const addbio = document.getElementById('addbio');
    if (addbio) {
        addbio.classList.remove('show');
        overlaybio.classList.remove('show');
    }
    });

    const originalContent = document.querySelector('#attbio').innerHTML;
    function updatebio() {
        const bio = document.querySelector('#attbio');
        const pencil = " <i class='fa fa-pencil' style='font-family: FontAwesome; cursor: pointer;' onclick='addbio()' title='Alterar bio'></i>";
        bio.innerHTML = originalContent + pencil;
    }

    function resetbio() {
        const bio = document.querySelector('#attbio');
        bio.innerHTML = originalContent;
    }
</script>

<?php include '../universal/footer.php';?>

<script src="../js/script.js"></script>
</html>