<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Termos de uso</title>
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
        <a href="../signup/"><button class="back-toggle"><i class="fa fa-chevron-left"></i></button></a>
    </div>

    <div id="container">
        <div id="conteudo" style="width: 800px;">
            <h1>Termos de Uso da Supcom</h1>
            <p>Última atualização: 18/11/2024</p>

            <section>
                <h2>1. Sobre a Supcom</h2>
                <p><strong>1.1. Projeto Educacional:</strong> A Supcom é um projeto de <strong>Trabalho de Conclusão de Curso (TCC)</strong> desenvolvido pelos alunos da <strong>ETEC de Poá</strong>. Seu objetivo é simular uma plataforma B2B (Business-to-Business) para fins acadêmicos, com foco na conexão e comunicação entre lojistas e fornecedores.</p>
                <p><strong>1.2. Finalidade Limitada:</strong> A Supcom não é uma empresa formal e não oferece garantias comerciais, suporte contínuo ou serviços profissionais. Qualquer uso da plataforma deve ser entendido dentro deste contexto educacional.</p>
                <p><strong>1.3. Isenção de Responsabilidade Comercial:</strong> Não realizamos intermediação de vendas nem garantimos a veracidade, qualidade ou cumprimento das negociações realizadas entre os usuários.</p>
            </section>

            <section>
                <h2>2. Aceitação dos Termos</h2>
                <p>Ao utilizar a plataforma, você declara que leu, entendeu e concorda com estes Termos de Uso e com nossa <a href="privacidade.php">Política de Privacidade</a>. Caso discorde de qualquer parte, interrompa o uso imediatamente.</p>
            </section>

            <section>
                <h2>3. Cadastro e Responsabilidade do Usuário</h2>
                <p><strong>3.1.</strong> Para acessar determinadas funcionalidades, é necessário criar uma conta.</p>
                <p><strong>3.2.</strong> Você é responsável por fornecer informações verdadeiras, completas e atualizadas.</p>
                <p><strong>3.3.</strong> É sua responsabilidade manter a confidencialidade de sua conta e senha, bem como notificar imediatamente a Supcom em caso de uso não autorizado.</p>
            </section>

            <section>
                <h2>4. Uso Permitido</h2>
                <p><strong>4.1.</strong> A plataforma deve ser usada apenas para fins educacionais e simulação acadêmica.</p>
                <p><strong>4.2. É estritamente proibido:</strong></p>
                <ul>
                    <li>Publicar ou compartilhar conteúdos ofensivos ou ilegais.</li>
                    <li>Realizar práticas fraudulentas ou que possam prejudicar outros usuários.</li>
                    <li>Usar sistemas automatizados (como bots) para acessar o site.</li>
                </ul>
            </section>

            <section>
                <h2>5. Limitações de Responsabilidade</h2>
                <p><strong>5.1.</strong> A Supcom não se responsabiliza por:</p>
                <ul>
                    <li>Negociações realizadas entre lojistas e fornecedores.</li>
                    <li>Qualidade, precisão ou legalidade dos produtos ou serviços divulgados na plataforma.</li>
                    <li>Problemas técnicos, interrupções ou erros no funcionamento da plataforma.</li>
                </ul>
                <p><strong>5.2.</strong> Como projeto acadêmico, as funcionalidades podem ser limitadas ou interrompidas a qualquer momento.</p>
            </section>

            <section>
                <h2>6. Propriedade Intelectual</h2>
                <p><strong>6.1.</strong> Todo o conteúdo da plataforma, incluindo textos, imagens, design e código, é de propriedade exclusiva do grupo de alunos responsáveis ou de seus licenciantes.</p>
                <p><strong>6.2.</strong> É proibida a reprodução, distribuição ou modificação de qualquer conteúdo sem autorização prévia.</p>
            </section>

            <section>
                <h2>7. Privacidade e Dados</h2>
                <p><strong>7.1.</strong> Os dados coletados pela Supcom são utilizados apenas para o funcionamento e análise do projeto acadêmico.</p>
                <p><strong>7.2.</strong> Não compartilhamos informações com terceiros fora do escopo do projeto, exceto quando exigido por lei.</p>
                <p><strong>7.3.</strong> Para mais informações, consulte nossa <a href="privacidade.php">Política de Privacidade</a>.</p>
            </section>

            <section>
                <h2>8. Alterações nos Termos de Uso</h2>
                <p>A Supcom reserva-se o direito de modificar estes Termos a qualquer momento. Os usuários serão informados sobre mudanças significativas, sendo recomendada a consulta periódica.</p>
            </section>

            <section>
                <h2>9. Rescisão e Suspensão</h2>
                <p><strong>9.1.</strong> Podemos suspender ou encerrar sua conta caso você viole os Termos de Uso.</p>
                <p><strong>9.2.</strong> Como projeto acadêmico, a plataforma pode ser descontinuada ou ajustada a qualquer momento, sem aviso prévio.</p>
            </section>

            <section>
                <h2>10. Legislação e Foro</h2>
                <p>Estes Termos de Uso são regidos pelas leis brasileiras. Em caso de disputas, fica eleito o foro da cidade de <strong>Poá/SP</strong>, salvo disposição legal em contrário.</p>
            </section>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            document.querySelector('.loader-container').style.display = 'none';
            document.body.style.pointerEvents = 'inherit';
            document.body.style.overflow = 'inherit';
        });
    </script>
    <script src="../js/script.js"></script>
</body>
</html>