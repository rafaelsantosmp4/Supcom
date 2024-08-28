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
    if($_SESSION['log'] != "ativo") {
        echo"<script>alert('Você precisa entrar na sua conta para continuar.'); window.location.href = '../login/index.php';</script>";
    }
?>

<nav id="configpcnav" class="configpcnav">        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div id="closenav"><i class="fa fa-times"></i></div>
    <ul>
        <li>CONFIGS HERE</li>
    </ul>
</nav>

<header>
    <a href="../home" id="button-logo-index"><img width="120px" id="default-logo" src="../medias/logo/Logo-white.png"></a>
    <nav id="mobile-nav">
        <ul>
            <li><a href="../home">Início</a></li>
            <li><a href="../forns/" class="active">Fornecedores</a></li>
            <li><a href="../sobre/">Sobre nós</a></li>
            <li><a href="../contact/">Fale conosco</a></li>
            <li class="config-menu">
                <div style="font-size: 40pt; padding: 10px 30px;"  id="config-button" onclick="toggleConfigMenu()">Configurações <i class="fa fa-caret-down"></i></div>
                <ul id="config-options" class="config-options">
                    <li style="margin-bottom: 5px; margin-top: 30px;">MODO ESCURO</li>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <li><button id="darkModeToggle" aria-label="Toggle Dark Mode" class="btn btn-light">
                        <i id="toggleIcon" class="bi bi-brightness-high"></i>
                    </button>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div style="justify-content: center; align-items: center; display: flex;">
        <button class="config-toggle" id="config_toggle" onclick="config_toggle()"><i class="fa fa-gear"></i></button>
        <div id='account-button' onclick='toggleAccountMenu()' style="position: relative;">
            <?php
                include('../conexao/conexao.php');
                $db = new BancodeDados();
                $db->conecta();
                $iduser = $_SESSION['id'];
                $query = "SELECT * FROM usuarios WHERE id_usuario = '$iduser'";
                $result = mysqli_query($db->con, $query);
                $usuario = mysqli_fetch_assoc($result);
                $nome = $usuario['nome'];
                echo "Bem-vindo, $nome";
                $db->fechar();
            ?>
            <i class='fa fa-caret-down'></i>
        </div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <div id='account-options'><a href='../logout/'>Sair da conta <i class="fa fa-sign-out" style="font-family: FontAwesome;"></i></a></div>
    </div>

    <button class="menu-toggle" id="menu_toggle" onclick="menu_toggle()">&#9776;</button>
</header>

<div class="overlay2" id="overlay2"></div>
<div class="overlay3" id="overlay3"></div>

<body>
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
            <div id="rightfilters">
                <h1>Todos os produtos</h1>
                <div>
                    <select id="ordenar">
                        <option selected disabled>Ordenar por:&nbsp&nbsp&nbsp&nbsp</option>
                        <option value="dest">Destaques</option>
                        <option value="data">Data</option>
                        <option value="preco">Preço</option>
                    </select>
                    <select id="filter">
                        <option selected disabled>Filtro</option>
                        <option value="loj">Data</option>
                        <option value="forn">Preço</option>
                    </select>
                </div>
            </div>
            

            <div class="categoria">
                <h2>Categoria 1</h2>
                <div class="produtos">
                    <div class="produto">
                        <img src="../medias/paes.webp" alt="Produto 1">
                        <h3>Nome do produto</h3>
                        <p>Breve descrição do produto</p>
                        <div class="avaliacao">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrela_vazia.png" alt="Estrela vazia">
                            <span>(4.1 / 5)</span>
                        </div>
                    </div>
                    
                    <div class="produto">
                        <img src="../medias/paes.webp" alt="Produto 1">
                        <h3>Nome do produto</h3>
                        <p>Breve descrição do produto</p>
                        <div class="avaliacao">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrela_vazia.png" alt="Estrela vazia">
                            <span>(4.1 / 5)</span>
                        </div>
                    </div>

                    <div class="produto">
                        <img src="../medias/paes.webp" alt="Produto 1">
                        <h3>Nome do produto</h3>
                        <p>Breve descrição do produto</p>
                        <div class="avaliacao">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrela_vazia.png" alt="Estrela vazia">
                            <span>(4.1 / 5)</span>
                        </div>
                    </div>

                    <div class="produto">
                        <img src="../medias/paes.webp" alt="Produto 1">
                        <h3>Nome do produto</h3>
                        <p>Breve descrição do produto</p>
                        <div class="avaliacao">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrela_vazia.png" alt="Estrela vazia">
                            <span>(4.1 / 5)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="categoria">
                <h2>Categoria 2</h2>
                <div class="produtos">
                    <div class="produto">
                        <img src="../medias/frutas.jpg" alt="Produto 2">
                        <h3>Nome do produto</h3>
                        <p>Breve descrição do produto</p>
                        <div class="avaliacao">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrela_vazia.png" alt="Estrela vazia">
                            <span>(4.1 / 5)</span>
                        </div>
                    </div>

                    <div class="produto">
                        <img src="../medias/frutas.jpg" alt="Produto 2">
                        <h3>Nome do produto</h3>
                        <p>Breve descrição do produto</p>
                        <div class="avaliacao">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrela_vazia.png" alt="Estrela vazia">
                            <span>(4.1 / 5)</span>
                        </div>
                    </div>

                    <div class="produto">
                        <img src="../medias/frutas.jpg" alt="Produto 2">
                        <h3>Nome do produto</h3>
                        <p>Breve descrição do produto</p>
                        <div class="avaliacao">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrela_vazia.png" alt="Estrela vazia">
                            <span>(4.1 / 5)</span>
                        </div>
                    </div>
              
                    <div class="produto">
                        <img src="../medias/frutas.jpg" alt="Produto 2">
                        <h3>Nome do produto</h3>
                        <p>Breve descrição do produto</p>
                        <div class="avaliacao">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrelacheia.png" alt="Estrela cheia">
                            <img src="../medias/estrela_vazia.png" alt="Estrela vazia">
                            <span>(4.1 / 5)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<?php include '../universal/footer.php'; ?>

<script src="../js/script.js"></script>
</html>