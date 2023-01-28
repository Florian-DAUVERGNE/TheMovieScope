<?php

session_start();

?>


    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Profil - TheMovieScope</title>
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
echo '<div id="modif_div">
    <h1>Bonjour ' . $_SESSION['donnee']['nom'] . '  ' . $_SESSION['donnee']['prenom'] . ' ! </h1>
    <form action="Profil.php" method="post">
        <table>
            <tr>
                <td><label>Nom</label></td>
                <td ><input name="nom" value="' . $_SESSION['donnee']['nom'] . '"></td>
            </tr>
            <tr>
                <td><label>Prenom</label></td>
                <td ><input name="prenom" value="' . $_SESSION['donnee']['prenom'] . '"></td>
            </tr>
            <tr>
                <td><label>Mot de Passe</label></td>
                <td ><input type="password" name="password" value="' . $_SESSION['donnee']['password'] . '"></td>
            </tr>
            
            <td><input type="button" value="Modifier" onclick="this.form.submit()"></td>
            </tr>
        </table>
    </form>';

echo '<tr><td colspan="2"><a href="Suppression.php?id=' . $_SESSION['donnee']['idInternaute'] . '&genre=internautes"><button id="bouton">Supprimer votre compte</button></a><br>
    

</div>
</nav>
</body>
</html>';


if (isset($_POST['nom']) && isset($_POST['prenom'])) {
    $nom      = $_POST['nom'];
    $prenom   = $_POST['prenom'];
    $id       = $_SESSION['donnee']['idInternaute'];
    $password = $_POST['password'];
    try {
        $bdd = new PDO($_SESSION['bdd_dsn'], $_SESSION['bdd_username'],$_SESSION['bdd_password']);
    }
    catch (Exception $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }
    $req = $bdd->prepare('UPDATE internaute SET prenom = ?, nom = ?, password = ? WHERE idInternaute = ?;');
    $req->execute([$prenom, $nom, $password, $id]) or die(print_r($req->errorInfo()));
    header('Location: Admin.php');
}
