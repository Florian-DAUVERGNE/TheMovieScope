<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Artiste - TheMovieScope</title>
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
                <li><a href="Profil.php">Profil</a></li>
                <li><a href="Index.php">Déconnexion</a></li>
            </ul>
        </div>
        <div class="logo"><a><img src="assets/img/logo_TheMovieScope_HD.png" width="125" height="70"/></a></div>
    </div>


    <?php
    session_start();
    if ($_SESSION['admin'] == 1)
        echo '<a href="Admin.php?menu=artiste">Retour</a>';
    else
        echo '<a href="Internaute.php?menu=artiste">Retour</a>';
    $id = $_GET['id'];
    echo '<table id="table_artiste">';
    try {
        $bdd = new PDO($_SESSION['bdd_dsn'], $_SESSION['bdd_username'],$_SESSION['bdd_password']);
    }
    catch (Exception $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }
    $rep = $bdd->query('SELECT * FROM cinema.artiste WHERE idArtiste=' . $id . ';');
    while ( $donnee = $rep->fetch() ) {
        if ($donnee['image'] == null)
            $donnee['image'] = "assets/img/no_image_available.png";

        echo '<th><img height="200px" width="150px" src="' . $donnee['image'] . '">' .
            '<h2>' . $donnee['prenom'] . ' ' . $donnee['nom'] . '</h2>' .
            ' Date de naissance :' . $donnee['dateNaiss'] .
            '</th>';

        //Affichage des boutons pour l'admin
        if ($_SESSION['admin'] == 1) {
            echo '  <td><a href="Suppression.php?id=' . $donnee['idArtiste'] . '&genre=artiste"><button>Supprimer</button></a></td>
                <td><a href="Modification.php?id=' . $donnee['idArtiste'] . '&genre=artiste&nom=' . $donnee['nom'] . '&prenom=' . $donnee['prenom'] . '&date=' . $donnee['dateNaiss'] . '&image=' . $donnee['image'] .'"><button>Modifier</button></a></td>';
        }
    }


    echo '<table><th colspan="10">FILMS</th><tr>';
    $rep = $bdd->query('SELECT * FROM cinema.film WHERE Artiste_idRealisateur = '.$id.';');
    $i   = 0;
    while ( $donnee = $rep->fetch() ) {
        if ($i > 6) {
            echo '</tr><tr>';
            $i = 0;
        }


        if ($donnee['image'] == null)
            $donnee['image'] = "assets/img/no_image_available.png";

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


        //Affichage des affiches de films avec un lien cliquable et leurs noms
        echo '<td><a href="Film.php?id=' . $donnee["idFilm"] . '"><img title="' . $donnee['titre'] . '" alt="Ce film ne possède pas d\'illustration" height="200px" width="150px" src="' . $donnee['image'] . '"></a><h5>' . $donnee['titre'] . '</h5></td>';
        $i++;
    }
    echo '</tr></table>';







    ?>
</nav>
</table>
</body>
</html>
