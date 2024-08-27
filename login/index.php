<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo(a)</title>
    <link rel="shortcut icon" href="../medias/logo/Supcom-white.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/basics.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mobile.css">
</head>
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

    <div id="voltarbut">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <button class="back-toggle" onclick="voltar()"><i class="fa fa-chevron-left"></i></button>
    </div>

    <div class="imgright logimg"></div>

    <div id="left">
        <form action="login.php" method="post">
            <center><img id="default-logo"></center>
            <h1>Entre na sua conta</h1>
            <p>Não tem uma conta? <a href="../signup/index.php"><i>cadastrar</i></a></p>

            <div id="datas">
                <label for="email" id="emaillabel">E-mail</label>
                <input type="email" name="email" id="email" required/>
                
                <label for="password" id="passwordlabel">Senha</label>
                <input type="password" name="password" id="password" required/>
            </div>

            <a href="../iforgot/index.php" class="forgot-password">Esqueceu a senha?</a>
            
            <button type="submit" class="submit-button">Entrar</button>
        </form>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>
