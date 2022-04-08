<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--## META ##-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--## LINK ##-->
    <link rel="stylesheet" href="../../addons/css/style.css">
    <link rel="stylesheet" href="../../addons/css/bootstrap.css">
    <!--## OTHER ##-->
    <title>Portfolio - Inscription</title>
</head>
<body class="bg-dark">

<div class="container-fluid" id="false">
  <form method="post">
    <div class="text-center mt-5">
      <h4>Inscription</h4>
    </div>
    <div class="container bg-dark text-center pt-2">
        <div class="d-flex text-light">
            <div class="col mx-2">
                <label class="form-label" for="nom-register">Nom</label>
                <input class="form-control" type="text" name="nom-register" placeholder="Nom">
            </div>

            <div class="col mx-2">
                <label class="form-label" for="prenom-register">Prénom</label>
                <input class="form-control" type="text" name="prenom-register" placeholder="Prénom">
            </div>
        </div>

        <div class="text-light mx-2">
            <label class="form-label pt-1" for="email-register">Adresse-email</label>
            <input class="form-control" type="email" name="email-register" placeholder="Adresse e-mail">
        </div>

        <div class="pt-2 text-light">
            <label class="form-label" for="password-register">Mot de passe</label>
            <div class="d-flex">
                <div class="col mx-2">
                    <input class="form-control" type="password" name="password-register" placeholder="Mot de passe">
                </div>
                <div class="col mx-2">
                    <input class="form-control" type="password" name="password-confirm" placeholder="Mot de passe">
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center text-light pt-2">
            <div class="col mx-2">
                <label class="form-label" for="">Date de naissance</label>
                <input class="form-control" name="date-naissance" type="date">
            </div>
        </div>

        <div class="d-flex justify-content-center pt-3 pb-3">
            <a href="../../index.php" class="btn btn-danger mx-1">RETOUR</a>
            <button class="btn btn-success" type="submit" name="btn-register">VALIDER</button>
        </div>
    </div>
  </form>
</div>
    
</body>
</html>


<?php

$user_phpadmin = "root";
$mdp_phpadmin = "";
$dbname = "portfolio";
$host = "localhost";

try{
    $bdd_name = new PDO("mysql:host=".$host.";dbname=".$dbname.";charset=UTF8", $user_phpadmin, $mdp_phpadmin);
    $bdd_name->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $exception){
    echo "Erreur de connexion a PDO MySQL " . $exception->getMessage();
    die();
}

if(isset($_POST['nom-register']) && !empty($_POST['nom-register']) && isset($_POST['prenom-register']) && !empty($_POST['prenom-register']) && isset($_POST['email-register']) && !empty($_POST['email-register']) && isset($_POST['password-register']) && !empty($_POST['password-register']) && isset($_POST['date-naissance']) && !empty($_POST['date-naissance'])){
    $nomRegister = trim(htmlspecialchars($_POST['nom-register']));
    $prenomRegister = trim(htmlspecialchars($_POST['prenom-register']));
    $emailRegister = trim(htmlspecialchars($_POST['email-register']));
    $passwordRegister = trim(htmlspecialchars($_POST['password-register']));
    $passwordConfirm = trim(htmlspecialchars($_POST['password-confirm']));
    $dateNaissance = $_POST['date-naissance'];

    if($passwordRegister === $passwordConfirm){
        $sqlRegister = "INSERT INTO `utilisateurs` (`nom`, `prenom`, `email`, `password`, `date-naissance`) VALUES (?,?,?,?,?)";
        $insertUser = $bdd_name->prepare($sqlRegister);

        $insertUser->bindParam(1, $nomRegister);
        $insertUser->bindParam(2, $prenomRegister);
        $insertUser->bindParam(3, $emailRegister);
        $insertUser->bindParam(4, $passwordRegister);
        $insertUser->bindParam(5, $dateNaissance);

        $insertUser->execute(array(
            $nomRegister,
            $prenomRegister,
            $emailRegister,
            $passwordRegister,
            $dateNaissance
        ));

        if($insertUser == true){
            ?>
            <div class="container">
                <p class="alert alert-success mt-3"> Votre compte à bien été crée !</p>
            </div>
            <style>
                #false{
                    display: none;
                }
            </style>
            <?php
            header("Location: ../../index.php");
        }else{
            ?>
            <div class="container">
                <p class="alert alert-danger mt-3"> Erreur : L'inscription à échoué !</p>
            </div>
            <?php
        }
    }else{
        ?>
        <div class="container">
            <p class="alert alert-danger mt-3"> Erreur : Les 2 mots de passe ne sont pas identique</p>
        </div>
        <?php
    }
}else{
    ?>
    <div class="container">
        <p class="alert alert-danger mt-3"> Erreur : Merci de remplir tout les champs !</p>
    </div>
    <?php
}
