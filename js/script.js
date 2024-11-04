window.addEventListener('load', function() {
  const savedFontSize = getCookie('fontSize');
  if (savedFontSize) {
    ajustarFonte(savedFontSize);
    document.getElementById('fontSlider').value = savedFontSize;
    updateFontSizeDisplay(savedFontSize);
  }

  document.querySelector('#container').style.opacity = 100;
  document.querySelector('footer').style.opacity = 100;
  document.querySelector('.loader-container').style.display = 'none';
  document.body.style.pointerEvents = 'inherit';
  document.body.style.overflow = 'inherit';

  document.getElementById('fontSlider').addEventListener('input', function(event) {
    const newSize = event.target.value;
    ajustarFonte(newSize);
    updateFontSizeDisplay(newSize);
  });

  document.getElementById('fontSlider').addEventListener('change', function() {
    const newSize = this.value;
    setCookie('fontSize', newSize, 30);
  });
});

function ajustarFonte(size) {
  document.body.style.fontSize = size + 'px';
  document.querySelectorAll('.font-adjustable').forEach(function(element) {
    element.style.fontSize = size + 'px';
  });
}

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}

function setCookie(name, value, days) {
  const expires = new Date(Date.now() + days * 864e5).toUTCString();
  document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires}; path=/`;
}

function updateFontSizeDisplay(fontSize) {
  document.getElementById('fontSizeDisplay').innerText = `Tamanho da fonte: ${fontSize}px`;
}

const imglogo = document.querySelector("#default-logo");
const imgiconedark = document.querySelector("#indicador");
const body = document.body;
const trilho = document.getElementById('trilho');
const darkModeToggle = document.getElementById('darkModeToggle');

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
    account.classList.remove('open');
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