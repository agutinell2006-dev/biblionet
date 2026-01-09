for (let h = 0; h <= 4; h++) {
    document.querySelector(".estrellas").insertAdjacentHTML("beforeend", `<img carlos='${h}' class="estrella" src="js/img/estrellagris.png"/>`);
    document.querySelectorAll(".estrella")[h].addEventListener("click", colorear);
}

function colorear() {
    let j = this.getAttribute("carlos");
    document.querySelector(".estrellas").innerHTML = "";
    
    for (let h = 0; h <= 4; h++) {
        let src = h <= j ? "js/img/estrelladorada.png" : "js/img/estrellagris.png";
        document.querySelector(".estrellas").insertAdjacentHTML("beforeend", `<img carlos='${h}' class="estrella" src="${src}"/>`);
    }

    document.querySelector("#valoracion").value = Number(j) + 1;

   
    document.querySelectorAll(".estrella").forEach(estrella => {
        estrella.addEventListener("click", colorear);
    });
}