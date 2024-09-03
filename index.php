<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Bem vindo(a)</title>
    <link rel="shortcut icon" href="medias/logo/Supcom-white.png" type="image/x-icon">
    <link rel="stylesheet" href="css/basics.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="slider.css">
    <link rel="stylesheet" href="css/mobile.css">
</head>

<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $darkMode = isset($_POST['dark_mode']);
        setcookie('dark_mode', $darkMode ? '1' : '0', time() + (86400 * 30), "/");
        $_COOKIE['dark_mode'] = $darkMode ? '1' : '0';
    }
    $themeClass = isset($_COOKIE['dark_mode']) && $_COOKIE['dark_mode'] === '1' ? 'dark-mode' : 'light-mode';

    $logoSrc = $themeClass === 'dark-mode' ? 'medias/logo/Black-logo.png' : 'medias/logo/Logo-white.png';
?>


<header class="<?php echo $themeClass; ?>">
    <a href="#" id="button-logo-index">
        <img width="120px" id="default-logo" src="<?php echo $logoSrc; ?>" alt="Logo">
    </a>
    <div id="direita" style="justify-content: center; align-items: center; display: flex;">
        <a href="login/" class="<?php echo $themeClass; ?>">Entrar</a>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <button class="config-toggle <?php echo $themeClass; ?>" id="config_toggle" onclick="config_toggle()"><i class="fa fa-gear"></i></button>
    </div>
</header>

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
                overlay2.classList.add('show');
                configNavPc.classList.add('no-transition');
                configNavPc.classList.add('show');
                localStorage.removeItem('showConfigNav');
                
                setTimeout(() => {
                    configNavPc.classList.remove('no-transition');
                }, 0);
            }
        }
    });
</script>


<div class="overlay2" id="overlay2"></div>

<body class="<?php echo $themeClass; ?>">
    <div id="bemvindo" class="<?php echo $themeClass; ?>">
        <div id="comecarcom">
            <h1>Bem vindo(a) a <br> SUPCOM!</h1>
            <a href="signup/" class="comecarcomanti" style="font-family: arial;">Começar com SUPCOM!</a>
            <a href="signup/" class="comecarcomsupbutton" style="font-family: arial;">Começar com<br>SUPCOM!</a>
        </div>
        <div id="imagem-contraria"></div>
    </div>

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

    <div class="slider">
        <div class="slides">
            <input type="radio" name="radio-btn" id="radio1">
            <input type="radio" name="radio-btn" id="radio2">
            <input type="radio" name="radio-btn" id="radio3">
            <input type="radio" name="radio-btn" id="radio4">

            <div class="slide first">
                <div class="divslide" style="width: 100%; height: 100%; background-image: url('medias/bannerdrone.png');"></div>
            </div>
            <div class="slide">
                <div class="divslide" style="width: 100%; height: 100%; background-image: url('medias/bannerabast.png');"></div>
            </div>
            <div class="slide">
                <div class="divslide" style="width: 100%; height: 100%; background-image: url('medias/bannerforn.png');"></div>
            </div>
            <div class="slide">
                <div class="divslide" style="width: 100%; height: 100%; background-image: url('medias/bannermundo.png');"></div>
            </div>

            <div class="navigation-auto">
                <div class="auto-btn1"></div>
                <div class="auto-btn2"></div>
                <div class="auto-btn3"></div>
                <div class="auto-btn4"></div>
            </div>
        </div>

        <div class="manual-navigation">
            <label for="radio1" class="manual-btn"></label>
            <label for="radio2" class="manual-btn"></label>
            <label for="radio3" class="manual-btn"></label>
            <label for="radio4" class="manual-btn"></label>
        </div>
    </div>

    <div id="container">
        <div id="conteudo">
            <h1>O que é a SUPCOM?</h1>
            <p>A SUPCOM é uma plataforma que busca facilitar a conexão entre uma empresa fornecedora e o lojista, que necessita de mercadorias e contatos confiáveis.</p>

            <h1>Missão, Visão e Valores</h1>
            <h2>Missão</h2>
            <p>Nossa missão é capacitar micro e pequenas empresas, fornecendo uma plataforma B2B intuitiva e eficiente que facilita a conexão entre fornecedores e lojistas. Estamos comprometidos em reduzir barreiras e promover a eficiência operacional, permitindo que os empreendedores alcancem seu potencial máximo no mercado.</p>
            <h2>Visão</h2>
            <p>Nosso objetivo é ser a principal plataforma de referência para transações B2B entre micro e pequenas empresas, reconhecida por nossa inovação, transparência e compromisso com o sucesso dos nossos usuários. Visualizamos um ambiente de negócios mais dinâmico e acessível, impulsionado pela nossa tecnologia e foco na experiência do cliente.</p>
            <h2>Valores</h2>
            <p>
                <ul>
                    <li><b>Inovação:</b> Buscamos constantemente maneiras criativas de melhorar e evoluir nossa plataforma, antecipando as necessidades do mercado e oferecendo soluções inovadoras.</li>
                    <li><b>Transparência:</b> Promovemos a transparência em todas as nossas interações, construindo relações sólidas e baseadas na confiança com nossos usuários e parceiros.</li>
                    <li><b>Eficiência:</b> Priorizamos a eficiência em todos os aspectos do nosso trabalho, desde a interface do usuário até o suporte técnico, para garantir uma experiência fluida e produtiva para nossos clientes.</li>
                    <li><b>Empoderamento:</b> Acreditamos no poder das micro e pequenas empresas e estamos empenhados em capacitá-las, fornecendo as ferramentas e recursos necessários para que alcancem o sucesso.</li>
                    <li><b>Compromisso com o cliente:</b> Colocamos as necessidades e interesses dos nossos clientes em primeiro lugar, comprometendo-nos a oferecer um serviço excepcional e atendimento personalizado em todas as etapas da jornada do usuário.</li>
            </p>
        </div>
    </div>

