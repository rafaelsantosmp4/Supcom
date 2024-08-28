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
    <div class="imgright signupimg"></div>

    <div id="left">
        <form action="signup.php" method="post">
            <center><img id="default-logo" src="../medias/logo/Logo-white.png"></center>
            <h1>Cadastre sua empresa na SUPCOM!</h1>
            <p>Já tem uma conta? <a href="../login/index.php"><i>entrar</i></a></p>

            <div id="datas">
                <label for="nome">Nome da empresa</label>
                <input type="text" name="nome" id="nome" required/>

                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="xxxxx@email.com" required/>

                <label for="tipoconta">O que pretende na SUPCOM?</label>
                <select name="tipoconta" id="tipoconta" style="margin-bottom: 0px;">
                    <option value="loj">Encontrar fornecedores para minha empresa</option>
                    <option value="forn">Vender mercadorias da minha empresa fornecedora</option>
                </select>
                <div><a href="#"><i>saiba mais</i></a></div><br>
                
                <label for="cnpj">CNPJ</label>
                <input type="text" name="cnpj" id="cnpj" placeholder="00.000.000/0000-00" maxlength="18" required/>
                
                <label for="tel">Telefone</label>
                <input type="text" name="tel" id="tel" placeholder="(99)9999-9999" maxlength="14" required/>
                
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" required/>
            </div>
            
            <button type="submit" class="submit-button">Cadastrar</button>
        </form>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>