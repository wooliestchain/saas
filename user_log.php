<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style/user_log.css">
</head>
<body>
<main>
    <form action="#" method="post">
        <label for="username">Entrer votre nom d'utilisateur: </label><br>
        <input type="text" name="username" placeholder="Entrer votre nom d'utilisateur" autocomplete="off"><br>
        <label for="password">Entrer votre mot de passe: </label><br>
        <input type="password" name="password"  placeholder="Entrer votre mot de passe" autocomplete="off" ><br>
        <input type="submit" value="S'inscire" name="valider"><br>
        <h2>Pas encore inscrit?<a style="text-decoration: none" href="user-sign.php">Faites le ici</a></h2>

        <?php
        if (isset($_POST['valider'])) { // Si on clique sur le boutton , alors :
            //Nous allons verifiér les informations du formulaire
            if (isset($_POST['username']) && isset($_POST['password'])) { //On verifie ici si l'utilisateur a rentré des informations
                //Nous allons mettres l'email et le mot de passe dans des variables
                $username = $_POST['username'];
                $mdp = $_POST['password'];
                $erreur = "";
                //Nous allons verifier si les informations entrée sont correctes
                //Connexion a la base de données
                $nom_serveur = "localhost";
                $utilisateur = "root";
                $mot_de_passe = "";
                $nom_base_données = "saas";
                $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_données);
                //requete pour selectionner  l'utilisateur qui a pour email et mot de passe les identifiants qui ont été entrées
                $req = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' AND mdp ='$mdp' AND token IS NOT  NULL");
                $num_ligne = mysqli_num_rows($req);//Compter le nombre de ligne ayant rapport a la requette SQL
                if ($num_ligne > 0) {
                    header("Location:some.php");//Si le nombre de ligne est > 0 , on sera redirigé vers la page bienvenu
                    // Nous allons créer une variable de type session qui vas contenir l'email de l'utilisateur
                    $_SESSION['username'] = $username;
                } else {//si non
                    echo "<span>Vous n'êtes pas autorisé à accéder à l'application</span>";
                }
            }
        }

        ?>
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