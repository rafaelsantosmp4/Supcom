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

    include('../conexao/conexao.php');
    $db = new BancodeDados();
    $db->conecta();
    $iduser = $_SESSION['id'];
    $query = "SELECT * FROM usuarios WHERE id_usuario = '$iduser'";
    $result = mysqli_query($db->con, $query);
    $usuario = mysqli_fetch_assoc($result);
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
                $nome = $usuario['nome'];
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
            <li style="font-size: 20pt; margin-bottom: 10px;">ATUALIZE SUA BIO:</li> 
            <form id="bioForm" method="POST" action="save_bio.php">
                <textarea name="bio" id="bio" rows="4" cols="50" maxlength="200" placeholder="max. 200 caracteres"></textarea>
                <li><input type="submit" class="submit-button bio" value="Salvar"></li>
            </form>
        </ul>
    </nav>

    <nav id="mudarfoto" class="mudarfoto <?php echo $themeClass; ?> navconfigs">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

        <div id="closepfp">
            <i class="fa fa-times <?php echo $themeClass; ?>"></i>
        </div>
        <ul>
            <li style="font-size: 20pt; margin-bottom: 10px;">ATUALIZE SUA FOTO:</li>
            <p>Tamanho máximo: <i>15MB</i></p><br>
            <form id="fotoperfilForm" class="<?php echo $themeClass; ?>" action="upload_foto.php" method="POST" enctype="multipart/form-data">
                <center><div style="display: flex; align-items: center; justify-content: center;">
                    <label for="picture__input" class="input-preview" id="labelPreview"></label>
                    <input type="file" name="picture__input" class="input-preview__src" id="picture__input" required style="display: none;">
                    <div id="imageContainer" style="display: none; margin-left: 10px;">
                        <img id="image" style="max-width: 100%; display: block;">
                    </div>
                    <input type="hidden" name="croppedImage" id="croppedImage"></div>
                    <button type="button" class="submit-button bio" id="cropButton" style="display: none; margin-top: 10px;">Cortar</button>
                    <button type="button" id="showPreviewButton" style="display: none;">Mostrar Imagem Cortada</button><br>
                </center>
                <div style="display: flex; justify-content: center; flex-direction: row-reverse;"><input type="submit" class="submit-button bio" value="Enviar" style="margin-left: 10px;" id="submitButton" disabled>
            </form>
            <form id="excluirFotoForm" action="excluir_foto.php" method="POST">
                <input type="submit" class="submit-button bio excluirbut" value="Excluir">
                <a href="exibir_foto.php" title="Baixar imagem" download="perfil_foto.jpg">
                    <input type="button" class="submit-button bio" value="Baixar">
                </a>
            </form></div>
        </ul>
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
                const submitButton = document.getElementById('submitButton');
                const excluirFotoForm = document.getElementById('excluirFotoForm');
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
                        excluirFotoForm.style.display = 'none';
                        submitButton.style.display = 'none';
                        reader.readAsDataURL(files[0]);
                    }
                });
                cropButton.addEventListener('click', function() {
                    if (cropper) {
                        const canvas = cropper.getCroppedCanvas({
                            width: 300,
                            height: 300
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
                                excluirFotoForm.style.display = 'block';
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
        </script>
    </nav>

    <nav id="addbanner" class="mudarfoto <?php echo $themeClass; ?> navconfigs">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <div id="closebanner">
            <i class="fa fa-times <?php echo $themeClass; ?>"></i>
        </div>
        <ul>
            <li style="font-size: 20pt; margin-bottom: 10px;">ATUALIZE SEU BANNER:</li>
            <p>Tamanho máximo: <i>15MB</i></p><br>
            <form id="fotobannerForm" class="<?php echo $themeClass; ?>" action="upload_banner.php" method="POST" enctype="multipart/form-data">
                <center>
                    <label for="banner__input" class="input-preview-banner"></label>
                    <input type="file" name="banner__input" class="input-banner-preview__src" id="banner__input" required>
                </center><br>
                <div style="display: flex; justify-content: center; flex-direction: row-reverse;"><input type="submit" class="submit-button bio" value="Enviar" style="margin-left: 10px;">
            </form>
            <form id="excluirBannerForm" action="excluir_banner.php" method="POST">
                <input type="submit" class="submit-button bio excluirbut" value="Excluir">
                <a href="exibir_banner.php" title="Baixar imagem" download="perfil_banner.jpg"><input type="button" class="submit-button bio" value="Baixar"></a></div>
            </form>
        </ul>
        <?php
            if ($result && mysqli_num_rows($result) > 0) {
                $bannerPerfil = $usuario['banner_perfil'];
                if ($bannerPerfil) {
                    $base64ImageBanner = base64_encode($bannerPerfil);
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const filePreviewBanner = document.querySelector('.input-preview-banner');
                                filePreviewBanner.style.backgroundImage = 'url(data:image/jpeg;base64,$base64ImageBanner)';
                                filePreviewBanner.classList.add('has-image');
                            });
                        </script>";
                }
            }
        ?>
    </nav>


    <?php
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

        if ($result && mysqli_num_rows($result) > 0) {
            if($usuario['bio'] != null) {
                $_SESSION['bio'] = "<p onmouseenter='updatebio()' onmouseleave='resetbio()' id='attbio'>" . $usuario['bio'] . "</p>";
                echo"<script>textarea = document.getElementById('bio'); textarea.innerHTML = '" . $usuario['bio'] . "'; </script>";
            } else {
                $_SESSION['bio'] = "<p> <a style='text-decoration: underline; cursor: pointer;' onclick='addbio()'>Adicione uma bio para seu perfil! <i class='fa fa-pencil' style='font-family: FontAwesome;'></i></a></p>";
            }
        }
        $bio = $_SESSION['bio'];
    ?>
    <div id="profile">
        <?php
            if($usuario['banner_perfil'] != null) {
                echo "<div class='banner-sobreposto' style='background-image: url(\"exibir_banner.php\");'></div>";
            } else {
                echo"<div class='banner-sobreposto'></div>";
            }
        ?>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <div id="edit-icon-banner" style="display: none; position: absolute; top: 20px; right: 30px; cursor: pointer; z-index: 9;">
            <i class="fa fa-pencil" style="font-size: 30px; font-family: FontAwesome; color: #E8F1F2;" title="Mudar banner"></i>
        </div>

        <div id="pfp">
            <div id="profile-photo-container" style="position: relative; display: inline-block;">
                <img id="perfilfoto" src="exibir_foto.php" alt="Foto de Perfil" style="width: 150px; height: 150px; border-radius: 50%;">

                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
                <div id="edit-icon" style="display: none; position: absolute; top: 0px; right: 40px; cursor: pointer;">
                    <i class="fa fa-pencil" style="font-size: 50px; font-family: FontAwesome; color: #E8F1F2;" title="Mudar foto"></i>
                </div>
            </div>

            <div id="nomebio">
                <h1><?php echo "$nome"; ?></h1>
                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
                <?php echo $bio; ?>
            </div>
        </div>
    </div>

    <div id="container">
        <div id="conteudo">
            <h1>Informações da empresa:</h1>
            <ul align='center' style="list-style: none;">
                <li><b>Email: </b><?php echo $email ?></li><br>
                <li><b>CNPJ: </b><?php echo $cnpj ?></li><br>
                <li><b>Telefone: </b><?php echo $telefone ?></li><br>
                <li><b>Tipo da conta: </b><?php echo $tipo ?></li><br>
                <li><b>Data de cadastro: </b><?php echo $formatted_date ?></li><br>
                <li><b>Hora de cadastro: </b><?php echo $formatted_time ?></li>
            </ul>
        </div>
    </div>
</body>

<script src="../js/profile.js"></script>

<?php include '../universal/footer.php';?>

<script src="../js/script.js"></script>
</html>