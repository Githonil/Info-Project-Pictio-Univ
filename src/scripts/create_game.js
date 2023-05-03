/**
 * Cette fonction crée une partie.
 */
function createGame() {
    const XHR = new XMLHttpRequest();

    XHR.open('POST', './php/create_game.php', false);
    XHR.send();
}