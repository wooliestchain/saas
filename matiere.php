<?php

if (isset($_SESSION['username'])) {
    header('Location:user_log.php');
    exit();
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/matr.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
    <title>Document</title>
</head>
<body>
<?php
include_once ("header.php");
?>
<main>
    <form action="#" method="post">
        <h1><span class="material-icons-outlined">add_circle_outline</span> Ajouter une matière</h1>
        <label for="">Entrer le code de la matière: </label><br> <input type="text" placeholder="Entrer le code de la matière" name="sujet"><br>
        <label for="">Entrer une déscritpion: </label><br> <textarea placeholder="Descritpions de la matière" name="descr"></textarea><br>
        <input type="submit" value="Enregistrer" name="enregistrer"><br>

    <?php
    if (isset($_POST['enregistrer'])){
        if(isset($_POST['sujet']) && isset($_POST['descr'])){
            $host = "localhost";
            $user = "root";
            $mdp = "";
            $dv = "saas";

            $conn = mysqli_connect($host, $user, $mdp, $dv);

            $sujet = $_POST['sujet'];
            $descr = $_POST['descr'];

            $req = "INSERT INTO sujet (sujet_code, sujet_descr) VALUES ('$sujet', '$descr')";
            $rsult = mysqli_query($conn,$req);
            if ($rsult) {
                echo "<span class='material-icons-outlined'>done_all</span> New record created successfully";
            } else {
                echo "Error: " . $req . "<br>" . $conn->error;
            }
        }else{
            echo "Veuillez remplir tous les champs";
        }
    }
    ?>
    </form>
</main>
<?php
include_once ("matiere_pag.php");
?>
</body>
</html>
