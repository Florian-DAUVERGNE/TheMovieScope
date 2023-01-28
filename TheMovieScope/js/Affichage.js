function Menu_film() {
    document.getElementById("table_film").setAttribute("style","display:block");
    document.getElementById("table_artiste").setAttribute("style","display:none");
    document.getElementById("table_genre").setAttribute("style","display:none");
    document.getElementById("table_internautes").setAttribute("style","display:none");
}

    function Menu_artiste() {
    document.getElementById("table_artiste").setAttribute("style","display:block");
    document.getElementById("table_film").setAttribute("style","display:none");
    document.getElementById("table_genre").setAttribute("style","display:none");
    document.getElementById("table_internautes").setAttribute("style","display:none");
}
function Menu_genre() {
    document.getElementById("table_genre").setAttribute("style","display:block");
    document.getElementById("table_film").setAttribute("style","display:none");
    document.getElementById("table_artiste").setAttribute("style","display:none");
    document.getElementById("table_internautes").setAttribute("style","display:none");
}
function Menu_internaute() {
    document.getElementById("table_internautes").setAttribute("style", "display:block");
    document.getElementById("table_film").setAttribute("style", "display:none");
    document.getElementById("table_artiste").setAttribute("style", "display:none");
    document.getElementById("table_genre").setAttribute("style", "display:none");
}