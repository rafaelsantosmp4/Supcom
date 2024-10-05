<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
    <link rel="shortcut icon" href="../medias/logo/Supcom-white.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/basics.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mobile.css">
</head>

<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $darkMode = isset($_POST['dark_mode']);
        setcookie('dark_mode', $darkMode ? '1' : '0', time() + (86400 * 30), "/");
        $_COOKIE['dark_mode'] = $darkMode ? '1' : '0';
    }
    $themeClass = isset($_COOKIE['dark_mode']) && $_COOKIE['dark_mode'] === '1' ? 'dark-mode' : 'light-mode';

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
            <li><a href="../forns/" class="active">Fornecedores</a></li>
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
                echo "<div style='display: flex; align-items: center;'><img src='../chat/getprofilepfp.php?id=$iduser' style='margin-right: 10px; width: 40px; height: 40px; border-radius: 50%; object-fit: cover;'> <div id='fullname'>Bem-vindo, $nome </div><i class='fa fa-caret-down'></i></div>";
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

    <div id="container">
        <div id="conteudo">
        <form action="" method="GET" id="formBarraBusca">
            <center>
                <input type='text' placeholder='Busca' id="barrabusca" name="busca">
                <button type="submit" class="produto-link" style="background: none; border: none; cursor: pointer;">
                    <i class="fa fa-search" style="font-size: 25pt;"></i>
                </button>
            </center>
        </form>            
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    $busca_nome = isset($_GET['busca']) ? mysqli_real_escape_string($db->con, $_GET['busca']) : '';
                    
                    echo"<script>document.getElementById('barrabusca').value = '$busca_nome';</script>";

                    $queryprods = "SELECT * FROM produto WHERE nome_produto LIKE '%$busca_nome%'";
                    $resultprods = mysqli_query($db->con, $queryprods);
    
                    $prod_count = 0;
                    $prod_per_category = 4;
                    $first_category = true;

                    if (mysqli_num_rows($resultprods) == 0) {
                        echo"
                            <h1 align='center'>Não há resultados para sua busca!</h1>
                            <div style='font-size: 300px; text-align: center; margin-bottom: 100px;'>:(</div>
                        ";
                    } else {
                        echo"
                            <h1 align='center'>Todos os produtos</h1>
                            <h2>Adicionados recentemente</h2>
                        ";

                        while ($produto = mysqli_fetch_assoc($resultprods)) {
                            // Inicia uma nova categoria se necessário
                            if ($prod_count % $prod_per_category == 0) {
                                if (!$first_category) {
                                    echo '</div>';
                                    echo '</div>';
                                }
                                echo '<div class="categoria">';
                                echo '<div class="produtos">';
                                $first_category = false;
                            }
        
                            $nome_produto = $produto['nome_produto'];
                            $descricao_produto = $produto['descricao_produto'];
                            $preco_produto = $produto['preco_produto'];
                            $foto_produto = base64_encode($produto['foto_prod']);
                            $id_produto = $produto['id_produto'];
        
                            $id_forn = $produto['id_forn'];
                            $tempquery = "SELECT nome FROM usuarios WHERE id_usuario = '$id_forn'";
                            $tempresult = mysqli_query($db->con, $tempquery);
                            $tempusuario = mysqli_fetch_assoc($tempresult);
                            $nome_forn = $tempusuario['nome'];
                            $nome_produto_encoded = urlencode($nome_produto);
                        ?>
                            <a href="../product/index.php?id=<?php echo $id_produto; ?>&<?php echo $nome_produto_encoded; ?>" class="produto-link <?php echo $themeClass; ?>">
                                <div class="produto <?php echo $themeClass; ?>">
                                    <img src="data:image/jpeg;base64,<?php echo $foto_produto; ?>" alt="<?php echo $nome_produto; ?>">
                                    <h3 title="<?php echo $nome_produto; ?>"><?php echo $nome_produto; ?></h3>
                                    <p title="<?php echo $descricao_produto; ?>" class="descricao-produto"><?php echo $descricao_produto; ?></p>
                                    <h4 style="margin-top: 5px; margin-bottom: 0px;"><?php echo $nome_forn; ?></h4>
                                    <h3><?php echo $preco_produto; ?></h3>
                                </div>
                            </a>
                        <?php
                                $prod_count++;
                            }
                            if ($prod_count > 0) {
                                echo '</div>'; // Fecha div produtos
                                echo '</div>'; // Fecha div categoria
                            }
                    }
                }
            ?>
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
<?php include '../universal/footer.php'; ?>

<script src="../js/script.js"></script>
</html>