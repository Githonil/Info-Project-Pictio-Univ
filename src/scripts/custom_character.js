/**
 * Cette fonction charge des images.
 * 
 * @param {*} resources Le tableau où se trouve les images
 * @param {*} sources Les sources des images.
 * @return Renvoie les images.
 */
function loadImages(resources, sources) {
    for (let i = 0; i < sources.length; i++) {
        resources[i] = new Image();
        resources[i].src = sources[i];
    }
    return resources;
}



/**
 * Cette fonction affiche des images.
 * 
 * @param {*} ctx Le contexte où dessiner
 * @param {*} resources Le tableau où se trouve les images.
 */
function renderImages(ctx, ...resources) {
    for (let i = 0; i < resources.length; i++) {
        ctx.drawImage(resources[i], 0, 0);
    }
}



/**
 * Cette fonction charge toutes les images.
 * 
 * @param {*} resources Là où va être stocker toutes les images.
 * @return Renvoie toutes les images.
 */
function fullLoading(resources) {
    const canvas = document.createElement("canvas");
    canvas.width = "284";
    canvas.height = "331";
    const ctx = canvas.getContext("2d");

    let sources = ["./images/base_character.svg"];
    for (let i = 0; i < 7; i++) {
        sources.push(`./images/custom/body_${i}.svg`);
    }
    resources = loadImages(resources, sources);

    return resources;
}



/**
 * Cette fonction incrémente de 1 les tenus.
 */
function addBody() {
    indexBody++;

    if (indexBody > 6)
        indexBody = -1;

    const canvas = document.createElement("canvas");
    canvas.width = "284";
    canvas.height = "331";
    const ctx = canvas.getContext("2d");

    if (indexBody != -1)
        renderImages(ctx, resources[0]);
    else
        renderImages(ctx, resources[0], resources[indexBody + 1]);

    renderImages(ctx, resources[indexBody + 1]);

    const character = document.getElementById("character");
    character.src = canvas.toDataURL();
}



/**
 * Cette fonction décrémente de 1 les tenus.
 */
function removeBody() {
    indexBody--;

    if (indexBody < -1)
        indexBody = 6;

    const canvas = document.createElement("canvas");
    canvas.width = "284";
    canvas.height = "331";
    const ctx = canvas.getContext("2d");


    if (indexBody != -1)
        renderImages(ctx, resources[0]);
    else
        renderImages(ctx, resources[0], resources[indexBody + 1]);

    renderImages(ctx, resources[indexBody + 1]);

    const character = document.getElementById("character");
    character.src = canvas.toDataURL();
}



var resources = Array();
var indexBody = -1;
fullLoading(resources);