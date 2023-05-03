/**
 * Cette fonction crée un compte pour l'invité.
 * 
 * @return Renvoie 0 si elle a été correctement effectuer, -1 si il y a une erreur.
 */
function createAccount() {
    const XHR = new XMLHttpRequest();
    const FD = new FormData();

    const img = document.getElementById("character");
    const pseudo = document.getElementById("pseudo_guest");
    const room_code = document.getElementById("room_code_guest");

    if (pseudo.value === "") {
        const msg_err = document.getElementById("msg_err");
        msg_err.className = "error";
        return -1;
    }

    FD.append("img", img.src);
    FD.append("pseudo", pseudo.value);
    FD.append("room_code", room_code.value);

    XHR.open('POST', './php/create_guest_account.php', false);
    XHR.send(FD);

    return 0;
}