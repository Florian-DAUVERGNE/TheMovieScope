<?php
session_start();

$email    = $_POST['login'];
$password = $_POST['mdp'];

$_SESSION['bdd_dsn']='mysql:host=localhost;dbname=cinema';
$_SESSION['bdd_username']='root';
$_SESSION['bdd_password']='';



//connexion bdd
try {
    $bdd = new PDO($_SESSION['bdd_dsn'], $_SESSION['bdd_username'],$_SESSION['bdd_password']);
}
catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

//preparation de la requête avec les variables $_POST du formulaire
$req = $bdd->prepare('SELECT * FROM internaute WHERE password=:password AND email=:email');
$req->execute(array('password' => $password, 'email' => $email)) or die(print_r($req->errorInfo()));

$donnee = $req->fetch();
$req->closeCursor();

//Redirection en fonction de la reponse de la requete et du status administrateur de l'internaute
switch ($donnee['admin']) {

    case '1'    :    //Redirection vers admin.php
        $_SESSION['admin']  = 1;
        $_SESSION['donnee'] = $donnee;
        header('Location: Admin.php');
        break;

    case '0'        :    //Redirection vers index.php
        $_SESSION['admin']  = 0;
        $_SESSION['donnee'] = $donnee;
        header('Location: Internaute.php');
        break;

    default            :    //Redirection vers index.php
        header('Location: Index.php?inscription=3');
        break;
}
?>