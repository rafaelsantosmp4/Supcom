<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Início</title>
    <link rel="shortcut icon" href="../medias/logo/Supcom-white.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/basics.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mobile.css">
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
    }
    $themeClass = isset($_COOKIE['dark_mode']) && $_COOKIE['dark_mode'] === '1' ? 'dark-mode' : 'light-mode';

    $logoSrc = $themeClass === 'dark-mode' ? '../medias/logo/Black-logo.png' : '../medias/logo/Logo-white.png';

    if($_SESSION['log'] != "ativo") {
        echo"<script>alert('Você precisa entrar na sua conta para continuar.'); window.location.href = '../login/index.php';</script>";
    }
?>
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
                echo "Bem-vindo, $nome";
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
<div class="overlay3" id="overlay3"></div>
<div class="loader-container">
  <div class="loader <?php echo $themeClass; ?>"></div>
  <span class="loader-text <?php echo $themeClass; ?>">Carregando...</span>
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

    <div id="container">
        <div id="conteudo">                
            <?php
                $idenviado = $_GET['idforn'];
                $queryprods = "SELECT * FROM usuarios WHERE id_usuario = $idenviado";
                $resultprods = mysqli_query($db->con, $queryprods);
                $usuarioprods = mysqli_fetch_assoc($resultprods);
                $nome_forn = $usuarioprods['nome'];
                $nome_forn_encoded = urlencode($nome_forn);

                $foto = $usuarioprods['perfil_foto'];
                if ($foto) {
                    $foto_base64 = base64_encode($foto);
                    $foto_mime = 'image/png';
                    $foto_url = "data:$foto_mime;base64,$foto_base64";
                } else {
                    $foto_url = '../medias/iconpfp.jpg';
                }
            ?>
            <a href=<?php echo "../profile/company.php?id=$idenviado&nome=$nome_forn_encoded"; ?> id="initialnamelink"><div id="initialname" style='display: flex; align-items: center; justify-content: center; margin-top: 10px;'>
                <img id="perfilfoto" src="<?php echo $foto_url; ?>" alt="Foto de Perfil" style="width: 80px; height: 80px; border-radius: 50%; margin-right: 10px;">
                <h1 id="titulochat">Carregando...</h1>
            </div></a>
            <div id="chat">
                <div id="messages"></div>
                <div class="message-container" style="position: relative; display: flex; justify-content: center;">
                    <input id="message" type="text" placeholder="Digite sua mensagem" />
                    <button id="send" style='background: none; border: none;'><i id="sendicon" class="fa fa-paper-plane <?php echo $themeClass; ?>"></i></button>
                </div>
                <div id="context-menu" class="context-menu" style="display:none;">
                    <ul>
                        <li id="edit-message"><i class="fa fa-pencil" style='font-family: FontAwesome;'></i> Editar</li>
                        <li id="delete-message" style='color: #EE2B39;'><i class="fa fa-trash"></i> Deletar</li>
                    </ul>
                </div>
            </div>

            <script>
                document.getElementById('send').addEventListener('click', sendMessage); 
                document.getElementById('message').addEventListener('keypress', function(e) {
                    var key = e.which || e.keyCode;
                    if (key === 13) { 
                        e.preventDefault(); 
                        sendMessage(); 
                    }
                });

                function sendMessage() {
                    var message = document.getElementById('message').value;
                    if (message.trim() === '') return; 
                    fetch('sendMessage.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'message=' + encodeURIComponent(message) + '&sender_id=' + myId + '&receiver_id=' + chatPartnerId
                    }).then(() => {
                        document.getElementById('message').value = ''; 
                        fetchMessages(); 
                    });
                }

                var urlParams = new URLSearchParams(window.location.search);
                var myId = urlParams.get('myid'); 
                var chatPartnerId = urlParams.get('idforn');
                var partnerName = '';

                document.getElementById('send').addEventListener('click', function() {
                    var message = document.getElementById('message').value;

                    if(message != '') {
                        fetch('sendMessage.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'message=' + encodeURIComponent(message) + '&sender_id=' + myId + '&receiver_id=' + chatPartnerId
                        }).then(() => {
                            document.getElementById('message').value = ''; 
                            fetchMessages(); 
                        });
                    } else {
                        Swal.fire({
                        title: 'Sem conteúdo!',
                        text: 'Sua mensagem precisa ter algum conteúdo.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                        })
                    }
                });

                let firstLoad = true; // Variável de controle para a primeira carga de mensagens
                function fetchMessages() {
                    fetch('getMessages.php?myid=' + myId + '&idforn=' + chatPartnerId)
                        .then(response => response.json())
                        .then(data => {
                            partnerName = data.partner_name;
                            var messages = data.messages;
                            var messagesDiv = document.getElementById('messages');
                            messagesDiv.innerHTML = '';
                            messages.forEach(function(message) {
                                var msgElement = document.createElement('div');
                                msgElement.className = message.sender_id == myId ? 'message-sent' : 'message-received';
                                msgElement.setAttribute('data-message-id', message.id);

                                var sender = message.sender_id == chatPartnerId ? partnerName : 'Eu';
                                var timestamp = new Date(message.created_at);
                                var options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' };
                                var formattedTime = timestamp.toLocaleDateString('pt-BR', options);

                                msgElement.innerHTML = `
                                    <div class="message-body">
                                        <p>${message.messagetext}</p>
                                        <span class="message-timestamp">${formattedTime}</span>
                                    </div>
                                `;
                                messagesDiv.appendChild(msgElement);
                            });

                            document.getElementById('titulochat').innerHTML = partnerName;
                            if (firstLoad) {
                                messagesDiv.scrollTop = messagesDiv.scrollHeight; 
                                firstLoad = false; 
                            }
                            var isAtBottom = messagesDiv.scrollHeight - messagesDiv.scrollTop === messagesDiv.clientHeight;
                            if (isAtBottom) {
                                messagesDiv.scrollTop = messagesDiv.scrollHeight;
                            }
                        });
                }
                window.onload = function() {
                    fetchMessages();
                };
                setInterval(fetchMessages, 3000);

                let selectedMessageId = null;
                document.getElementById('messages').addEventListener('contextmenu', function(e) {
                    e.preventDefault(); 
                    const messageElement = e.target.closest('.message-sent') || e.target.closest('.message-received');                    
                    if (messageElement) {
                        const isSentByUser = messageElement.classList.contains('message-sent'); 
                        if (isSentByUser) {
                            selectedMessageId = messageElement.dataset.messageId;
                            const contextMenu = document.getElementById('context-menu');
                            contextMenu.style.display = 'block';
                            contextMenu.style.left = `${e.pageX}px`;
                            contextMenu.style.top = `${e.pageY}px`;
                        }
                    }
                });
                window.addEventListener('click', function() {
                    const contextMenu = document.getElementById('context-menu');
                    contextMenu.style.display = 'none';
                });
                document.getElementById('edit-message').addEventListener('click', function() {
                    if (selectedMessageId) {
                        alert(`Editar mensagem com ID: ${selectedMessageId}`);
                    }
                });

                document.getElementById('delete-message').addEventListener('click', function() {
                    if (selectedMessageId) {
                        Swal.fire({
                            title: 'Tem certeza?',
                            text: "Você não poderá desfazer essa ação!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sim, apagar!',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch('deleteMessage.php?message_id=' + encodeURIComponent(selectedMessageId), {
                                    method: 'GET',
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'success') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Sucesso!',
                                            text: data.message
                                        }).then(() => {
                                            fetchMessages();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Erro!',
                                            text: data.message,
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            </script>
        </div>
    </div>
</body>

<?php include '../universal/footer.php';?>

<script src="../js/script.js"></script>
</html>