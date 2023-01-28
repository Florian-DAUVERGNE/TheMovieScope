<?php
session_start();
if (isset($_SESSION['admin'])) {
    if ($_SESSION['admin'] == 1) {
        header('location:Admin.php');
    }
}
else
    header('location:Index.php');
if (isset($_GET['menu']))
    $menu = $_GET['menu'];
else
    $menu = "film";
echo '<div id="menu" style="display: none">' . $menu . '</div>'
?>
<html lang="fr">
<head>
    <script src="js/Affichage.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Menu - TheMovieScope</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>
<body>
<nav>
    <div class="navbar">
        <div class="logo"><a>TheMovieScope</a></div>
        <div class="nav-links">
            <ul class="links">
                <li>
                    <button onclick="Menu_film()">Films</button>
                </li>
                <li>
                    <button onclick="Menu_artiste()">Artistes</button>
                </li>
                <li>
                    <button onclick="Menu_genre()">Genre</button>
                    <i class='bx bxs-chevron-down arrow '></i>
                    <ul class="js-sub-menu sub-menu">
                        <?php
                        try {
                            $bdd = new PDO($_SESSION['bdd_dsn'], $_SESSION['bdd_username'],$_SESSION['bdd_password']);
                        }
                        catch (Exception $e) {
                            die('Erreur de connexion : ' . $e->getMessage());
                        }
                        $rep = $bdd->query('SELECT * FROM cinema.genre;');
                        while ( $donnee = $rep->fetch() ) {
                            echo '<li><a href="Internaute.php?menu=genre&genrefilm=' . $donnee['libelle'] . '">' . $donnee['libelle'] . '</a></li>';
                        }
                        ?>
                    </ul>
                </li>
                <li><a href="Profil.php">Profil</a></li>
                <li><a href="Index.php">Déconnexion</a></li>
                <li><a href="APropos.php">À propos</li>
            </ul>
        </div>
        <div class="logo"><a><img src="assets/img/logo_TheMovieScope_HD.png" width="125" height="70"/></a></div>
    </div>
    <div class="scrollit">
    <?php
    try {
        $bdd = new PDO($_SESSION['bdd_dsn'], $_SESSION['bdd_username'],$_SESSION['bdd_password']);
    }
    catch (Exception $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }


    //////////////////////////////////////////////////////////Requete pour afficher les films/////////////////////////////////////////////////////////////////////////////////////////////

    echo '<table id="table_film" style="display: none">';
    $rep = $bdd->query('SELECT * FROM cinema.film ;');
    $i   = 0;
    while ( $donnee = $rep->fetch() ) {
        if ($i > 6) {
            echo '</tr><tr>';
            $i = 0;
        }

        $ti = 25;
        if(strlen($donnee['titre']) >= $ti)
        {
            $donnee['titre'][$ti-4] = " ";
            for($k = $ti-3; $k<$ti; $k++)
            {
                $donnee['titre'][$k] = ".";
            }

            for($k = $ti; $k < strlen($donnee['titre']); $k++)
            {
                $donnee['titre'][$k] = " ";
            }

        }

        if ($donnee['image'] == null)
            $donnee['image'] = "assets/img/no_image_available.png";
        echo '<td><a href="Film.php?id=' . $donnee["idFilm"] . '"><img title="' . $donnee['titre'] . '" alt="Ce film ne possède pas d\'illustration" height="200px" width="150px" src="' . $donnee['image'] . '"></a></a><h5>' . $donnee['titre'] . '</h5></td>';
        $i++;
    }
    echo '</table>';


    //////////////////////////////////////////////////////////Requete pour afficher les artistes/////////////////////////////////////////////////////////////////////////////////////////////

    $rep = $bdd->query('SELECT * FROM cinema.artiste;');
    echo '<table id="table_artiste" style="display: none">';
    while ( $donnee = $rep->fetch() ) {
        if ($donnee['image'] == null)
            $donnee['image'] = "assets/img/no_image_available.png";
        echo '<td><a href="Artiste.php?id=' . $donnee["idArtiste"] . '"><img title="' . $donnee['prenom'] . " " . $donnee['nom'] . '" alt="Cet artiste ne possède pas d\'illustration" height="125px" width="100px" src="' . $donnee['image'] . '"></a><h5>' . $donnee['prenom'][0] . ". " . $donnee['nom'] . '</h5></td>';
    }
    echo '</table>';


    //////////////////////////////////////////////////////////Requete pour afficher les genres/////////////////////////////////////////////////////////////////////////////////////////////

    if (isset($_GET["genrefilm"])) {
        $rep = $bdd->query('SELECT * FROM cinema.film INNER JOIN cinema.genre ON film.Genre_idGenre = genre.idGenre  where libelle="' . $_GET["genrefilm"] . '";');

        echo '<table id="table_genre">';
        if ($rep->rowCount() <= 0) {
            echo '<td>Il n\'existe pas de film de ce genre</td>';
        }
        while ( $donnee = $rep->fetch() ) {
            if ($i > 6) {
                echo '</tr><tr>';
                $i = 0;
            }

            $ti = 25;
            if(strlen($donnee['titre']) >= $ti)
            {
                $donnee['titre'][$ti-4] = " ";
                for($k = $ti-3; $k<$ti; $k++)
                {
                    $donnee['titre'][$k] = ".";
                }

                for($k = $ti; $k < strlen($donnee['titre']); $k++)
                {
                    $donnee['titre'][$k] = " ";
                }

            }

            if ($donnee['image'] == null)
                $donnee['image'] = "assets/img/no_image_available.png";
            echo '<td><a href="Film.php?id=' . $donnee["idFilm"] . '"><img title="' . $donnee['titre'] . '" alt="Ce film ne possède pas d\'illustration" height="200px" width="150px" src="' . $donnee['image'] . '"></a></a><h5>' . $donnee['titre'] . '</h5></td>';
            $i++;}
        echo '</table>';
    }
    ?>
    </div>
</body>
</nav>
<script>
    if (document.getElementById("menu").outerText === "film") {
        Menu_film();
    }

    if (document.getElementById("menu").outerText === "artiste") {
        Menu_artiste();
    }

    if (document.getElementById("menu").outerText === "genre") {
        Menu_genre();
    }

    if (document.getElementById("menu").outerText === "internautes") {
        Menu_internaute();
    }
</script>

</html>