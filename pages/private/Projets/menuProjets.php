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
    header("Location: ../../admin/panel.php");
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

<div class="container mt-5 text-center">
    <h3 class="">Mes Projets</h3>
    <div class="d-flex justify-content-center">
        <form action="" method="post">
            <button class="btn btn-outline-danger mx-2" name="btn-back">Retour</button>
        </form>
        <a class="btn btn-outline-secondary" href="addProjets.php">Ajoutez un projets</a>
    </div>
    <hr>
    <div class="text-center">
        <div class="d-flex justify-content-center flex-wrap">
            <?php
            foreach($listing as $afficheProjets){
                ?>
                <div class="col-6 mt-3">
                    <div class="card bg-secondary text-light mx-3">
                        <div class="card-body">
                            <!--<img src="" alt="">-->
                            <div class="">
                                <p class="mx-2"><strong>Nom : </strong> <?= $afficheProjets['nom_projet']?></p>
                                <p class="mx-2"><strong>Site : </strong> <a href="<?= $afficheProjets['url_projet']?>" target="_blank"><?= $afficheProjets['url_projet']?></a></p>
                                <p class="mx-2"><strong>Code : </strong> <a href="<?= $afficheProjets['url_projet_code']?>" target="_blank"><?= $afficheProjets['url_projet_code']?></a></p>
                            </div>
                            <form class="card-footer" method="get">
                                <a href="editProjets.php?id_projects=<?= $afficheProjets['id_projet']?>" class="btn btn-outline-warning">Modifier</a>
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