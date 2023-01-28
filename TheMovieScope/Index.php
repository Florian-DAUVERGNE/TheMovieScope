<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="js/formulaire.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>The MovieScope</title>
    <link rel="icon" href="assets/img/logo_TheMovieScope_HD.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
<a class="navbar-brand"><img src="assets/img/logo_TheMovieScope_HD.png" width="250px" /></a>
<nav class="navbar navbar-dark navbar-expand-md fixed-top d-lg-flex">
    <div class="container-fluid"><button class="navbar-toggler" data-bs-toggle="collapse"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link active"><button style="color:white; background-color:transparent;border-color:transparent"  id="sign_button" onclick="sign()">S'inscrire</button></a></li>
        </ul>
    </div>
</nav>

<section class="login-dark">
    <div id="connexion" style="display: block;">

        <form action="Traitement.php" method="post">
            <h2 class="visually-hidden">Login Form</h2>
            <?php
            if(isset($_GET['inscription'])){
                if($_GET['inscription']==1)
                    echo '<div >Merci de votre inscription ! Vous pouvez vous connecter !</div>';
                else if($_GET['inscription']==2)
                    echo '<div >Le compte existe déjà </div>';
                else if($_GET['inscription']==3)
                    echo '<div >Le mot de passe n\'est pas bon ou le compte spécifié n\'existe pas </div>';
            }
            ?>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="mb-3"><input class="form-control" type="text" name="login" id="login" placeholder="Mail"></div>
            <div class="mb-3"><input class="form-control d-lg-flex" type="password" id="mdp" name="mdp" placeholder="Password"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="button" onclick="VerifierLogin(this.form)">Connexion</button></div>
        </form>
    </div>

    <div id="inscription" style="display: none">
        <form action="Creation.php" method="post">
            <h2 class="visually-hidden">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="mb-3"><input class="form-control" type="text" name="login" id="login" placeholder="Mail"></div>
            <div class="mb-3"><input class="form-control" type="text" name="nom" id="nom" placeholder="Nom"></div>
            <div class="mb-3"><input class="form-control" type="text" name="prenom" id="prenom" placeholder="Prenom"></div>
            <div class="mb-3"><input class="form-control d-lg-flex" type="password" name="mdp" id="mdp" name="password" placeholder="Mot de passe"></div>
            <div class="mb-3"><input class="form-control d-lg-flex" type="password" name="conf" id="conf" name="conf" placeholder="Confirmation"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="button" onclick="VerifierInscription(this.form)">S'inscrire</button></div>
        </form>
    </div>
</section>
</body>
</html>