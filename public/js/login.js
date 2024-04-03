function init() {
    console.log("primer proceso");
    alert("primer proceso")
    var txtUsuario = document.getElementById("email");
    var txtPassword = document.getElementById("password");

    txtUsuario.value = "";
    txtPassword.value = "";
}

function gestionUsuario(){
    txtUsuario=document.getElementById("email").value;
    lbUsuario=document.getElementById("lbUsuario");
    if (txtUsuario.trim() === "") {
        lbUsuario.style.display = "none";
    } else {
        lbUsuario.style.display = "block";
    }
}

function gestionPassword(){
    txtPassword=document.getElementById("password").value;
    lbPassword=document.getElementById("lbPassword");
    if (txtPassword.trim() === "") {
        lbPassword.style.display = "none";
    } else {
        lbPassword.style.display = "block";
    }
}