<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style/user_auth.css">
</head>
<body>
<main>
    <form action="#" method="post">
        <label for="name">Entrer votre nom: </label><br>
        <input type="text" name="name" placeholder="Entrer votre nom" autocomplete="off"><br>
        <label for="prename">Entrer votre prenom: </label><br>
        <input type="text" name="prename" placeholder="Entrer votre prénom" autocomplete="off"><br>
        <label for="username">Entrer votre nom d'utilisateur: </label><br>
        <input type="text" name="username" placeholder="Entrer votre pseudo" autocomplete="off"><br>
        <label for="email">Entrer votre adress mail: </label><br>
        <input type="email" name="email" placeholder="Entrer votre adresse mail" autocomplete="off"><br>
        <label for="password">Entrer votre mot de passe: </label><br>
        <input type="password" name="password" minlength="5" placeholder="Entrer votre mot de passe" autocomplete="off" ><br>

        <?php
        if (isset($_POST['valider'])) {
            if (isset($_POST['name']) && isset($_POST['prename']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $pass = $_POST['password'];
                $name = $_POST['name'];
                $prename = $_POST['prename'];
                $username = $_POST['username'];
                $token = bin2hex(openssl_random_pseudo_bytes(16));

                $nom_serveur = "localhost";
                $utilisateur = "root";
                $mot_de_passe = "emma";
                $nom_base_données = "saas";
                $dsn = "mysql:host=$nom_serveur;dbname=$nom_base_données;charset=utf8mb4";

                try {
                    $pdo = new PDO($dsn, $utilisateur, $mot_de_passe);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $pdo->prepare("INSERT INTO user (nom_user, prenom_user, username, email, mdp, token) VALUES (:name, :prename, :username,:email, :pass, :token)");
                    $stmt->execute(array(  'name' => $name, 'prename' => $prename, 'username' => $username,':email' => $email, ':pass' => $pass, ':token' => $token));
                    $count = $stmt->rowCount();
                    if ($count > 0) {
                        header("location:some.php");
                        $_SESSION['email'] = $email;
                    } else {
                        $erreur = "ECHEC!!!!!!";
                    }
                } catch(PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            }
        }
        ?>

        <input type="submit" value="S'inscire" name="valider"><br>
        <h4>Déja inscrit ? <a href="user_log.php">Connectez-vous ici</a></h4>
        <?php
        /*
        if(isset($_POST['valider'])){
            if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])){
                $email = $_POST['email'];
                $pass = $_POST ['password'];
                $con_pass = $_POST['confirm_password'];
                if($pass == $con_pass) {


                    $nom_serveur = "localhost";
                    $utilisateur = "root";
                    $mot_de_passe = "";
                    $nom_base_données = "saas";
                    $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);
                    $req ="INSERT INTO admin (admin_email, admin_mdp) VALUES ($email, $pass)";
                    $res = mysqli_query($con,$req);
                    if ($res) {
                        header("location:admin_manage.php");
                        $_SESSION['email'] = $email;
                    } else {//si non
                        $erreur = "ECHEC!!!!!!";
                    }
                }else{
                    echo "Les mots de passes ne correspondent pas";
                }

            }
        }
*/
        ?>
    </form>
</main>
</body>
<script>
    function checkPassword() {
        var password = document.getElementById("password");
        var confirm_password = document.getElementById("confirm_password");

        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Les mots de passe ne correspondent pas");
        } else {
            confirm_password.setCustomValidity('');
        }
    }
</script>
</html>