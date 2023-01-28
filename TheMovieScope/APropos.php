<?php
session_start();

?>


    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>À Propos - TheMovieScope</title>
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/navbar.css">
    </head>
    <body>


    <nav>
        <div class="navbar">
            <div class="logo"><a>TheMovieScope</a></div>
            <div class="nav-links">
                <ul class="links">
                    <li><a href="Admin.php">Accueil</a></li>
                    <li><a href="Index.php">Déconnexion</a></li>
                </ul>
            </div>
            <div class="logo"><a><img src="assets/img/logo_TheMovieScope_HD.png" width="125" height="70"/></a></div>
        </div>


<?php


//Affichage d'un formulaire de modification du profil de l'utilisateur
echo '
<div id="modif_div">
<p>Ce site e été créé par <a href="https://github.com/SAUNIQUE">AHMED-SALIH HAZIM</a>, <a href="https://github.com/Florian04">CODEBECQ FLORIAN</a> et <a href="https://github.com/floriandauvergne">DAUVERGNE FLORIAN</a></p>
</div>
<div><a href="https://github.com/SAUNIQUE/Site-Film">Lien du projet GITHUB</a></div>
</nav>
</body>
</html>';