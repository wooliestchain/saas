<?php
//connexion à la base de données
$nom_serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "emma";
$nom_base_données = "saas";
$con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);
//récuperation de l'id dans le lien
$id = $_GET['id'];
//requete de suppresion
$req = mysqli_query($con, "DELETE FROM cours WHERE cours_id = $id");
//redirection vers la page index.php
header("Location:cours.php");
