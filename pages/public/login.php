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
    <title>Portfolio - Connexion</title>
</head>
<body class="bg-dark">

<div class="container-fluid" id="">
  <form method="post">
    <div class="text-center text-light mt-5">
      <h4>Connexion</h4>
    </div>
    <div class="container bg-dark text-center pt-2">
        <div class="d-flex">
            <div class="col text-light mx-1">
                <label class="form-label" for="email-register">Adresse-email</label>
                <input class="form-control" type="email" name="email-login" placeholder="Adresse e-mail">
            </div>

            <div class="col text-light mx-1">
                <label class="form-label" for="password-register">Mot de passe</label>
                <input class="form-control" type="password" name="password-login" placeholder="Mot de passe">
            </div>
        </div>

        <div class="d-flex justify-content-center pt-3 pb-3">
            <a href="../../index.php" class="btn btn-danger mx-1">RETOUR</a>
            <button class="btn btn-success mx-1" type="submit" name="btn-login">VALIDER</button>
        </div>
    </div>
  </form>
</div>
    
</body>
</html>


<?php

function login(){

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

    if(isset($_POST['email-login']) && !empty($_POST['email-login']) && isset($_POST['password-login']) && !empty($_POST['password-login'])){
        $email = trim(htmlspecialchars($_POST['email-login']));
        $password = trim(htmlspecialchars($_POST['password-login']));

        $sqlLogin = "SELECT * FROM `utilisateurs` WHERE `email`= ? AND `password`= ?";
        $login = $bdd_name->prepare($sqlLogin);
        $login->bindParam(1, $email);
        $login->bindParam(2, $password);
        $login->execute();

        if($login->rowCount() >=0){
            $select = $login->fetch();

            if($select){
                $emailCheck = $select['email'];
                $passwordCheck = $select['password'];

                if($email === $emailCheck && $password === $passwordCheck){
                    $_SESSION['email'] = $email;
                    header("Location: ../admin/panel.php");
                }else{
                    echo "<div class='mt-3 container'>
                    <p class='alert alert-danger'>Erreur de connextion : Merci de vérifier vos identifiant !</p>
                    </div>";
                }
            }else{
                echo "<div class='mt-3 container'>
                <p class='alert alert-danger p-3'>Erreur de connexion : Aucun utilisateur reconnue !</p>
                </div>"; 
            }
        }else{
            echo "<div class='mt-3 container'>
            <p class='alert alert-danger p-3'>Erreur de connexion : Base de donnée vide !</p>
            </div>";
        }
    }else{
        echo "<div class='mt-3 container'>
        <p class='alert alert-danger p-3'>Erreur de connexion : Merci de remplir les champs !</p>
        </div>";
    }
}

if(isset($_POST['btn-login'])){
    login();
}