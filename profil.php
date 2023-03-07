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
    <link rel="stylesheet" href="style/home.css">
    <title>Document</title>
</head>
<body>
<?php
include_once ("header.php");
?>
<main>
    <section>
        <?php
        // Paramètres de connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "saas";

        $user =$_SESSION['username'];

        // Connexion à la base de données
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Requête SQL pour récupérer le contenu de la table "ma_table"
        $sql = "SELECT id, nom_user, prenom_user, username, email FROM user WHERE username = '$username'
";
        $result = $conn->query($sql);

        // Vérification du résultat de la requête
        if ($result->num_rows > 0) {
            // Affichage d'un formulaire avec un champ input de type texte pour chaque enregistrement
            while($row = $result->fetch_assoc()) {
                echo "<form>";
                echo "<input type='text' value='" . $row["nom_user"] . "'>";
                echo "</form>";
            }
        } else {
            echo "Aucun résultat trouvé.";
        }

        // Fermeture de la connexion à la base de données
        $conn->close();
        ?>

    </section>
</main>

</body>
</html>
