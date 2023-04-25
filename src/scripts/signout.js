/**
 * Cette fonction affiche la popup de désinscription.
 */
function spawn_popup() {
    const popup = document.getElementById("popup");
    popup.className = "popup";
}



/**
 * Cette fonction retire la popup de désinscription.
 */
function despawn_popup() {
    const popup = document.getElementById("popup");
    popup.className = "hidden";
}



/**
 * Cette fonction redirige vers la page de désinscription.
 */
function go_signout() {
    window.location = "./signout.php";
}