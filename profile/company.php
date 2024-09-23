<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
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
            $nomeuser = $_SESSION['nome'];

            $idenviado = $_GET['id'];
            $queryprods = "SELECT * FROM usuarios WHERE id_usuario = $idenviado";
            $resultprods = mysqli_query($db->con, $queryprods);
            $usuarioprods = mysqli_fetch_assoc($resultprods);
            $nome = $usuarioprods['nome'];
            $email = $usuarioprods['email'];
            $cnpj = $usuarioprods['cnpj'];
            $telefone = $usuarioprods['telefone'];
            $data = $usuarioprods['data_cadastro'];
            $datacerta = new DateTime($data);
            $formatted_date = $datacerta->format('d/m/Y');
            $bio = $usuarioprods['bio'];
            $foto_perfil = $usuarioprods['perfil_foto'];

            $resultprods = mysqli_query($db->con, $queryprods);
            if ($usuario["tipo_usuario"] == "fornecedor") {
                echo '<a href="../upload/" id="linkupload" class="'. $themeClass .'"><button class="uploadbutton '. $themeClass .' id="uploadbutton" onclick="../upload/"><i class="fa fa-upload"></i></a>';
            }
        ?>
        <button class="config-toggle <?php echo $themeClass; ?>" id="config_toggle" onclick="config_toggle()"><i class="fa fa-gear"></i></button>
        <div id='account-button' onclick='toggleAccountMenu()' style="position: relative;">
            <?php
                echo "Bem-vindo, $nomeuser";
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

<div class="loader-container">
  <div class="loader <?php echo $themeClass; ?>"></div>
  <span class="loader-text <?php echo $themeClass; ?>">Carregando...</span>
</div>
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
    <div id="profile">
        <?php
            $banner = $usuarioprods['banner_perfil'];
            if ($banner) {
                $banner_base64 = base64_encode($banner);
                $banner_mime = 'image/png';
                $banner_url = "data:$banner_mime;base64,$banner_base64";
            } else {
                $banner_url = '';
            }

            $foto = $usuarioprods['perfil_foto'];
            if ($foto) {
                $foto_base64 = base64_encode($foto);
                $foto_mime = 'image/png';
                $foto_url = "data:$foto_mime;base64,$foto_base64";
            } else {
                $foto_url = '../medias/iconpfp.jpg';
            }
        ?>
        <div class='banner-sobreposto' style='background-image: url("<?php echo $banner_url; ?>");'></div>
        <div id="pfp">
            <div id="profile-photo-container" style="position: relative; display: inline-block;">
                <img id="perfilfoto" src="<?php echo $foto_url; ?>" alt="Foto de Perfil" style="width: 150px; height: 150px; border-radius: 50%;">
            </div>

            <div id="nomebio">
                <h1><?php echo "$nome"; ?></h1>
                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
                <p id='attbio'><?php echo $bio; ?> </p>
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
                <li><b>Data de cadastro: </b><?php echo $formatted_date ?></li>
            </ul>

            <h1>Produtos da empresa:</h1>
            <?php
                $queryprods = "SELECT * FROM produto WHERE id_forn = $idenviado";
                $resultprods = mysqli_query($db->con, $queryprods);
                $prod_count = 0;
                $prod_per_category = 4;
                $first_category = true;

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
                            <h3><?php echo $nome_produto; ?></h3>
                            <p class="descricao-produto"><?php echo $descricao_produto; ?></p>
                            <div class="avaliacao">
                                <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                                <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                                <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                                <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                                <img src="../medias/estrela_vazia.png" alt="Estrela vazia">
                                <span>(4.1 / 5)</span>
                            </div>
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
            ?>
        </div>
    </div>
</body>

<?php include '../universal/footer.php';?>

<script src="../js/script.js"></script>
</html>