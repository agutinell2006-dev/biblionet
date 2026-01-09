function cambiar() {
    const input = document.getElementById("contrasena");
    const ojo = document.getElementById("img-contrasena");

    if (input.type === "password") {
        input.type = "text";
        ojo.src = "js/img/ojoabierto.png";
    } else {
        input.type = "password";
        ojo.src = "js/img/ojocerrado.png";
    }
}