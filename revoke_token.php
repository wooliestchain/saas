<?php

$token = NULL;
$username = $_GET['username'];
$id = $_GET['id'];
$mail = $_GET['email'];
$nom_serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "emma";
$nom_base_données = "saas";
$con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);
$req ="UPDATE user SET token = NULL WHERE username = '$username';";
$res = mysqli_query($con,$req);
if ($res) {
    $subjet = "Accés à l'application";
    $mess = "Bonjour monsieur/madame , nous vous informons que l'accés à l'application vous a été bloqué, \nveuillez vous acquiter de votre paiement pour y avoir à nouveau accès";
    $from = "levyren38@gmail.com";
    $to = $mail;
    mail($to,$subjet,$mess);
    header("location:valid_token.php");
} else {//si non
    $erreur = "ECHEC!!!!!!";
}