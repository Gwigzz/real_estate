<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

require_once './src/autoload.php';
require_once './db/bdd.php';

require('fonctions.php');


$adManager = new AdvertManager($bdd);

// Récupère l'advert en cours
$ad = $adManager->getAdvertById($_GET['id']);

// Récupère les categories
$categories = $adManager->getAllCategories();

var_dump($categories);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Modifier une annonce</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
	<div class="container p-5">
		<h1>Modifier une annonce</h1>

		<div class="container-fluid">
			<!-- Ici on traite les messages de retour des différentes exécution en vérifiant si un message est présent en Session
			et si oui en l'affichant puis en l'effaçant de la session. -->
			<div class="row text-center">
				<div class="col-6 mx-auto">
					<?php
					if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
						echo ('<div id="message" class="alert alert-success" role="alert">' . $_SESSION['message'] . '</div>');
						unset($_SESSION['message']);
						// session_destroy();
					}
					?>
				</div>
			</div>


			<?php

			// Si le bouton "Valider" est cliqué, on commence l'insertion en BDD
			if (isset($_POST['submit'])) {
				// on convertit les possibles caractères spéciaux en entités html
				/* $POST['title'] = htmlspecialchars($_POST['title']);
				$POST['description'] = htmlspecialchars($_POST['description']);
				$POST['postcode'] = htmlspecialchars($_POST['postcode']);
				$POST['city'] = htmlspecialchars($_POST['city']);
				$POST['price'] = htmlspecialchars($_POST['price']);
				$POST['category'] = htmlspecialchars($_POST['category']); */

				// Contient les différents "name" des inputs du formulaire à vérifier (hormis l'image)
				$champs = ['title', 'description', 'postcode', 'city', 'price', 'category'];

				// Vérifie que tous les champs sont bien remplis
				// if (isNotEmpty($_POST, $champs) && !empty($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
				if (isNotEmpty($_POST, $champs)) {
					/*				
					// Vérifie les caractéristiques de l'image
					$extension = verifPicture($_FILES['photo']);
					if ($extension) {
*/
					// Insertion en BDD avec récupération de l'ID
					$lastId = $adManager->updateAdvertFromArray($_POST);
					/*
						// Upload de l'image
						$nom_image = uploadImage($_FILES['photo'], $lastId, $extension);

						// Met à jour le nom de l'image en BDD
						updateLogementById($lastId, $_POST, $nom_image);

						echo '<div class="alert alert-success" role="alert">Logement bien enregistré !</div>';
					}
					else {
						echo '<div class="alert alert-danger" role="alert">Image invalide !</div>';
					}
*/
				} else {
					echo '<div class="alert alert-danger" role="alert">Tous les champs sont obligatoires !</div>';
				}
			}

			?>

			<form method="post" class="mt-5" enctype="multipart/form-data" novalidate>
				<input type="hidden" class="form-control" name="id" value="<?php echo $_GET['id']; ?>">
				<div class="form-group">
					<label>Titre</label>
					<input type="text" class="form-control" name="title" value="<?php echo $ad['title']; ?>">
				</div>
				<div class="form-group">
					<label>Description</label>
					<input type="text" class="form-control" name="description" value="<?php echo $ad['description']; ?>">
				</div>
				<div class="form-group">
					<label>Code postal</label>
					<input type="number" class="form-control" name="postcode" value="<?php echo $ad['postcode']; ?>" />
				</div>
				<div class="form-group">
					<label>Ville</label>
					<input type="text" class="form-control" name="city" value="<?php echo $ad['city']; ?>" />
				</div>
				<div class="form-group">
					<label>Type</label>
					<select name="category" class="custom-select">
						<?php foreach ($categories as $cat) : ?>
							<option value="<?php echo $cat['category_id'] ?>" <?php if ($cat['category'] === $ad['category']) {
																					echo 'selected';
																				} ?>><?php echo $cat['category'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label>Prix</label>
					<div class="input-group">
						<input type="number" step="10" class="form-control" name="price" value="<?php echo $ad['price']; ?>" />
						<div class="input-group-append">
							<div class="input-group-text">€</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<input type="hidden" class="form-control" name="reservation_message" value="disponible" />
				</div>
				<!--				<div class="form-group">
					<label>Photo</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="photo">
						<label class="custom-file-label">Choisir une photo</label>
					</div>
				</div>
						-->
				<a href="index.php" class="btn btn-outline-secondary">Annuler</a>
				<input type="submit" class="btn btn-primary" name="submit" value="Modifier">
			</form>
		</div>
</body>

</html>