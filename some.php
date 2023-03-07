<?php
session_start();
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
    <link rel="stylesheet" href="style/home.css">
    <title>Document</title>
</head>
<body>
<?php
include_once ("header.php");
?>
<main>
    <section>
        <div class="main_text">
            <h1>Bonjour "Utilisateur", Vous pouvez mettre a jour votre emploi du temps ici.</h1>
        </div>
        <form action="#" method="post">
<?php
// Connexion à la base de données MySQL
$host = 'localhost';
$user = 'root';
$mdp = '';
$dbname = 'saas';

$conn = new mysqli($host, $user, $mdp, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Sélectionner les données de la table dans la base de données
$sql = "SELECT sujet_id, sujet_descr FROM sujet";
$resultat = $conn->query($sql);

// Générer les options de balise select avec les données de la table
if ($resultat->num_rows > 0) {
    echo "<label>Selectionner une matière:</label> <br> <select name='matiere'>";
    while ($row = $resultat->fetch_assoc()) {
        echo " <option>" . $row['sujet_descr'] . "</option><br>";
    }
    echo "</select>";
} else {
    echo "Aucune donnée trouvée dans la table.";
}

// Sélectionner les données de la table dans la base de données
$sql = "SELECT faculte_id, faculte_nom FROM faculte";
$resultat = $conn->query($sql);

// Générer les options de balise select avec les données de la table
if ($resultat->num_rows > 0) {
    echo "<br><label>Selectionner une faculté:</label> <br> <select name='faculte'>";
    while ($row = $resultat->fetch_assoc()) {
        echo " <option>" . $row['faculte_nom'] . "</option>";
    }
    echo "</select>";
} else {
    echo "Aucune donnée trouvée dans la table.";
}

// Sélectionner les données de la table dans la base de données
$sql = "SELECT cours_id, cours_nom FROM cours";
$resultat = $conn->query($sql);

// Générer les options de balise select avec les données de la table
if ($resultat->num_rows > 0) {
    echo "<br><label>Selectionner un cours:</label> <br> <select name='cours'>";
    while ($row = $resultat->fetch_assoc()) {
        echo " <option>" . $row['cours_nom'] . "</option>";
    }
    echo "</select><br>";
} else {
    echo "Aucune donnée trouvée dans la table.";
}

// Sélectionner les données de la table dans la base de données
$sql = "SELECT salle_id, salle_nom FROM salle";
$resultat = $conn->query($sql);

// Générer les options de balise select avec les données de la table
if ($resultat->num_rows > 0) {
    echo "<br><label>Selectionner une salle:</label> <br> <select class='selections' name='salle'>";
    while ($row = $resultat->fetch_assoc()) {
        echo " <option>" . $row['salle_nom'] . "</option>";
    }
    echo "</select><br>";
} else {
    echo "Aucune donnée trouvée dans la table. <br>";
}

// Fermer la connexion à la base de données
$conn->close();
?>
            <label>Heure de départ:</label> <br> <input type="text" placeholder="Heure de dénut" name="h_debut"><br>
            <label>Heure de fin:</label> <br> <input type="text" placeholder="Heure de fin" name="h_fin"><br>
            <br><input type="submit" value="Valider" name="valider">
        </form>
        <?php
        if (isset($_POST['valider'])) { // Si on clique sur le boutton , alors :
            //Nous allons verifiér les informations du formulaire
            if (isset($_POST['matiere']) && isset($_POST['faculte']) && isset($_POST['cours']) && isset($_POST['salle']) && isset($_POST['h_debut']) && isset($_POST['h_fin'])) { //On verifie ici si l'utilisateur a rentré des informations
                $conn = new mysqli($host, $user, $mdp, $dbname);

                // Vérifier la connexion
                if ($conn->connect_error) {
                    die("La connexion a échoué : " . $conn->connect_error);
                }

                $matiere = $_POST["matiere"];
                $faculte = $_POST["faculte"];
                $cours = $_POST["cours"];
                $salle = $_POST["salle"];
                $h_debut = $_POST["h_debut"];
                $h_fin = $_POST["h_fin"];

                $addTim = "INSERT INTO add_table (faculte, cours, sujet, salle, heure_debut, heure_fin) VALUES ('$faculte', '$cours', '$matiere', '$salle', '$h_debut', '$h_fin')";
                if ($conn->query($addTim) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $addTim . "<br>" . $conn->error;
                }

                // fermeture de la connexion à la base de données
                $conn->close();
            }
        }
        ?>
    </section>
</main>
<?php
include_once ("sall_pag.php");
?>
</body>
</html>
