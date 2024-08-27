document.addEventListener('DOMContentLoaded', () => {
  const imglogo = document.querySelector("#default-logo");
  const imgiconedark = document.querySelector("#indicador");
  const body = document.body;
  const trilho = document.getElementById('trilho');
  const darkModeToggle = document.getElementById('darkModeToggle');

  const updateTheme = (isDarkMode) => {
    body.classList.toggle('dark-mode', isDarkMode);
    if (imglogo) {
      imglogo.setAttribute('src', isDarkMode ? '../medias/logo/Black-logo.png' : '../medias/logo/Logo-white.png');
    }
    if (imgiconedark) {
      imgiconedark.setAttribute('src', isDarkMode ? '../medias/moon.png' : '../medias/sun.png');
    }
    if (trilho) {
      trilho.classList.toggle('darktrilho', isDarkMode);
    }
  };

  const updateButtonIcon = (isDarkMode) => {
    const icon = document.getElementById('toggleIcon');
    if (icon) {
      icon.className = isDarkMode ? 'fa fa-moon-o' : 'fa fa-sun-o';
    }
  };

  const handleDarkModeToggle = () => {
    const isDarkMode = !body.classList.contains('dark-mode');
    updateTheme(isDarkMode);
    updateButtonIcon(isDarkMode);

    setTimeout(() => {
      localStorage.setItem('darkMode', isDarkMode ? 'true' : 'false');
    }, 400);
  };

  const isDarkMode = localStorage.getItem('darkMode') === 'true';
  updateTheme(isDarkMode);
  updateButtonIcon(isDarkMode);

  if (trilho) {
    trilho.addEventListener('click', handleDarkModeToggle);
  }
  if (darkModeToggle) {
    darkModeToggle.addEventListener('click', handleDarkModeToggle);
  }
});




function toggleConfigMenu() {
  const options = document.querySelector('.config-options');
  options.classList.toggle('open');
}

const account = document.querySelector('#account-options');
const overlay3 = document.querySelector('.overlay3');

function toggleAccountMenu() {
  account.classList.toggle('open');
  overlay3.classList.toggle('show');
}

overlay3.addEventListener('click', () => {
    account.classList.remove('open');  // Corrigido de 'show' para 'open'
    overlay3.classList.remove('show');
});


function menu_toggle() {
    const mobileNav = document.getElementById('mobile-nav');
    if (mobileNav) {
        mobileNav.classList.toggle('show');
        overlay2.classList.toggle('show');
        document.getElementById('menu_toggle').classList.toggle('Befixed');
    }
}

function config_toggle() {
    const pcnav = document.getElementById('configpcnav');
    if (pcnav) {
      pcnav.classList.toggle('show');
        overlay2.classList.toggle('show');
        document.getElementById('config_toggle').classList.toggle('Befixed');
    }
}

const overlay2 = document.querySelector('.overlay2');
overlay2.addEventListener('click', () => {
    const mobileNav = document.getElementById('mobile-nav');
    const pcnav = document.getElementById('configpcnav');
    if (mobileNav) {
        mobileNav.classList.remove('show');
        overlay2.classList.remove('show');
        document.getElementById('menu_toggle').classList.remove('Befixed');
    }
    if (pcnav) {
      pcnav.classList.remove('show');
      overlay2.classList.remove('show');
    }
});

closebutton = document.getElementById("closenav");
closebutton.addEventListener('click', () => {
  const mobileNav = document.getElementById('mobile-nav');
  const pcnav = document.getElementById('configpcnav');
  if (mobileNav) {
      mobileNav.classList.remove('show');
      overlay2.classList.remove('show');
      document.getElementById('menu_toggle').classList.remove('Befixed');
  }
  if (pcnav) {
    pcnav.classList.remove('show');
    overlay2.classList.remove('show');
  }
});

function voltar() {
  window.history.go(-1);
}