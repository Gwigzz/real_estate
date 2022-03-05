<?php

require_once './db/bdd.php';

require_once './src/autoload.php';

$advertManager = new AdvertManager($bdd);

// Récupération des information d'une annonce
$advert = $advertManager->getAdvertById($_GET['id']);

//var_dump($advert);  

// Si l'annonce n'existe pas, redirection vers la liste des magazines
if (!$advert) {
    header('Location: index.php');
}

?>  
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Détails d'un logement</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="container p-5">
	<h1><?php echo $advert['title'] ?></h1>

    <a href="index.php" class="btn btn-secondary mt-2">Retour à la liste</a>

	<div class="row mt-5">
 <!--       <div class="col-2">
            <img src="images/
            <?php
            //echo $advert->getPicture(); ?>" alt="<?php //echo $advert->getTitleAd() ?>" class="img-fluid">
        </div>
-->
        <div class="col-10">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Code postal</th>
                        <th>ville</th>
                        <th>Prix</th>
                        <th>Categorie</th>
                        <th>Réservation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $advert['title']; ?></td>
                        <td><?php echo $advert['description'];  ?></td>
                        <td><?php echo $advert['postcode']; ?></td> 
                        <td><?php echo $advert['city']; ?></td>
                        <td><?php echo $advert['price']; ?> €</td>
                        <td><?php echo $advert['category']; ?></td>
                        <td><?php echo $advert['reservation_message']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
