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
    <title>Portfolio - Panel</title>
</head>
<body class="bg-dark">

    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
      <div class="container-fluid">
        <!--<a class="navbar-brand" href="#">Accueil</a>-->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item d-flex">
                    <a class="nav-link" aria-current="page" href="../private/Projets/menuProjets.php">Mes Projets</a>
                    <a class="nav-link" aria-current="page" href="#">? ? ?</a>
                    <a class="nav-link" aria-current="page" href="#">? ? ?</a>
                    <a class="nav-link disabled" aria-current="page" href="#"><?= $_SESSION['email']?></a>
                </li>
            </ul>
        </div>
        <form method="post" class="d-flex">
            <button class="btn btn-outline-danger" name="btn-unlog" type="submit">Deconnexion</button>
        </form>
      </div>
    </nav>
    
</body>
</html>

<?php

function un_log(){
    session_unset();
    session_destroy();
    header("Location: ../../index.php");
}


if(isset($_POST['btn-unlog'])){
  un_log();
}