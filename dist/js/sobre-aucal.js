function openTab(evt,tabName) {
    var i;
    var x = document.getElementsByClassName("tab");

    let banner = document.getElementsByClassName('imagen_sobre_aucal')[0];
    
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    
    var tablinks = document.getElementsByClassName("tablink");
    
    for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" tablink-red", "");
    }
    
    banner.src = `/2022/dist/images/aucal-${tabName}.png`;
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.firstElementChild.className += " tablink-red";
}

//Leer más - leer menos

let link = document.getElementById("editLink");
link.addEventListener("click", leerMas);

let linkMas = document.getElementById("editHidden");
let linkMenos = document.getElementById("editClick");

function leerMas() {
  linkMas.style.display="block";
  link.style.display="none";
  linkMenos.style.display="block";  
}

linkMenos.addEventListener("click", leerMenos);

function leerMenos() {
  linkMas.style.display="none";
  link.style.display="block";
  linkMenos.style.display="none";    
}

//Cambair imagen tabs
