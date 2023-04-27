setInterval(() => {

    const img = document.getElementById("character");
    const dataImg = document.getElementById("dataImg");

    dataImg.setAttribute("value", img.src);

}, 100);