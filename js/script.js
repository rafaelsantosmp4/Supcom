window.addEventListener('load', function() {
  document.querySelector('.loader').style.display = 'none';
  document.querySelector('#container').style.opacity = 100;
  document.querySelector('footer').style.opacity = 100;
  document.body.style.overflow = 'auto';
});

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