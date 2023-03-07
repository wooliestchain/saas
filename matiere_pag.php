<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<section>
    <?php
    // Connexion à la base de données et requête pour récupérer les éléments
    $pdo = new PDO('mysql:host=localhost;dbname=saas', 'root', 'emma');
    $requete = $pdo->query('SELECT * FROM sujet');
    $elements = $requete->fetchAll();

    // Nombre d'éléments à afficher par page
    $elements_par_page = 2;

    // Nombre total de pages
    $nombre_pages = ceil(count($elements) / $elements_par_page);

    // Récupérer le numéro de la page courante
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calculer le premier élément à afficher
    $premier_element = ($page - 1) * $elements_par_page;

    // Récupérer les éléments de la page courante
    $elements_page = array_slice($elements, $premier_element, $elements_par_page);
    ?>

    <table>
        <thead>
        <tr>
            <th>Code de la matière</th>
            <th>Description de la matière</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($elements_page as $element) : ?>
            <tr>
                <td><?= $element['sujet_code'] ?></td>
                <td><?= $element['sujet_descr'] ?></td>
                <td><a href="#"><img src="style/images/pen.png" alt=""></a></td>
                <td><a href="matiere_del.php?id=<?=$element['sujet_id']?>"><img src="style/images/poubelle.png" alt=""></a></td>

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