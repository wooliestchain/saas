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
    <title>Document</title>
    <link rel="stylesheet" href="style/magi.css">
</head>
<body>
<?php
include_once ("header.php")
?>
<section style="height: 400px">
    <h1 style="text-align: center; color: #7e7b7b">Votre Programme</h1>
    <?php
    // Connexion à la base de données et requête pour récupérer les éléments
    $pdo = new PDO('mysql:host=localhost;dbname=saas', 'root', 'emma');
    $requete = $pdo->query('SELECT * FROM add_table');
    $elements = $requete->fetchAll();

    // Nombre d'éléments à afficher par page
    $elements_par_page = 5;

    // Nombre total de pages
    $nombre_pages = ceil(count($elements) / $elements_par_page);

    // Récupérer le numéro de la page courante
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calculer le premier élément à afficher
    $premier_element = ($page - 1) * $elements_par_page;

    // Récupérer les éléments de la page courante
    $elements_page = array_slice($elements, $premier_element, $elements_par_page);
    ?>

    <table style="  height: 250px; margin-right: 100px;  right: 150px">
        <thead>
        <tr style="text-align: center">
            <th>Matière</th>
            <th>Faculté</th>
            <th>Cours</th>
            <th>Salle</th>
            <th>Jour</th>
            <th>Heure de début</th>
            <th>Heure de fin</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($elements_page as $element) : ?>
            <tr>
                <td><?= $element['faculte'] ?></td>
                <td><?= $element['cours'] ?></td>
                <td><?= $element['sujet'] ?></td>
                <td><?= $element['salle'] ?></td>
                <td style="background-color: #f1d7d7"><?= $element['jour'] ?></td>
                <td style="background-color: coral"><?= $element['heure_debut'] ?></td>
                <td style="background-color: chocolate"><?= $element['heure_fin'] ?></td>
                <td><a href="#"><img src="style/images/pen.png" alt=""></a></td>
                <td><a href="del_cal.php?id=<?=$element['id']?>"><img src="style/images/poubelle.png" alt=""></a></td>


            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    // Afficher les liens vers les autres pages
    echo '<div class="page" >';
    for ($i = 1; $i <= $nombre_pages; $i++) {
        if ($i == $page) {
            echo '<span class="curent_pg" >' . $i . '</span>';
        } else {
            echo '<a class="next_pg" href="?page=' . $i . '">' . $i . '</a>';
        }
    }
    echo '</div>';
    ?>

</section>
</body>
</html>