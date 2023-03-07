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
        <h1><span class="material-icons-outlined">add_circle_outline</span> Ajouter une faculté</h1>
        <label for="">Entrer le nom de la faculté: </label><br> <input type="text" placeholder="Nom de la faculté" name="sujet"><br>
        <label for="">Entrer la localisation: </label><br> <input type="text" placeholder="Emplacement de la faculté" name="descr"><br>
        <input type="submit" value="Enregistrer" name="enregistrer"><br>

        <?php
        if (isset($_POST['enregistrer'])){
            if(isset($_POST['sujet']) && isset($_POST['descr'])){
                $host = "localhost";
                $user = "root";
                $mdp = "emma";
                $dv = "saas";

                $conn = mysqli_connect($host, $user, $mdp, $dv);

                $sujet = $_POST['sujet'];
                $descr = $_POST['descr'];

                $req = "INSERT INTO faculte (faculte_nom, faculte_local) VALUES ('$sujet', '$descr')";
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
include_once ("faculte_pag.php")
?>
<?php
include_once ("footer.php")
?>
</body>
</html>