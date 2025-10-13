// GENERAR LISTA DE PAÍSES EN SELECT OPTION

const select = document.querySelector(".section-6-select");

const getPaises = async () => {
    const response = await fetch("/2022/dist/js/paises.json");
    const { countries } = await response.json();
    countries.forEach((country) => {
        const option = document.createElement("option");
        option.value = country.iso2;
        option.text = country.nombre;

        select.appendChild(option);
    });
};

getPaises();

// APLICAR FUNCION FOCUSINPUT A INPUTS DE SECTION 6
function focusInput(inputElement, div) {
    inputElement.addEventListener("focus", () => {
        div.style.border = "2px solid rgb(var(--main-yellow)) ";
    });

    inputElement.addEventListener("blur", () => {
        div.style.border = "none";
    });
}

const input6 = document.querySelectorAll(".input-6");
const sectionDiv6 = document.querySelectorAll(".section-6-input");

for (let i = 0; i < input6.length; i++) {
    focusInput(input6[i], sectionDiv6[i]);
}