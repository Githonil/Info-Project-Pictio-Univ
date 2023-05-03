/**
 * Cette fonction s'active lorsque un joueur se déconnecte.
 */
function player_leaves() {
    if (!noCloseInformation) {
        const XHR = new XMLHttpRequest();

        XHR.open('POST', './php/player_quits.php', true);
        XHR.send();
    }
}

window.addEventListener("beforeunload", player_leaves);

var noCloseInformation = false;