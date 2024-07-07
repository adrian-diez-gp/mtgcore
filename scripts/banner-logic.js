document.addEventListener("DOMContentLoaded", () => {
    const banner = document.getElementById("banner-creado") ?
                   document.getElementById("banner-creado") :
                   document.createElement('span')
    if (banner.style.display = "block") {
        setTimeout(function() {
            banner.style.display = "none";
        }, 5000);
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const banner = document.getElementById("banner-eliminado") ?
                   document.getElementById("banner-eliminado") :
                   document.createElement('span')
    if (banner.style.display = "block") {
        setTimeout(function() {
            banner.style.display = "none";
        }, 5000);
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const banner = document.getElementById("banner-actualizado") ?
                   document.getElementById("banner-actualizado") :
                   document.createElement('span')
    if (banner.style.display = "block") {
        setTimeout(function() {
            banner.style.display = "none";
        }, 5000);
    }
});