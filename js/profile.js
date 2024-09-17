document.addEventListener('DOMContentLoaded', function() {
    const bioForm = document.getElementById('bioForm');
    const bioTextarea = document.getElementById('bio');
    function submitBioForm() {
        const formData = new FormData(bioForm);
        
        fetch('save_bio.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: data.message,
                    timer: 1300,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'index.php';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: data.message,
                    confirmButtonText: 'Tentar novamente'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Ocorreu um erro inesperado.',
                confirmButtonText: 'Tentar novamente'
            });
        });
    }
    bioTextarea.addEventListener('keypress', function(e) {
        var key = e.which || e.keyCode;
        if (key === 13) { 
            e.preventDefault(); 
            submitBioForm(); 
        }
    });
    bioForm.addEventListener('submit', function(event) {
        event.preventDefault();
        submitBioForm();
    });
});


document.addEventListener('DOMContentLoaded', function() {
    let cropper;
    const image = document.getElementById('image');
    const inputImage = document.getElementById('picture__input');
    const imageContainer = document.getElementById('imageContainer');
    const cropButton = document.getElementById('cropButton');
    const showPreviewButton = document.getElementById('showPreviewButton');
    const labelPreview = document.getElementById('labelPreview');
    const croppedImageInput = document.getElementById('croppedImage');
    const form = document.getElementById('fotoperfilForm');
    const submitButton = document.getElementById('submitButton');
    const excluirFotoForm = document.getElementById('excluirFotoForm');
    inputImage.addEventListener('change', function(event) {
        const files = event.target.files;
        if (files && files.length > 0) {
            const reader = new FileReader();
            reader.onload = function(e) {
                image.src = e.target.result;
                imageContainer.style.display = 'block';
                cropButton.style.display = 'inline';
                showPreviewButton.style.display = 'none';
                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                });
            };
            excluirFotoForm.style.display = 'none';
            submitButton.style.display = 'none';
            reader.readAsDataURL(files[0]);
        }
    });
    cropButton.addEventListener('click', function() {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas({
                width: 500,
                height: 500
            });
            canvas.toBlob(function(blob) {
                const reader = new FileReader();
                reader.onloadend = function() {
                    const croppedImageDataURL = reader.result;
                    croppedImageInput.value = croppedImageDataURL;
                    labelPreview.style.backgroundImage = `url(${croppedImageDataURL})`;
                    labelPreview.style.backgroundSize = 'cover';
                    imageContainer.style.display = 'none';
                    cropButton.style.display = 'none';
                    showPreviewButton.style.display = 'none';
                    submitButton.disabled = false;
                    excluirFotoForm.style.display = 'block';
                    submitButton.style.display = 'block';
                };
                reader.readAsDataURL(blob);
            }, 'image/jpeg');
        }
    });
    showPreviewButton.addEventListener('click', function() {
        form.submit();
    });
});
const form_foto = document.getElementById('excluirFotoForm');
function exibirConfirmacao() {
    Swal.fire({
        title: 'Tem certeza?',
        text: "Você não poderá desfazer essa ação!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, deletar!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deletado!',
                'Sua foto foi deletada.',
                'success'
            ).then(() => {
                form_foto.submit();
            });
        }
    });
}
document.addEventListener('DOMContentLoaded', function() {
const form = document.getElementById('fotoperfilForm');

form.addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(form);
    
    fetch('upload_foto.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: data.message,
                timer: 1300,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'index.php';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: data.message,
                confirmButtonText: 'Tentar novamente'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'Ocorreu um erro inesperado.',
            confirmButtonText: 'Tentar novamente'
        });
    });
});
});




const form_banner = document.getElementById('excluirBannerForm');
function exibirConfirmacaoBanner() {
    Swal.fire({
        title: 'Tem certeza?',
        text: "Você não poderá desfazer essa ação!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, deletar!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deletado!',
                'Sua foto foi deletada.',
                'success'
            ).then(() => {
                form_banner.submit();
            });
        }
    });
}
document.addEventListener('DOMContentLoaded', function() {
    let cropper;
    const bannerImage = document.getElementById('bannerImage');
    const inputBanner = document.getElementById('banner__input');
    const bannerImageContainer = document.getElementById('bannerImageContainer');
    const cropBannerButton = document.getElementById('cropBannerButton');
    const showBannerPreviewButton = document.getElementById('showBannerPreviewButton');
    const labelPreviewBanner = document.getElementById('labelPreviewBanner');
    const croppedBannerImageInput = document.getElementById('croppedBannerImage');
    const bannerForm = document.getElementById('fotobannerForm');
    const bannerSubmitButton = document.getElementById('bannerSubmitButton');
    const excluirBannerForm = document.getElementById('excluirBannerForm');
    
    inputBanner.addEventListener('change', function(event) {
        const files = event.target.files;
        if (files && files.length > 0) {
            const reader = new FileReader();
            reader.onload = function(e) {
                bannerImage.src = e.target.result;
                bannerImageContainer.style.display = 'block';
                cropBannerButton.style.display = 'inline';
                showBannerPreviewButton.style.display = 'none';
                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(bannerImage, {
                    aspectRatio: 4 / 1,
                    viewMode: 1,
                    autoCropArea: 1,
                });
            };
            excluirBannerForm.style.display = 'none';
            bannerSubmitButton.style.display = 'none';
            reader.readAsDataURL(files[0]);
        }
    });

    cropBannerButton.addEventListener('click', function() {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas({
                width: 1200,
                height: 300
            });
            canvas.toBlob(function(blob) {
                const reader = new FileReader();
                reader.onloadend = function() {
                    const croppedImageBannerDataURL = reader.result;
                    croppedBannerImageInput.value = croppedImageBannerDataURL.split(',')[1];
                    labelPreviewBanner.style.backgroundImage = `url(${croppedImageBannerDataURL})`;
                    labelPreviewBanner.style.backgroundSize = 'cover';
                    bannerImageContainer.style.display = 'none';
                    cropBannerButton.style.display = 'none';
                    showBannerPreviewButton.style.display = 'none';
                    bannerSubmitButton.disabled = false;
                    excluirBannerForm.style.display = 'block';
                    bannerSubmitButton.style.display = 'block';
                };
                reader.readAsDataURL(blob);
            }, 'image/jpeg');
        }
    });

    bannerForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(bannerForm);                    
        fetch('upload_banner.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: data.message,
                    timer: 1300,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'index.php';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: data.message,
                    confirmButtonText: 'Tentar novamente'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Ocorreu um erro inesperado.',
                confirmButtonText: 'Tentar novamente'
            });
        });
    });
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

const element = document.querySelector('#attbio');
const originalContent = element ? element.innerHTML : '';
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