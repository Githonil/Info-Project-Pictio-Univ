const canvas = document.getElementById("canvas");
const radius = document.getElementById("selectradius");
const ctx = canvas.getContext("2d");

/**
 * Cette fonction initialise l'ajustation des coordonnées de la souris pour le canvas.
 */
function initCoordCanvas() {
    let element = canvas;

    while (element != document.body) {
        coordXCanvas += element.offsetLeft + element.scrollLeft;
        coordYCanvas += element.offsetTop + element.scrollTop;
        element = element.offsetParent;
    }
}



let coordXCanvas = 0;
let coordYCanvas = 0;
initCoordCanvas()

let painting = false;



/**
 * Cette fonction agit lorsque la souris est lâché.
 * 
 * @param {*} e Le registre de l'évènement.
 */
function getRelease(e) {
    if (e.button != 0) return;

    painting = false;
}



/**
 * Cette fonction agit lorsque la souris est préssé.
 * 
 * @param {*} e Le registre de l'évènement.
 */
function getPressed(e) {
    if (e.button != 0) return;

    painting = true;
}



/**
 * Cette fonction fait le rendu lorsque on dessine.
 * 
 * @param {*} e Le registre de l'évènement.
 */
function sketch(e) {
    if (painting == false) return;

    coordX = e.clientX - coordXCanvas;
    coordY = e.clientY - coordYCanvas;

    if (coordX < 0 || coordY < 0) return;

    ctx.fillStyle = "#000";

    ctx.beginPath();
    ctx.arc(coordX, coordY, radius.value, 0, 8);
    ctx.closePath();
    ctx.fill();
}


document.addEventListener("mousedown", getPressed);
document.addEventListener("mouseup", getRelease);
document.addEventListener("mousemove", sketch);