<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produto</title>
    <link rel="shortcut icon" href="../medias/logo/Supcom-white.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/basics.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mobile.css">
    <link rel="stylesheet" href="../css/products.css">
</head>

<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $darkMode = isset($_POST['dark_mode']);
        setcookie('dark_mode', $darkMode ? '1' : '0', time() + (86400 * 30), "/");
        $_COOKIE['dark_mode'] = $darkMode ? '1' : '0';

        if (isset($_POST['font_size'])) {
            $fontSize = $_POST['font_size'];
            setcookie('fontSize', $fontSize, time() + (86400 * 30), "/"); 
            $_COOKIE['fontSize'] = $fontSize;
        }
    }
    $themeClass = isset($_COOKIE['dark_mode']) && $_COOKIE['dark_mode'] === '1' ? 'dark-mode' : 'light-mode';

    $fontSize = isset($_COOKIE['fontSize']) ? $_COOKIE['fontSize'] : '16'; 

    $logoSrc = $themeClass === 'dark-mode' ? '../medias/logo/Black-logo.png' : '../medias/logo/Logo-white.png';
?>

<nav id="configpcnav" class="configpcnav <?php echo $themeClass; ?>">        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div id="closenav"><i class="fa fa-times <?php echo $themeClass; ?>"></i></div>
    <ul>
        <li>MODO ESCURO:</li>
        <div class="theme-switcher">
            <form id="theme-form" method="POST" action="">
                <label class="switch">
                    <input type="checkbox" id="dark_mode" name="dark_mode" <?php if (isset($_COOKIE['dark_mode']) && $_COOKIE['dark_mode'] === '1') echo 'checked'; ?>>
                    <span class="toggle-slider round"></span>
                </label>
            </form>
        </div><br>
        <li>Tamanho da Fonte:</li>
        <div class="font-size-controller">
            <input type="range" id="fontSlider" name="font_size" min="16" max="24" value="<?php echo $fontSize; ?>">
            <p id="fontSizeDisplay">Tamanho da fonte: <?php echo $fontSize; ?>px</p>
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
                const overlay2 = document.getElementById('overlay2');
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

<header class='<?php echo $themeClass; ?>' style="border-bottom-left-radius: 30px; border-bottom-right-radius: 30px; font-size: <?php echo $fontSize; ?>px;">
    <a href="#" id="button-logo-index">
        <img width="120px" id="default-logo" src="<?php echo $logoSrc; ?>" alt="Logo">
    </a>
    <nav id="mobile-nav" class="font-adjustable">
        <ul>
            <li><a href="../index.php" class="font-adjustable">Início</a></li>
            <li><a href="../products.php" class="font-adjustable">Produtos</a></li>
            <li><a href="../contact.php" class="font-adjustable">Fale conosco</a></li>
        </ul>
    </nav>
    <div id="direita" style="justify-content: center; align-items: center; display: flex;">
        <a href="../login/" class="<?php echo $themeClass; ?>" id='entrarlink'>Entrar</a>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <button class="config-toggle <?php echo $themeClass; ?>" id="config_toggle" onclick="config_toggle()"><i class="fa fa-gear"></i></button>
    </div>
</header>

<div class="loader-container">
  <div class="loader <?php echo $themeClass; ?>"></div>
  <span class="loader-text <?php echo $themeClass; ?>">Carregando...</span>
</div>
<div class="overlay2" id="overlay2"></div>
<div class="overlay3" id="overlay3"></div>

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

    <?php
        include('../conexao/conexao.php');
        $db = new BancodeDados();
        $db->conecta();

        $idenviado = $_GET['id'];
        $queryprods = "SELECT * FROM produto WHERE id_produto = $idenviado";
        $resultprods = mysqli_query($db->con, $queryprods);

        $produto = mysqli_fetch_assoc($resultprods);
        $nome_produto = $produto['nome_produto'];
        
        $descricao_produto = $produto['descricao_produto'];
        $descricao_produto_display = nl2br(htmlspecialchars($descricao_produto, ENT_QUOTES));

        $preco_produto = $produto['preco_produto'];
        $foto_produto = base64_encode($produto['foto_prod']);
        $id_produto = $produto['id_produto'];
        $qtd_produto = $produto['qtd_produto'];

        $id_forn = $produto['id_forn'];
        $tempquery = "SELECT nome FROM usuarios WHERE id_usuario = '$id_forn'";
        $tempresult = mysqli_query($db->con, $tempquery);
        $tempusuario = mysqli_fetch_assoc($tempresult);
        $nome_forn = $tempusuario['nome'];
        $nome_forn_encoded = urlencode($nome_forn);
    ?>

    <div id="container">
        <div id="conteudo">
            <div id="totaldatas">
                <div class="imagensprod">
                    <img src="data:image/jpeg;base64,<?php echo $foto_produto; ?>" alt="<?php echo $nome_produto; ?>" width="100%">
                </div>
                <div class="rightdatas">
                <center><br>
                    <h1 style="margin-top: 5px; margin-bottom: 12px;" id="tituloprodutounico"><?php echo $nome_produto; ?></h1>
                    <h1 style="margin-top: 5px; margin-bottom: 0px;"><?php echo $preco_produto; ?></h1><br>
                    <span><b><?php echo $qtd_produto; ?> </b> disponíveis.</span><br><br>

                    <?php                        
                        echo'<a href="../chat/"><button style="width: 50%;" class="submit-button" id="entraremcontato">Entrar em contato</button></a>';
                    ?>
                    <hr>
                    <h2 style="text-align: left;">Descrição:</h2>
                    <p class='descricaoprod'><?php echo $descricao_produto_display; ?></p>
                    <hr>
                    <h3 style="margin-bottom: 3px;">Empresa:</h3>
                    <a href="<?php echo '../tempprofile/company.php?id='.$id_forn.'&nome='.$nome_forn_encoded ?>" id='nomeempresalink' title="Acessar perfil" style="display: flex; align-items: center; justify-content: center; margin-top: 10px;">
                        <img src='<?php echo '../chat/getprofilepfp.php?id='. $id_forn; ?>' class='user-image-produto' />
                        <p id='nomeempresa'><b><?php echo $nome_forn; ?></b></p>
                    </a>
                </div></center>
            </div>
        </div>
    </div>
