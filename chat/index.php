<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Conversas</title>
    <link rel="shortcut icon" href="../medias/logo/Supcom-white.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/basics.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mobile.css">
    <link rel="stylesheet" href="../css/chat.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4/bootstrap-4.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    if($_SESSION['log'] != "ativo") {
        echo"<script>alert('Você precisa entrar na sua conta para continuar.'); window.location.href = '../login/index.php';</script>";
    }
?>
<header class='<?php echo $themeClass; ?>' style="border-bottom-left-radius: 30px; border-bottom-right-radius: 30px; font-size: <?php echo $fontSize; ?>px;">
    <a href="../home" id="button-logo-index"><img width="120px" id="default-logo" src="<?php echo $logoSrc; ?>"></a>
    <nav id="mobile-nav" class="font-adjustable">
        <ul>
            <li><a href="../home" class="font-adjustable">Início</a></li>
            <li><a href="../forns/" class="font-adjustable">Fornecedores</a></li>
            <li><a href="../about/" class="font-adjustable">Sobre nós</a></li>
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
        <a href="../chat/" style="color: inherit; text-decoration: none; font-size: inherit; font-weight: inherit;" id="linkupload" class="'. $themeClass .'">
            <button class="uploadbutton <?php echo $themeClass; ?>" id="uploadbutton">
                <i class="fa fa-commenting-o" style="font-family: FontAwesome;"></i>
                <span id="message-notification" class="notification-icon"></span>
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
                <?php
                    if ($usuario["tipo_usuario"] == "fornecedor") {
                        echo '<li><a href="../dashboard/">Dashboard <i class="fa fa-table" style="font-family: FontAwesome;"></i></a></li>';
                    }
                ?>
                <li><a href='../logout/'>Sair da conta <i class="fa fa-sign-out" style="font-family: FontAwesome;"></i></a></li>
            </ul>
        </div>
    </div>

    <button class="menu-toggle" id="menu_toggle" onclick="menu_toggle()">&#9776;</button>
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
<div class="overlay2" id="overlay2"></div>
<div class="overlay3" id="overlay3"></div>
<div class="loader-container">
  <div class="loader <?php echo $themeClass; ?>"></div>
  <span class="loader-text <?php echo $themeClass; ?>">Carregando...</span>
</div>

<body class="<?php echo $themeClass; ?>" style='overflow: hidden; font-size: <?php echo $fontSize; ?>px;'>
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
        <div id="lateralchats">
            <h1 align='center'>Conversas</h1>
            <ul id="conversations-list"></ul>
            <audio id="notification-sound" src="notification.mp3" preload="auto"></audio>
            <script>
                const iduser = '<?php echo $iduser; ?>';
                let previousData = [];
                let lastNotifiedUserId = null;

                async function updateMessageStatusToRead(userId, recipientId) {
                    const response = await fetch('update_message_status.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ userId, recipientId })
                    });
                    if (!response.ok) {
                        console.error('Erro ao atualizar o status da mensagem:', response.statusText);
                    }
                }

                async function fetchConversations() {
                    const response = await fetch(`get_conversations.php?iduser=${iduser}`);
                    const userData = await response.json();
                    updateConversationsList(userData);

                    const urlParams = new URLSearchParams(window.location.search);
                    const idforn = urlParams.get('idforn');

                    if (idforn) {
                        const userToUpdate = userData.find(user => user.id == idforn);
                        if (userToUpdate && userToUpdate.sender_id !== iduser) {
                            await updateMessageStatusToRead(iduser, idforn);
                        }
                    }
                }

                function updateConversationsList(userData) {
                    const listElement = document.getElementById('conversations-list');                    
                    userData.forEach(user => {
                        const userId = user.id;
                        const userName = user.nome;
                        const userImageUrl = `getprofilepfp.php?id=${userId}`;
                        const lastMessage = user.ultima_mensagem || "<i>Nenhuma mensagem</i>";
                        const existingItem = previousData.find(item => item.id === userId);

                        if (existingItem) {
                            const listItem = listElement.querySelector(`[data-user-id='${userId}']`);
                            if (listItem) {
                                listItem.querySelector('.last-message').innerHTML = lastMessage;
                                const notificationDot = listItem.querySelector('.notification-dot');
                                notificationDot.style.display = user.notificada ? 'block' : 'none';

                                if (user.notificada && userId !== lastNotifiedUserId) {
                                    if(!localStorage.getItem('NotificationFinish')) {
                                        document.getElementById('notification-sound').play();
                                    }
                                    lastNotifiedUserId = userId;
                                    document.getElementById('message-notification').style.display = 'block';
                                }
                            }
                        } else {
                            const listItem = document.createElement('li');
                            listItem.setAttribute('data-user-id', userId);
                            listItem.innerHTML = `
                                <a href='company.php?myid=${iduser}&idforn=${userId}'>
                                    <div class='prfchat'>
                                        <span class='notification-dot' style='display: ${user.notificada ? 'block' : 'none'};'></span>
                                        <div class='prfchatflex'>
                                            <img src='${userImageUrl}' alt='${userName}' class='user-image' />
                                            <div class="font-adjustable" style="margin-left: 5px;">
                                                <span class="font-adjustable">${userName}</span>
                                                <div class="last-message font-adjustable">${lastMessage}</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            `;
                            listElement.appendChild(listItem);
                        }
                    });
                    previousData = userData;
                }

                setInterval(fetchConversations, 100);
                fetchConversations();
            </script>
        </div>

        <div id="conteudo">
            <H1>INICIE UMA CONVERSA!</H1>
        </div>
    </div>
</body>

<div style="display: none;">
<?php include '../universal/footer.php';?>
</div>

<script src="../js/script.js"></script>

</html>