<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Política de privacidade</title>
    <link rel="shortcut icon" href="../medias/logo/Supcom-white.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/basics.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mobile.css">
</head>
<?php
    session_start();
    $themeClass = isset($_COOKIE['dark_mode']) && $_COOKIE['dark_mode'] === '1' ? 'dark-mode' : 'light-mode';

    $logoSrc = $themeClass === 'dark-mode' ? '../medias/logo/Black-logo.png' : '../medias/logo/Logo-white.png';
?>
<div class="loader-container">
  <div class="loader <?php echo $themeClass; ?>"></div>
  <span class="loader-text">Carregando...</span>
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

    <div id="voltarbut">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <a onclick="window.close()"><button class="back-toggle"><i class="fa fa-chevron-left"></i></button></a>
    </div>

    <div id="container">
        <div id="conteudo" style="width: 800px; padding-bottom: 40px;">
            <h1>Política de Privacidade da Supcom</h1>
            <p>Última atualização: 18/11/2024</p>
            <p><a href="termos-uso.php">Termos de uso</a></p>

            <section>
                <h2>1. Sobre a Supcom</h2>
                <p><strong>1.1. Projeto Educacional:</strong> A Supcom é um projeto de <strong>Trabalho de Conclusão de Curso (TCC)</strong> desenvolvido pelos alunos da <strong>ETEC de Poá</strong>. Seu objetivo é simular uma plataforma B2B (Business-to-Business) para fins acadêmicos, com foco na conexão e comunicação entre lojistas e fornecedores.</p>
                <p><strong>1.2. Finalidade Limitada:</strong> Os dados coletados e processados na Supcom são utilizados exclusivamente para o funcionamento e análise deste projeto acadêmico, sem finalidade comercial.</p>
                <p><strong>1.3. Isenção de Responsabilidade Comercial:</strong> Como projeto acadêmico, a Supcom não realiza intermediações comerciais e não compartilha dados com terceiros para fins de marketing ou monetização.</p>
            </section>

            <section>
                <h2>2. Dados Coletados</h2>
                <p><strong>2.1.</strong> Coletamos apenas os dados necessários para o funcionamento da plataforma, como:</p>
                <ul>
                    <li>Informações fornecidas durante o cadastro (nome, e-mail, etc.).</li>
                    <li>Dados relacionados às interações entre lojistas e fornecedores na plataforma.</li>
                </ul>
                <p><strong>2.2.</strong> Dados sensíveis ou não relacionados ao escopo acadêmico não são coletados.</p>
            </section>

            <section>
                <h2>3. Uso dos Dados</h2>
                <p><strong>3.1.</strong> Os dados coletados são utilizados apenas para:</p>
                <ul>
                    <li>Simular funcionalidades de uma plataforma B2B para fins acadêmicos.</li>
                    <li>Gerar relatórios e análises dentro do escopo do TCC.</li>
                </ul>
                <p><strong>3.2.</strong> Não utilizamos os dados para fins comerciais ou compartilhamos com terceiros fora do projeto, exceto quando exigido por lei.</p>
            </section>

            <section>
                <h2>4. Armazenamento e Segurança</h2>
                <p><strong>4.1.</strong> Os dados coletados são armazenados localmente no banco de dados phpmyadmin, acessíveis apenas pelos desenvolvedores do projeto.</p>
                <p><strong>4.2.</strong> Embora sejam aplicadas medidas de segurança para proteger os dados, a Supcom não pode garantir total segurança, considerando sua natureza acadêmica.</p>
            </section>

            <section>
                <h2>5. Direitos dos Usuários</h2>
                <p><strong>5.1.</strong> Os usuários têm o direito de:</p>
                <ul>
                    <li>Solicitar a exclusão de seus dados a qualquer momento.</li>
                    <li>Acessar e corrigir informações fornecidas no cadastro.</li>
                </ul>
                <p><strong>5.2.</strong> Para exercer esses direitos, entre em contato pelo e-mail disponibilizado abaixo ou pelo próprio site.</p>
            </section>

            <section>
                <h2>6. Compartilhamento de Dados</h2>
                <p><strong>6.1.</strong> Não compartilhamos dados com terceiros fora do escopo do projeto acadêmico.</p>
                <p><strong>6.2.</strong> Dados podem ser divulgados apenas em casos exigidos por lei ou para garantir a segurança do projeto.</p>
            </section>

            <section>
                <h2>7. Alterações na Política de Privacidade</h2>
                <p>A Supcom reserva-se o direito de modificar esta Política de Privacidade a qualquer momento. Alterações significativas serão comunicadas aos usuários.</p>
            </section>

            <section>
                <h2>8. Contato</h2>
                <p>Em caso de dúvidas, solicitações ou problemas relacionados à privacidade, entre em <a href="../contact.php">contato conosco</a>.</p>
            </section>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            document.querySelector('.loader-container').style.display = 'none';
            document.body.style.pointerEvents = 'inherit';
            document.body.style.overflow = 'inherit';
            document.querySelector('#container').style.opacity = '100';
        });
    </script>
    <script src="../js/script.js"></script>
</body>
</html>