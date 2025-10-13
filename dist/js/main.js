//BARRA NAVEGACION
function menuList(){  
  var menu = document.getElementById("navMenu");
  var campus = document.getElementById("navCampus");
  var logo = document.getElementById("logoImg");

  if(menu.style.display ==="none") {
    menu.style.display ="flex";
    campus.style.display="none";
    logo.style.top="-25%";
  } else {
    menu.style.display ="none";
    campus.style.display="block";
    logo.style.top="-180%";
  }

}


function menuResponsive(event, mostrarMenu) {

  var i;
  var click = document.getElementsByClassName("menu-list")[0];
    
    if(click.style.display ==="none") {
      click.style.display ="block";
      } else {
          click.style.display ="none";
      }
}


/***************************** */
// TABS ESTUDIAR EN AUCAL
function openTab(evt, tabName) {
  let banner = document.getElementsByClassName('estudiar-banner')[0];

  var i;
  var x = document.getElementsByClassName("tab");

  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }

  var estudiar_tablinks = document.getElementsByClassName("estudiar-tablink");


  for (i = 0; i < x.length; i++) {
    estudiar_tablinks[i].className = estudiar_tablinks[i].className.replace(" tablink-black", "");
  }

  //Cambair imagen tabs
  banner.style.backgroundImage = `url(/2022/dist/images/banner_estudiar_${tabName}.png)`;
  
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " tablink-black";
}


/***************************** */
// TABS CURSOS - oferta educativa
function showTab(evt, tabName) {
  var i;
  var x = document.getElementsByClassName("tab");

  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }

  var cursos_tablinks = document.getElementsByClassName("cursos-tablink");


  for (i = 0; i < x.length; i++) {
    cursos_tablinks[i].className = cursos_tablinks[i].className.replace(" tablink-black", "");
  }

  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " tablink-black";
}


/* ****************************** */
// TABS CURSOS - oferta educativa
function changeTab(evt, tabName) {
  var i;
  var x = document.getElementsByClassName("tab");

  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }

  var secciones_tablinks = document.getElementsByClassName("tab-sec-txt");


  for (i = 0; i < x.length; i++) {
    secciones_tablinks[i].className = secciones_tablinks[i].className.replace(" tab-link-secciones", "");
  }

  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " tab-link-secciones";
}



/***************************** */
// DROPDOWN BECAS-DESCUENTOS, CURSOS, ESTUDIAR-AUCAL, NAVBAR
function show_hide(event, mostrarName) {
  
  var click = document.getElementById(mostrarName);

  if(click.style.display ==="none") {
    click.style.display ="block";
    } else {
        click.style.display ="none";
    }
  
}

// let dropbtns = document.getElementsByClassName('dropdown');

// for (button of dropbtns) {
//   //console.log(button);
//   button.addEventListener('click', (e) => {
//     // let test = e.target.nextSibling;
//     // console.log(test);

//   })
// }

/***************************** */
/* CARRUSELES */
const slider = document.querySelector(".items");
const slides = document.querySelectorAll(".item");
const button = document.querySelectorAll(".button");

let current = 0;
let prev = 10;
let next = 10;

for (let i = 0; i < button.length; i++) {
  button[i].addEventListener("click", () => i == 0 ? gotoPrev() : gotoNext());
}

const gotoPrev = () => current > 0 ? gotoNum(current - 1) : gotoNum(slides.length - 1);

const gotoNext = () => current < 10 ? gotoNum(current + 1) : gotoNum(0);

const gotoNum = number => {
  current = number;
  prev = current - 1;
  next = current + 1;

  for (let i = 0; i < slides.length; i++) {
    slides[i].classList.remove("active");
    slides[i].classList.remove("prev");
    slides[i].classList.remove("next");
  }

  if (next == 10) {
    next = 0;
  }

  if (prev == -1) {
    prev = 11;
  }

  slides[current].classList.add("active");
  slides[prev].classList.add("prev");
  slides[next].classList.add("next");
}

/******************/
/*Compartir noticia-blog*/
var compartir = document.getElementById('btnMostrar');
compartir.addEventListener('click', () => { 
  var redes = document.getElementById('divOculto');

  if(redes.style.display ==="none") {
    redes.style.display ="block";
    } else {
        redes.style.display ="none";
    }

});