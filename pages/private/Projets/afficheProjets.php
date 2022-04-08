<?php
session_start();

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

$sqlSelect = "SELECT * FROM `projets`";
$listing = $bdd_name->query($sqlSelect);

function back(){
    header("Location: ../../index.php");
}

if(isset($_POST['btn-back'])){
    back();
}
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
    <title>Portfolio - Connexion</title>
</head>
<body class="bg-dark">

<div class="container text-center">
    <h2 class="pt-2 text-light">Mes Projets</h2>
    <div class="d-flex justify-content-center">
        <form action="" method="post">
            <!--<button class="btn btn-outline-danger mx-2" name="btn-back">Retour</button>-->
        </form>
    </div>
    <div class="text-center pb-5">
        <div class="d-flex justify-content-center flex-wrap">
            <?php
            foreach($listing as $afficheProjets){
                ?>
                <div class="col-3 mt-3">
                    <div class="card bg-secondary text-light mx-3 border border-light">
                        <div class="card-body">
                            <!--<img src="" alt="">-->
                            <div class="">
                                <p class="mx-2"><strong>Nom : </strong> <?= $afficheProjets['nom_projet']?></p>
                                <!--<p class="mx-2"><strong>Lien : </strong> <a href="<?= $afficheProjets['url_projet']?>" target="_blank"><?= $afficheProjets['url_projet']?></a></p>-->
                            </div>
                            <form class="" method="get">
                                <a class="btn btn-outline-light" href="<?= $afficheProjets['url_projet']?>" target="_blank">Visiter</a>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
    
</body>
</html>