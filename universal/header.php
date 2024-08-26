<header>
    <a href="../" id="button-logo-index"><img width="120px" id="default-logo"></a>
    <nav id="mobile-nav">
        <ul>
            <li><a href="../">Início</a></li>
            <li><a href="#" class="active">Fornecedores</a></li>
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
    <div id="direita" style="justify-content: center; align-items: center; display: flex;">
        <a href="../login/" class="login-button">Entrar</a>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <button class="config-toggle" id="config_toggle" onclick="config_toggle()"><i class="fa fa-gear"></i></button>
    </div>
    <button class="menu-toggle" id="menu_toggle" onclick="menu_toggle()">&#9776;</button>
</header>