</body>

<footer>
    <div id="parts">
        <center>
            <h1>Integrantes</h1>
            <p class="nomes_inte">• Caio Custódio Parolin</p>
            <p class="nomes_inte">• Leonardo M. Nakashima Monteiro</p>
            <p class="nomes_inte">• Rafael Santos Rodrigues</p>
            <p class="nomes_inte">• Raul Ribeiro Fialho</p>
        </center>
    </div>
    <div id="parts">
        <center>
            <img src="medias/logo/Black-logo.png">
            <p style="font-size: 20pt;">União e resultados.</p>
        </center>
    </div>
    <div id="parts">
        <center>
            <h1>Contate-nos!</h1>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css'>
            <a target="_blank" href="https://www.instagram.com/officialsupcom/" style="text-decoration: none;"><i class="fab fa-instagram" title="Instagram" id="Instagram"></i></a>
        </center>
    </div>
</footer>


<script type="text/javascript" >
    var count = 1;
    document.getElementById("radio1").checked = true;
    setInterval( function() {
        nextImage();
    }, 6000)
    function nextImage() {
        count++;
        if(count > 4) {
            count = 1;
        }
        document.getElementById("radio" + count).checked = true;
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
        const mobileNav = document.getElementById('mobile-nav');
        const pcnav = document.getElementById('configpcnav');
        if (mobileNav) {
            mobileNav.classList.remove('show');
            overlay2.classList.remove('show');
            document.getElementById('menu_toggle').classList.remove('Befixed');
        }
        if (pcnav) {
        pcnav.classList.remove('show');
        overlay2.classList.remove('show');
        }
    });

    closebutton = document.getElementById("closenav");
    closebutton.addEventListener('click', () => {
    const mobileNav = document.getElementById('mobile-nav');
    const pcnav = document.getElementById('configpcnav');
    if (mobileNav) {
        mobileNav.classList.remove('show');
        overlay2.classList.remove('show');
        document.getElementById('menu_toggle').classList.remove('Befixed');
    }
    if (pcnav) {
        pcnav.classList.remove('show');
        overlay2.classList.remove('show');
    }
    });
</script>

<!--<script src="js/script.js"></script>-->
</html>