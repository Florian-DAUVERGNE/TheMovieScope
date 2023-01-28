<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Film - The MovieScope</title>
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
    echo '<a href="Admin.php?menu=film">Retour</a>';
else
    echo '<a href="Internaute.php?menu=film">Retour</a>';

$id = $_GET['id'];
echo '<table>';
try {
    $bdd = new PDO($_SESSION['bdd_dsn'], $_SESSION['bdd_username'],$_SESSION['bdd_password']);
}
catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}
$rep = $bdd->query('SELECT * FROM cinema.film INNER JOIN cinema.genre ON film.Genre_idGenre = genre.idGenre INNER JOIN cinema.artiste ON film.Artiste_idRealisateur=artiste.idArtiste WHERE idFilm=' . $id . ' ;');
while ( $donnee = $rep->fetch() ) {
    echo '<tr><td rowspan="5"><img alt="Ce film ne possède pas d\'illustration" height="300px" width="200px" src="' . $donnee[6] . '"></td>';
    echo '<td><h1>' . $donnee['titre'] . '</h1></td>';
    echo '<td  width="450" rowspan="5">' . utf8_encode($donnee['resume']) . '</td></tr>';
    echo '<tr><td>' . $donnee['annee'] . ' - ' . $donnee['libelle'] . '</td></tr>';
    echo '<td>Réalisateur : <a href="Artiste.php?id='.$donnee['idArtiste'].'">' . $donnee[11] . " " . $donnee[10] . '</a></td>';
    if ($_SESSION['admin'] == 1) {
        echo '<tr><td><a href="Suppression.php?id=' . $donnee['idFilm'] . '&genre=film"><button id="bouton">Supprimer</button></a><br>';
        echo '<a href="Modification.php?id=' . $donnee['idFilm'] . '&film=' . $donnee['titre'] . '&genre=film&date=' . $donnee['annee'] . '&type=' . $donnee['libelle'] . '&artiste=' . $donnee['prenom'] . " " . $donnee['nom'] . '&resume=' . urlencode($donnee['resume']) . '&image=' . $donnee[6] . '"><button id="bouton">Modifier</button></a></td></tr>';
    }

    //Affichage des notes moyennes des internautes
    echo '<tr><td>NOTE TOTAL : ';
    $rep          = $bdd->query('SELECT * FROM cinema.noter WHERE Film_idFilm=' . $id . ' ;');
    $total        = 0;
    $dénominateur = 0;
    while ( $donnee = $rep->fetch() ) {
        $total        = $total + $donnee['note'];
        $dénominateur = $dénominateur + 10;
    }
    if ($dénominateur != 0) {
        $total = ($total / $dénominateur) * 10;
        echo '<strong>' . round($total, 1) . '</strong> /10 </td></tr>';
    }
    else
        echo '<strong> ? </strong> /10 </td></tr>';


    echo '</div>';
//affichage des avis
    echo '<div><th colspan="2">AVIS</th>';
    $rep = $bdd->query('SELECT * FROM cinema.film LEFT JOIN  cinema.noter ON idFilm=Film_idFilm  LEFT JOIN cinema.internaute ON idInternaute=Internaute_idInternaute WHERE idFilm=' . $id . ' ;');
    $com = false;
    while ( $donnee = $rep->fetch() ) {
        if ($donnee['commentaire'] != NULL) {
            echo '<tr><td><strong>' . $donnee['nom'] . " " . $donnee['prenom'] . '<p></p>' . $donnee['note'] . '/10</strong></td><td>' . utf8_encode($donnee['commentaire']);
            if($_SESSION['donnee']['idInternaute'] == $donnee['Internaute_idInternaute'])
                echo '<td><a href="Suppression.php?id=' . $donnee['Internaute_idInternaute'] . '&idFilm=' . $id . '&genre=commentaire"><button id="bouton">Supprimer</button></a>';
            echo '</td></tr></div>';
        }

        if($_SESSION['donnee']['idInternaute'] == $donnee['Internaute_idInternaute'] && $donnee['idFilm'] == $donnee['Film_idFilm'])
        {
           $com = true;
        }
    }
    if($com == false)
        echo '<tr><td><a href="Noter.php?id=' . $id . '"><button>Commenter</button></a></td>';



    echo '</table>';
}