</body>

<footer>
    <div id="parts">
        <center>
            <h1>Integrantes</h1>
            <p class="nomes_inte font-adjustable">• Caio Custódio Parolin</p>
            <p class="nomes_inte font-adjustable">• Leonardo M. Nakashima Monteiro</p>
            <p class="nomes_inte font-adjustable">• Rafael Santos Rodrigues</p>
            <p class="nomes_inte font-adjustable">• Raul Ribeiro Fialho</p>
        </center>
    </div>
    <div id="parts">
        <center>
            <img src="../medias/logo/Black-logo.png">
            <p style="font-size: 20pt;">União e resultados.</p>
        </center>
    </div>
    <div id="parts">
        <center>
            <h1>Contate-nos!</h1>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css'>
            <a target="_blank" href="https://www.instagram.com/officialsupcom/" style="text-decoration: none;"><i class="fab fa-instagram" title="Instagram" id="Instagram"></i></a>
            <a href="../contact.php" style="text-decoration: none;"><i class="fa fa-envelope-o" style="font-family: FontAwesome; margin-left: 20px;" id="Instagram"></i></a>
        </center>
    </div>
</footer>

<script type="text/javascript" >
    window.addEventListener('load', function() {
        const savedFontSize = getCookie('fontSize');
        if (savedFontSize) {
            ajustarFonte(savedFontSize);
            document.getElementById('fontSlider').value = savedFontSize;
            updateFontSizeDisplay(savedFontSize);
        }

        document.querySelector('.loader').style.display = 'none';
        document.querySelector('#container').style.opacity = 100;
        document.querySelector('footer').style.opacity = 100;
        document.body.style.overflow = 'auto';
        document.querySelector('.loader-text').style.display = 'none';
        document.body.style.pointerEvents = 'inherit';
        document.body.style.overflow = 'inherit';
        
        document.getElementById('fontSlider').addEventListener('input', function(event) {
            const newSize = event.target.value;
            ajustarFonte(newSize);
            updateFontSizeDisplay(newSize);
        });

        document.getElementById('fontSlider').addEventListener('change', function() {
            const newSize = this.value;
            setCookie('fontSize', newSize, 30);
        });
    });

    function ajustarFonte(size) {
        document.body.style.fontSize = size + 'px';
        document.querySelectorAll('.font-adjustable').forEach(function(element) {
            element.style.fontSize = size + 'px';
        });
    }

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    function setCookie(name, value, days) {
        const expires = new Date(Date.now() + days * 864e5).toUTCString();
        document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires}; path=/`;
    }

    function updateFontSizeDisplay(fontSize) {
        document.getElementById('fontSizeDisplay').innerText = `Tamanho da fonte: ${fontSize}px`;
    }

    const imglogo = document.querySelector("#default-logo");
    const imgiconedark = document.querySelector("#indicador");
    const body = document.body;
    const trilho = document.getElementById('trilho');
    const overlay = document.querySelector('.overlay');


    function toggleConfigMenu() {
    const options = document.querySelector('.config-options');
    options.classList.toggle('open');
    }

    function menu_toggle() {
        const mobileNav = document.getElementById('mobile-nav');
        if (mobileNav) {
            mobileNav.classList.toggle('show');
            overlay2.classList.toggle('show');
            document.getElementById('menu_toggle').classList.toggle('Befixed');
        }
    }

    function config_toggle() {
        const pcnav = document.getElementById('configpcnav');
        if (pcnav) {
            pcnav.classList.toggle('show');
            overlay2.classList.toggle('show');
            document.getElementById('config_toggle').classList.toggle('Befixed');
        }
    }

    const overlay2 = document.querySelector('.overlay2');
    overlay2.addEventListener('click', () => {
        const configNav = document.getElementById('configpcnav');
        configNav.classList.remove('show');
        overlay2.classList.remove('show');
    });

    
    document.getElementById('closenav').addEventListener('click', function() {
        const configNav = document.getElementById('configpcnav');
        configNav.classList.remove('show');
        overlay2.classList.remove('show');
    });
</script>

</html>