/**
 * Cette fonction change les menus sélectionnées de l'accueil (si un joueur connecté) pour un invité.
 */
function swap_select_guest_connected() {
    const element_selected = document.getElementById("guest");
    const element_unselected = document.getElementById("player");
    const content_selected = document.getElementById("guest_content");
    const content_unselected = document.getElementById("player_content_connected");
    element_selected.className = "active";
    element_unselected.className = "inactive";
    content_selected.className = "show";
    content_unselected.className = "hidden";
}



/**
 * Cette fonction change les menus sélectionnées de l'accueil (si un joueur connecté) pour un compte.
 */
function swap_select_player_connected() {
    const element_selected = document.getElementById("guest");
    const element_unselected = document.getElementById("player");
    const content_selected = document.getElementById("guest_content");
    const content_unselected = document.getElementById("player_content_connected");
    element_selected.className = "inactive";
    element_unselected.className = "active";
    content_selected.className = "hidden";
    content_unselected.className = "show";
}