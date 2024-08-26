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



<nav id="configpcnav" class="configpcnav">        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div id="closenav"><i class="fa fa-times"></i></div>
    <ul>
        <li>MODO ESCURO</li>
        <li style="display: flex; justify-content: center;"><div id="trilho"><img src="../medias/sun.png" id="indicador"></div></div></li>
    </ul>
</nav>

<?php include '../universal/header.php'; ?>

<div class="overlay2" id="overlay2"></div>

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