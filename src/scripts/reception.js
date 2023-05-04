/**
 * Cette fonction change les menus sélectionnées de l'accueil.
 * 
 * @param {*} id_select L'id du menu sélectionné.
 * @param {*} id_unselect L'id du menu non sélectioné.
 */
function swap_select(id_selected, id_unselected) {
    const element_selected = document.getElementById(id_selected);
    const element_unselected = document.getElementById(id_unselected);
    const content_selected = document.getElementById(id_selected.concat("_content"));
    const content_unselected = document.getElementById(id_unselected.concat("_content"));
    const text_selected = document.getElementById(id_selected.concat("_text"));
    const text_unselected = document.getElementById(id_unselected.concat("_text"))
    element_selected.className = "active";
    element_unselected.className = "inactive";
    content_selected.className = "show";
    content_unselected.className = "hidden";
    text_selected.className = "active_text";
    text_unselected.className = "inactive_text";
}




/**
 * Cette fonction affiche l'aide du curseur.
 */
function cursor_help() {
    const help = document.getElementsByName("help");
    help[0].className = "help";
    help[1].className = "help";
}



/**
 * Cette fonction retire l'aide du curseur.
 */
function cursor_help_remove() {
    const help = document.getElementsByName("help");
    help[0].className = "help hidden";
    help[1].className = "help hidden";
}



/**
 * Cette fonction lance un hébergement d'une partie.
 */
function host() {
    createGame();
    window.location = "./host.php";
}



/**
 * Cette fonction lance un hébergement d'une partie en tant qu'invité.
 */
function hostGuest() {
    const success = createAccount();
    if (success === 0)
        host();
}



/**
 * Cette fonction lance une partie.
 * 
 * @param room_code Le code de la partie.
 */
function play(room_code) {
    window.location = `./php/join_game.php?room_code=${room_code}`;
}



/**
 * Cette fonction lance une partie avec un compte..
 */
function playAccount() {
    const room_code = document.getElementById("room_code_account");
    play(room_code.value);
}



/**
 * Cette fonction lance une partie en tant qu'invité.
 */
function playGuest() {
    const room_code = document.getElementById("room_code_guest");
    const success = createAccount();
    if (success === 0)
        play(room_code.value);
}