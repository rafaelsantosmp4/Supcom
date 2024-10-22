<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar produto</title>
    <link rel="shortcut icon" href="../medias/logo/Supcom-white.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/basics.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mobile.css">    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4/bootstrap-4.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function() {
        var $preco = $('#preco');
        $preco.mask('000.000.000.000.000,00', {reverse: true});
        function formatPreco() {
            var value = $preco.val().replace(/\D/g, '');
            if (value) {
                value = value.replace(/(\d)(\d{2})$/, "$1,$2");
                value = value.replace(/(?=(\d{3})+(\D))\B/g, '.');
                $preco.val('R$ ' + value);
            } else {
                $preco.val('R$ ');
            }
        }
        $preco.on('input', formatPreco);
        $preco.on('focus', function() {
            var value = $preco.val().replace('R$ ', '');
            value = value.replace(/\./g, '').replace(',', '.');
            $preco.val(value);
        });
        $preco.on('blur', formatPreco);
    });
</script>
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

    <div id="voltarbut" style="margin-top: 100px;">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <button class="back-toggle" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></button>
    </div>

    <div class="overlay"></div>

    <div id="container">
        <div id="conteudo">
            <h1 style="font-size: 20pt; margin-bottom: 10px;">ADICIONAR UM PRODUTO:</h1>
            <form id="fotoperfilForm" class="<?php echo $themeClass; ?>" action="" method="POST" enctype="multipart/form-data">
                <center><div style="display: flex; align-items: center; justify-content: center;">
                    <label for="picture__input" class="input-produto-preview" id="labelPreview"></label>
                    <input type="file" name="picture__input" class="input-produto-preview__src" id="picture__input" required style="display: none;">
                    <div id="imageContainer" style="display: none; margin-left: 10px;">
                        <img id="image" style="max-width: 100%; display: block;">
                    </div>
                    <input type="hidden" name="croppedImage" id="croppedImage"></div>
                    <button type="button" class="submit-button bio" id="cropButton" style="display: none; margin-top: 10px;">Cortar</button>
                    <button type="button" id="showPreviewButton" style="display: none;">Mostrar Imagem Cortada</button>

                    <div id="dados-produtos" class='grid <?php echo $themeClass; ?>'><br>
                        <div class="contact__box contact__area">
                            <input type="text" maxlength="60" placeholder="max. 60 caracteres" name="nome" id="nome" class='contact__input' required/>
                            <label for="nome" class="contact__label">Nome do produto</label>
                        </div>

                        <div class="contact__box contact__area">
                            <textarea name="desc" class='contact__input' id="desc" maxlength="2000" placeholder="max. 2000 caracteres" required></textarea><br>
                            <label for="desc" class="contact__label">Descrição</label>
                        </div>

                        <div class="contact__box contact__area">
                            <input type="number" name="qtd" class='contact__input' id="qtd" required><br>
                            <label for="qtd" class="contact__label">Quantidade disponível</label>
                        </div>

                        <div class="contact__box contact__area">
                            <input type="text" name="preco" class='contact__input' id="preco" required><br>
                            <label for="preco" class="contact__label">Preço (R$)</label><br>
                        </div>

                        <style>
                            .contact__input {
                                padding: 20px;
                                width: 70%;
                                height: auto;
                            }
                            #desc {
                                height: 200px;
                                border-radius: 10px;
                                padding-left: 15px;
                                max-height: 300px;
                                margin-bottom: 20px;
                                resize: none;
                            }
                            .contact__label {
                                margin-left: calc(14% - 5px);
                            }
                            .contact__area {
                                height: auto;
                            }
                        </style>
                    </div>
                </center>
                <div style="display: flex; justify-content: center; flex-direction: row-reverse;" class='grid <?php echo $themeClass; ?>'><button id="submitButtonnew" style="margin-bottom: 30px;" type="submit" class="contact__send">Enviar</button>
            </form></div>
            <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    $fotoPerfil = $usuario['perfil_foto'];
                    if ($fotoPerfil) {
                        $base64Image = base64_encode($fotoPerfil);
                        echo "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const filePreview = document.querySelector('.input-preview');
                                    filePreview.style.backgroundImage = 'url(data:image/jpeg;base64,$base64Image)';
                                    filePreview.classList.add('has-image');
                                });
                            </script>";
                    }
                }
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let cropper;
                    const image = document.getElementById('image');
                    const inputImage = document.getElementById('picture__input');
                    const imageContainer = document.getElementById('imageContainer');
                    const cropButton = document.getElementById('cropButton');
                    const showPreviewButton = document.getElementById('showPreviewButton');
                    const labelPreview = document.getElementById('labelPreview');
                    const croppedImageInput = document.getElementById('croppedImage');
                    const form = document.getElementById('fotoperfilForm');
                    const submitButton = document.getElementById('submitButtonnew');
                    inputImage.addEventListener('change', function(event) {
                        const files = event.target.files;
                        if (files && files.length > 0) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                image.src = e.target.result;
                                imageContainer.style.display = 'block';
                                cropButton.style.display = 'inline';
                                showPreviewButton.style.display = 'none';
                                if (cropper) {
                                    cropper.destroy();
                                }
                                cropper = new Cropper(image, {
                                    aspectRatio: 1,
                                    viewMode: 1,
                                    autoCropArea: 1,
                                });
                            };
                            submitButton.style.display = 'none';
                            reader.readAsDataURL(files[0]);
                        }
                    });
                    cropButton.addEventListener('click', function() {
                        if (cropper) {
                            const canvas = cropper.getCroppedCanvas({
                                width: 800,
                                height: 800
                            });
                            canvas.toBlob(function(blob) {
                                const reader = new FileReader();
                                reader.onloadend = function() {
                                    const croppedImageDataURL = reader.result;
                                    croppedImageInput.value = croppedImageDataURL;
                                    labelPreview.style.backgroundImage = `url(${croppedImageDataURL})`;
                                    labelPreview.style.backgroundSize = 'cover';
                                    imageContainer.style.display = 'none';
                                    cropButton.style.display = 'none';
                                    showPreviewButton.style.display = 'none';
                                    submitButton.disabled = false;
                                    submitButton.style.display = 'block';
                                };
                                reader.readAsDataURL(blob);
                            }, 'image/jpeg');
                        }
                    });
                    showPreviewButton.addEventListener('click', function() {
                        form.submit();
                    });
                });
                const fileImageProduto = document.querySelector('.input-produto-preview__src');
                const filePreviewProduto = document.querySelector('.input-produto-preview');
                fileImageProduto.onchange = function () {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        filePreviewProduto.style.backgroundImage  = "url("+e.target.result+")";
                        filePreviewProduto.classList.add("has-image");
                    };
                    reader.readAsDataURL(this.files[0]);
                };

                document.addEventListener('DOMContentLoaded', function() {
                    const form = document.getElementById('fotoperfilForm');

                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        
                        const formData = new FormData(form);
                        
                        fetch('upload_produto.php', {
                            method: 'POST',
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sucesso!',
                                    text: data.message,
                                    timer: 1300,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.href = data.redirectUrl;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro!',
                                    text: data.message,
                                    confirmButtonText: 'Tentar novamente'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro!',
                                text: 'A imagem deve ser menor que 8MB.',
                                confirmButtonText: 'Tentar novamente'
                            });
                        });
                    });
                });
            </script>
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