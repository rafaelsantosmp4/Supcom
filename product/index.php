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
            $nome = $usuario['nome'];

            $idenviado = $_GET['id'];
            $queryprods = "SELECT * FROM produto WHERE id_produto = $idenviado";
            $resultprods = mysqli_query($db->con, $queryprods);

            
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
        $produto = mysqli_fetch_assoc($resultprods);
        $nome_produto = $produto['nome_produto'];
        $descricao_produto = $produto['descricao_produto'];
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
                <?php
                    if($id_forn != $iduser) {
                        $editarprod = '';
                    } else {
                        $editarprod = '<a href="../upload/update.php?id='. $id_produto.'" id="nomeempresalink" style="margin-top: 10px; text-decoration: underline; cursor: pointer; font-size: 20pt;">Editar produto <i class="fa fa-pencil" style="font-family: FontAwesome;"></i></a>';
                    }
                ?>
                <div class="rightdatas">
                    <br><center><?php echo $editarprod ?>
                    <h1 style="margin-bottom: 10px; margin-top: 5px;"><?php echo $nome_produto; ?></h1>
                    <div class="avaliacao">
                        <img style="width: 25px; height: 25px;" src="../medias/estrelacheia.png" alt="Estrela cheia">
                        <img style="width: 25px; height: 25px;" src="../medias/estrelacheia.png" alt="Estrela cheia">
                        <img style="width: 25px; height: 25px;" src="../medias/estrelacheia.png" alt="Estrela cheia">
                        <img style="width: 25px; height: 25px;" src="../medias/estrelacheia.png" alt="Estrela cheia">
                        <img style="width: 25px; height: 25px;" src="../medias/estrela_vazia.png" alt="Estrela vazia">
                        <span>(4.1 / 5)</span>
                    </div><br>
                    <h2 style="margin-top: 0px;"><?php echo $preco_produto; ?></h2>
                    <h3 style="margin-bottom: 13px;">Quantidade: <?php echo $qtd_produto; ?></h3>
                    <?php
                        
                        echo'<a href="../chat/index.php?myid='.$iduser.'&idforn='.$id_forn.'"><button style="width: 50%;" class="submit-button" id="entraremcontato">Entrar em contato</button></a>';
                    ?>
                    
                    <h3>Descrição:</h3>
                    <p class='descricaoprod'><?php echo $descricao_produto; ?></p>
                    <h3 style="margin-bottom: 3px;">Empresa:</h3>
                    <?php
                        if($id_forn != $iduser) {
                            $link = '../profile/company.php?id='.$id_forn.'&nome='.$nome_forn_encoded;
                        } else {
                            $link = '../profile/index.php';
                        }
                    ?>
                    <a href="<?php echo $link?>" id='nomeempresalink' title="Acessar perfil"><p id='nomeempresa'><b><?php echo $nome_forn; ?></b></p></a>
                </div></center>
                <?php
                    if($id_forn == $iduser) {
                        echo "<script>document.getElementById('entraremcontato').style.display = 'none'</script>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>

<?php include '../universal/footer.php'; ?>

<script src="../js/script.js"></script>
</html>