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
    element_selected.className = "active";
    element_unselected.className = "inactive";
    content_selected.className = "show";
    content_unselected.className = "hidden";
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