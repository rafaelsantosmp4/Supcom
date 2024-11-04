<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sobre nós</title>
    <link rel="shortcut icon" href="../medias/logo/Supcom-white.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/basics.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mobile.css">
</head>

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
    <a href="../home" id="button-logo-index"><img width="120px" id="default-logo" src="<?php echo $logoSrc; ?>"></a>
    <nav id="mobile-nav" class="font-adjustable">
        <ul>
            <li><a href="../home" class="font-adjustable">Início</a></li>
            <li><a href="../forns/" class="font-adjustable">Fornecedores</a></li>
            <li><a href="../about/" class="font-adjustable active">Sobre nós</a></li>
            <li><a href="../contact/" class="font-adjustable">Fale conosco</a></li>
            <li class="config-menu">
                <div class="font-adjustable" style="font-size: 40pt; padding: 10px 30px;" id="config-button" onclick="toggleConfigMenu()">Configurações <i class="fa fa-caret-down"></i></div>
                <ul id="config-options" class="config-options font-adjustable">
                    <li>CONFIGS HERE</li>
                </ul>
            </li>
        </ul>
    </nav>
    <div style="justify-content: center; align-items: center; display: flex;">
        <a href="../chat/" style="color: inherit; text-decoration: none; font-size: inherit; font-weight: inherit;" id="linkupload" class="<?php echo $themeClass; ?>">
            <button class="uploadbutton <?php echo $themeClass; ?>" id="uploadbutton">
                <i class="fa fa-commenting-o" style="font-family: FontAwesome;"></i>
                <span id="message-notification" class="notification-icon" style="display: none;"></span>
                <audio id="notification-sound" src="../chat/notification.mp3" preload="auto"></audio>
            </button>
        </a>
        <?php
            include('../conexao/conexao.php');
            $db = new BancodeDados();
            $db->conecta();
            $iduser = $_SESSION['id'];
            $query = "SELECT * FROM usuarios WHERE id_usuario = '$iduser'";
            $result = mysqli_query($db->con, $query);
            $usuario = mysqli_fetch_assoc($result);
            $nome = $usuario['nome'];
            
            if ($usuario["tipo_usuario"] == "fornecedor") {
                echo '<a href="../upload/" id="linkupload" class="'. $themeClass .'"><button class="uploadbutton '. $themeClass .' id="uploadbutton" onclick="../upload/"><i class="fa fa-upload"></i></a>';
            }
        ?>
        <button class="config-toggle <?php echo $themeClass; ?>" id="config_toggle" onclick="config_toggle()"><i class="fa fa-gear"></i></button>
        <div id='account-button' onclick='toggleAccountMenu()' style="position: relative;">
            <?php
                echo "<div style='display: flex; align-items: center;'><img src='../chat/getprofilepfp.php?id=$iduser' style='margin-right: 10px; width: 40px; height: 40px; border-radius: 50%; object-fit: cover;'> <div id='fullname' class='font-adjustable'>Bem-vindo, $nome </div><i class='fa fa-caret-down'></i></div>";
            ?>
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

    <div class="overlay"></div>


    <div id="container">
        <div id="conteudo" style="width: 55%; margin-bottom: 30px;">
            <h1>Quem somos?</h1>
            <p style="margin-top: 4%;">
            Na SUPCOM, estamos comprometidos em facilitar a jornada de micro e pequenos negócios ao conectar diretamente fornecedores confiáveis às necessidades específicas de cada 
            lojista. Nossa plataforma nasceu da necessidade de simplificar e fortalecer essas parcerias, oferecendo um ambiente digital seguro e eficiente para que empresas prosperem 
            juntas.
            <br><br>
            Nosso foco vai além da simples conexão. Acreditamos que a união entre fornecedores e lojistas é a base para alcançar resultados duradouros e significativos. Com um compromisso
             claro com a eficiência e a transparência, buscamos não apenas atender, mas superar as expectativas de nossos clientes, proporcionando oportunidades de crescimento sustentável 
             em um mercado cada vez mais dinâmico.
             <br><br>
             Nossa missão é impulsionar o sucesso de negócios em todos os estágios, desde startups até empreendimentos estabelecidos. Valorizamos relações construídas sobre confiança 
             mútua e dedicação ao serviço ao cliente, colocando sempre a excelência e a inovação no centro de tudo que fazemos.
            </p>
            <h1>Venha conheçer a SUPCOM</h1>
            <p>
            Queremos simplificar e fortalecer as conexões entre micro e pequenos lojistas e fornecedores, criando uma plataforma eficiente e acessível que impulsione o crescimento de ambos.
             Guiados pelos valores de transparência, assegurando negociações claras e acessíveis; eficiência, proporcionando soluções rápidas e práticas; e colaboração, acreditando que o crescimento mútuo 
             é fruto de parcerias fortes e confiáveis, buscamos oferecer um ambiente onde a confiança e as relações duradouras floresçam. Assim, promovemos resultados sustentáveis e geramos oportunidades reais 
             de sucesso para todos os nossos clientes.
            </p>
            <div id="fotinhas" style="width: 100%; height: 500px; display: flex; justify-content: space-between; margin-top: 35px;">
                <div class="fotinha-container">
                    <div id="fotinha" style="background-image: url('../medias/caio_cort.jpg');"></div>
                    <p class="fotinha-name <?php echo $themeClass; ?>">Caio Custódio Parolin</p>
                    <p class="fotinha-handle <?php echo $themeClass; ?>"><a href="https://www.instagram.com/parolincaio_/" target="_blank"><i class="fab fa-instagram"></i> @parolincaio_</a></p>
                </div>
                <div class="fotinha-container">
                    <div id="fotinha" style="background-image: url('../medias/leo_cort.jpg');"></div>
                    <p class="fotinha-name <?php echo $themeClass; ?>">Leonardo Moreira Nakashima Monteiro</p>
                </div>
                <div class="fotinha-container">
                    <div id="fotinha" style="background-image: url('../medias/fael_cort.jpg');"></div>
                    <p class="fotinha-name <?php echo $themeClass; ?>">Rafael Santos Rodrigues</p>
                    <p class="fotinha-handle <?php echo $themeClass; ?>"><a href="https://www.instagram.com/fael_v8/" target="_blank"><i class="fab fa-instagram"></i> @fael_v8</a></p>
                </div>
                <div class="fotinha-container">
                    <div id="fotinha" style="background-image: url('../medias/raul_cort.jpg');"></div>
                    <p class="fotinha-name <?php echo $themeClass; ?>">Raul Ribeiro Fialho</p>
                    <p class="fotinha-handle <?php echo $themeClass; ?>"><a href="https://www.instagram.com/f.r4ul/" target="_blank"><i class="fab fa-instagram"></i> @f.r4ul</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    const iduser = '<?php echo $iduser; ?>';
    let previousData = [];
    let lastNotifiedUserId = null;

    if (!localStorage.getItem('NotificationFinish')) {
        async function fetchConversations() {
            const response = await fetch(`../chat/get_conversations.php?iduser=${iduser}`);
            const userData = await response.json();
            
            userData.forEach(user => {
                const userId = user.id;
                if (user.notificada && userId !== lastNotifiedUserId) {
                    document.getElementById('notification-sound').play();
                    lastNotifiedUserId = userId;
                    document.getElementById('message-notification').style.display = 'block';
                    localStorage.setItem('NotificationFinish', 'true');
                }
            });
            previousData = userData;
        }

        setInterval(fetchConversations, 1000);
        fetchConversations();
    } else {
        document.getElementById('message-notification').style.display = 'block';
    }
</script>
<?php include '../universal/footer.php';?>

<script src="../js/script.js"></script>
</html>