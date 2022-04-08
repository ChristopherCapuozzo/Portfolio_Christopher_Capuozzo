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
    <link rel="stylesheet" href="../../../addons/css/style.css">
    <link rel="stylesheet" href="../../../addons/css/bootstrap.css">
    <!--## OTHER ##-->
    <title>PANEL - ADD</title>
</head>
<body class="bg-dark">

<div class="container-fluid" id="false">
  <form method="post">
    <div class="text-center mt-5">
      <h4>Ajoutez mon projet</h4>
    </div>
    <div class="container bg-dark text-center pt-2">
        <div class="d-flex text-light">
            <div class="col mx-2">
                <label class="form-label" for="nom-projet">Nom</label>
                <input class="form-control" type="text" name="nom-projet" placeholder="Nom du projet">
            </div>
        </div>
        <div class="d-flex text-light">
            <div class="col mx-2">
                <label class="form-label" for="url-projet">Lien du site</label>
                <input class="form-control" type="text" name="url-projet" placeholder="Url du projet">
            </div>
        </div>
        <div class="d-flex text-light">
            <div class="col mx-2">
                <label class="form-label" for="url-projet">Lien du code</label>
                <input class="form-control" type="text" name="url-projet-code" placeholder="Code du projet">
            </div>
        </div>

        <div class="d-flex justify-content-center pt-3 pb-3">
            <a href="menuProjets.php" class="btn btn-danger mx-1">RETOUR</a>
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

if(isset($_POST['nom-projet']) && !empty($_POST['nom-projet']) && isset($_POST['url-projet']) && !empty($_POST['url-projet']) && isset($_POST['url-projet-code']) && !empty($_POST['url-projet-code'])){
    $nomProjet = trim(htmlspecialchars($_POST['nom-projet']));
    $urlProjet = trim(htmlspecialchars($_POST['url-projet']));
    $urlProjetCode = trim(htmlspecialchars($_POST['url-projet-code']));

    if($urlProjet === $urlProjet){
        $sqlRegister = "INSERT INTO `projets` (`nom_projet`, `url_projet`, `url_projet_code`) VALUES (?,?,?)";
        $inserProjet = $bdd_name->prepare($sqlRegister);

        $inserProjet->bindParam(1, $nomProjet);
        $inserProjet->bindParam(2, $urlProjet);
        $inserProjet->bindParam(3, $urlProjetCode);

        $inserProjet->execute(array(
            $nomProjet,
            $urlProjet,
            $urlProjetCode
        ));

        if($inserProjet == true){
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
            header("Location: menuProjets.php");
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
