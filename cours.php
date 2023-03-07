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
    <link rel="stylesheet" href="style/multi.css">
    <title>Document</title>
</head>
<body>
<?php
include_once ("header.php");
?>
<main>
    <form action="#" method="post">
        <h1><span class="material-icons-outlined">add_circle_outline</span> Ajouter un cours</h1>
        <label for="">Entrer le code du cours: </label><br> <input type="text" placeholder="Code du cours" name="sujet"><br>
        <label for="">Entrer le nom du cours: </label><br> <input type="text" placeholder="Nom du cours" name="descr"><br>
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

                $req = "INSERT INTO cours (cours_code, cours_nom) VALUES ('$sujet', '$descr')";
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
include_once ("cours_pag.php")
?>
</body>
</html>