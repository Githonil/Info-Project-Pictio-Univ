setInterval(() => {

    $(".guests").load("./php/list_players.php");

    const XHR = new XMLHttpRequest();
    const FD = new FormData();

    const private_party = document.getElementById("private_party");
    const timer = document.getElementById("timer");
    const nb_rounds = document.getElementById("nb_rounds");
    const nb_words = document.getElementById("nb_words");

    FD.append("private_party", private_party.checked ? 1 : 0);
    FD.append("timer", timer.value);
    FD.append("nb_rounds", nb_rounds.value);
    FD.append("nb_words", nb_words.value);

    XHR.open('POST', './php/host.php');
    XHR.send(FD);

}, 100);