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

        if (isset($_POST['font_size'])) {
            $fontSize = $_POST['font_size'];
            setcookie('fontSize', $fontSize, time() + (86400 * 30), "/"); 
            $_COOKIE['fontSize'] = $fontSize;
        }
    }
    $themeClass = isset($_COOKIE['dark_mode']) && $_COOKIE['dark_mode'] === '1' ? 'dark-mode' : 'light-mode';

    $fontSize = isset($_COOKIE['fontSize']) ? $_COOKIE['fontSize'] : '16'; 

    $logoSrc = $themeClass === 'dark-mode' ? 'medias/logo/Black-logo.png' : 'medias/logo/Logo-white.png';

    if (isset($_SESSION['log']) && $_SESSION['log'] == "ativo") {
        header("Location: home/");
        exit();
    }
?>

<header class='<?php echo $themeClass; ?>' style="border-bottom-left-radius: 30px; border-bottom-right-radius: 30px; font-size: <?php echo $fontSize; ?>px;">
    <a href="#" id="button-logo-index">
        <img width="120px" id="default-logo" src="<?php echo $logoSrc; ?>" alt="Logo">
    </a>
    <nav id="mobile-nav" class="font-adjustable">
        <ul>
            <li><a href="index.php" class="font-adjustable active">Início</a></li>
            <li><a href="products.php" class="font-adjustable">Produtos</a></li>
            <li><a href="contact.php" class="font-adjustable">Fale conosco</a></li>
        </ul>
    </nav>
    <div id="direita" style="justify-content: center; align-items: center; display: flex;">
        <a href="login/" class="<?php echo $themeClass; ?>" id='entrarlink'>Entrar</a>
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

<div class="loader-container">
  <div class="loader <?php echo $themeClass; ?>"></div>
  <span class="loader-text">Carregando...</span>
</div>
<div class="overlay2" id="overlay2"></div>

<body class="<?php echo $themeClass; ?>" style="font-size: <?php echo $fontSize; ?>px;">
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
                <div class="divslide" style="width: 100%; height: 100%; background-image: url('medias/baninit.png');"></div>
            </div>
            <div class="slide">
                <div class="divslide" style="width: 100%; height: 100%; background-image: url('medias/banconnect.png');"></div>
            </div>
            <div class="slide">
                <div class="divslide" style="width: 100%; height: 100%; background-image: url('medias/banmundo.png');"></div>
            </div>
            <div class="slide">
                <div class="divslide" style="width: 100%; height: 100%; background-image: url('medias/banabasteca.png');"></div>
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
        <div id="conteudo" style="width: 55%; margin-bottom: 30px;">
            <h1>Quem somos?</h1>
            <p style="margin-top: 4%;">
            Na SUPCOM, estamos comprometidos em facilitar a jornada de micro e pequenos negócios ao conectar diretamente fornecedores às necessidades específicas de cada 
            lojista. Nossa plataforma nasceu da necessidade de simplificar e fortalecer essas parcerias, oferecendo um ambiente digital seguro e eficiente para que empresas prosperem 
            juntas.
            <br><br>
            Nosso foco vai além da simples conexão. Acreditamos que a união entre fornecedores e lojistas é a base para alcançar resultados duradouros e significativos. Com um compromisso
             claro com a eficiência e a transparência, buscamos não apenas atender, mas superar as expectativas de nossos clientes, proporcionando oportunidades de crescimento sustentável 
             em um mercado cada vez mais dinâmico.
            </p>
            <h1>Venha conhecer a SUPCOM</h1>
            <p>
            Queremos simplificar e fortalecer as conexões entre micro e pequenos lojistas e fornecedores, criando uma plataforma eficiente e acessível que impulsione o crescimento de ambos.
             Guiados pelos valores de transparência, assegurando negociações claras e acessíveis; eficiência, proporcionando soluções rápidas e práticas; e colaboração, acreditando que o crescimento mútuo 
             é fruto de parcerias fortes, buscamos oferecer um ambiente onde a confiança e as relações duradouras floresçam. Assim, promovemos resultados sustentáveis e geramos oportunidades reais 
             de sucesso para todos os nossos clientes.
            </p>
            <div id="fotinhas" style="width: 100%; height: 500px; display: flex; justify-content: space-between; margin-top: 35px;">
                <div class="fotinha-container">
                    <div id="fotinha" style="background-image: url('medias/caio_cort.jpg');"></div>
                    <p class="fotinha-name <?php echo $themeClass; ?>">Caio Custódio Parolin</p>
                    <p class="fotinha-handle <?php echo $themeClass; ?>"><a href="https://www.instagram.com/parolincaio_/" target="_blank"><i class="fab fa-instagram"></i> @parolincaio_</a></p>
                </div>
                <div class="fotinha-container">
                    <div id="fotinha" style="background-image: url('medias/leo_cort.jpg');"></div>
                    <p class="fotinha-name <?php echo $themeClass; ?>">Leonardo Moreira Nakashima Monteiro</p>
                </div>
                <div class="fotinha-container">
                    <div id="fotinha" style="background-image: url('medias/fael_cort.jpg');"></div>
                    <p class="fotinha-name <?php echo $themeClass; ?>">Rafael Santos Rodrigues</p>
                    <p class="fotinha-handle <?php echo $themeClass; ?>"><a href="https://www.instagram.com/fael_v8/" target="_blank"><i class="fab fa-instagram"></i> @fael_v8</a></p>
                </div>
                <div class="fotinha-container">
                    <div id="fotinha" style="background-image: url('medias/raul_cort.jpg');"></div>
                    <p class="fotinha-name <?php echo $themeClass; ?>">Raul Ribeiro Fialho</p>
                    <p class="fotinha-handle <?php echo $themeClass; ?>"><a href="https://www.instagram.com/f.r4ul/" target="_blank"><i class="fab fa-instagram"></i> @f.r4ul</a></p>
                </div>
            </div>

            <style>
                #fotinha {
                    background-position: center;
                    background-size: cover;
                    width: 100%;
                    height: 75%;
                    border-radius: 30px;  
                }
                .fotinha-container {
                    text-align: center;
                    width: 25%;
                    margin-left: 20px;
                }
                .fotinha-name {
                    margin-top: 10px;
                    font-weight: bold;
                    font-family: Arial, sans-serif;
                }
                .fotinha-name.light-mode {
                    color: #333;
                }
                .fotinha-name.dark-mode {
                    color: #E8F1F2;
                }
                .fotinha-handle {
                    margin-top: 5px;
                    font-size: 15pt;
                    font-family: Arial, sans-serif;
                }
                .fotinha-handle a {
                    text-decoration: none;
                }
                .fotinha-handle.light-mode a {
                    color: #333;
                }
                .fotinha-handle.dark-mode a {
                    color: #E8F1F2;
                }
            </style>

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
                </ul>
            </p>
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
            <img src="medias/logo/Black-logo.png">
            <p style="font-size: 20pt;">União e resultados.</p>
        </center>
    </div>
    <div id="parts">
        <center>
            <h1>Contate-nos!</h1>
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css'>
            <a target="_blank" href="https://www.instagram.com/officialsupcom/" style="text-decoration: none;"><i class="fab fa-instagram" title="Instagram" id="Instagram"></i></a>
            <a href="contact.php" style="text-decoration: none;"><i class="fa fa-envelope-o" style="font-family: FontAwesome; margin-left: 20px;" id="Instagram"></i></a>
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
        document.querySelector('#bemvindo').style.opacity = 100;
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

<!--<script src="js/script.js"></script>-->
</html>