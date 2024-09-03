document.getElementById('bio').addEventListener('keypress', function(e) {
    var key = e.which || e.keyCode;
    if (key === 13) {
        e.preventDefault();
        document.getElementById("bioForm").submit();
    }
});
function addbio() {
    const addbio = document.getElementById('addbio');
    const overlaybio = document.querySelector('.overlaybio');
    if (addbio) {
        addbio.classList.toggle('show');
        overlaybio.classList.toggle('show');
    }
}
overlaybio.addEventListener('click', () => {
    const addbio = document.getElementById('addbio');
    if (addbio) {
        addbio.classList.remove('show');
        overlaybio.classList.remove('show');
    }
});
closebio = document.getElementById("closebio");
closebio.addEventListener('click', () => {
    const addbio = document.getElementById('addbio');
    if (addbio) {
        addbio.classList.remove('show');
        overlaybio.classList.remove('show');
}
});

const profilePhotoContainer = document.getElementById('mudarfoto');
const perfilfoto = document.getElementById('profile-photo-container');
const editIcon = document.getElementById('edit-icon');
perfilfoto.addEventListener('mouseenter', function() {
    editIcon.style.display = 'block';
});
perfilfoto.addEventListener('mouseleave', function() {
    editIcon.style.display = 'none';
});
editIcon.addEventListener('click', function() {
    if (profilePhotoContainer) {
        profilePhotoContainer.classList.toggle('show');
        overlaybio.classList.toggle('show');
    }
});
function mudarfoto() {
    const mudarfoto = document.getElementById('mudarfoto');
    const overlaybio = document.querySelector('.overlaybio');
    if (mudarfoto) {
        mudarfoto.classList.toggle('show');
        overlaybio.classList.toggle('show');
    }
}

overlaybio.addEventListener('click', () => {
    const mudarfoto = document.getElementById('mudarfoto');
    const addbanner = document.getElementById('addbanner');
    if (mudarfoto) {
        mudarfoto.classList.remove('show');
        overlaybio.classList.remove('show');
    }
    if(addbanner) {
        addbanner.classList.remove('show');
        overlaybio.classList.remove('show');
    }
});
closepfp = document.getElementById("closepfp");
closepfp.addEventListener('click', () => {
    const mudarfoto = document.getElementById('mudarfoto');
    const addbanner = document.getElementById('addbanner');
    if (mudarfoto) {
        mudarfoto.classList.remove('show');
        overlaybio.classList.remove('show');
    }
});

const originalContent = document.querySelector('#attbio').innerHTML;
function updatebio() {
    const bio = document.querySelector('#attbio');
    const pencil = " <i class='fa fa-pencil' style='font-family: FontAwesome; cursor: pointer;' onclick='addbio()' title='Alterar bio'></i>";
    bio.innerHTML = originalContent + pencil;
}

function resetbio() {
    const bio = document.querySelector('#attbio');
    bio.innerHTML = originalContent;
}


const fileImage = document.querySelector('.input-preview__src');
const filePreview = document.querySelector('.input-preview');
fileImage.onchange = function () {
    const reader = new FileReader();
    reader.onload = function (e) {
        filePreview.style.backgroundImage  = "url("+e.target.result+")";
        filePreview.classList.add("has-image");
    };
    reader.readAsDataURL(this.files[0]);
};


const fileImageBanner = document.querySelector('.input-banner-preview__src');
const filePreviewBanner = document.querySelector('.input-preview-banner');
fileImageBanner.onchange = function () {
    const reader = new FileReader();
    reader.onload = function (e) {
        filePreviewBanner.style.backgroundImage  = "url("+e.target.result+")";
        filePreviewBanner.classList.add("has-image");
    };
    reader.readAsDataURL(this.files[0]);
};



const perfilbanner = document.getElementById('profile');
const editIconBanner = document.getElementById('edit-icon-banner');
perfilbanner.addEventListener('mouseenter', function() {
    editIconBanner.style.display = 'block';
});
perfilbanner.addEventListener('mouseleave', function() {
    editIconBanner.style.display = 'none';
});
editIconBanner.addEventListener('click', function() {
    if (addbanner) {
        addbanner.classList.toggle('show');
        overlaybio.classList.toggle('show');
    }
});
closebanner = document.getElementById("closebanner");
closebanner.addEventListener('click', () => {
    const addbanner = document.getElementById('addbanner');
    if (addbanner) {
        addbanner.classList.remove('show');
        overlaybio.classList.remove('show');
    }
});