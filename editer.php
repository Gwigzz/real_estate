<?php
// Autoload
require_once './src/autoload.php';

// Functions
require('fonctions.php');

$adManager = new AdvertManager();

// Récupère l'advert en cours
$ad = $adManager->getAdvertById($_GET['id']);

$categories = $adManager->showCategoryList();

// Header
require_once './templates/header.php';
?>

<h1>Modifier une annonce</h1>

<div class="container-fluid">

	<?php
	// Si le bouton "Valider" est cliqué, on commence l'insertion en BDD
	if (isset($_POST['submit'])) {


		// Contient les différents "name" des inputs du formulaire à vérifier (hormis l'image)
		$champs = ['title', 'description', 'postcode', 'city', 'price', 'category'];

		// Vérifie que tous les champs sont bien remplis
		if (isNotEmpty($_POST, $champs)) {

			// Insertion en BDD avec récupération de l'ID
			$lastId = $adManager->updateAdvertFromArray($_POST);
		} else {
			echo '<div class="alert alert-danger" role="alert">Tous les champs sont obligatoires !</div>';
		}
	} ?>

	<form method="post" class="mt-5" enctype="multipart/form-data" novalidate>
		<input type="hidden" class="form-control" name="id" value="<?= $_GET['id']; ?>">
		<div class="form-group">
			<label>Titre</label>
			<input type="text" class="form-control" name="title" value="<?= $ad['title']; ?>">
		</div>
		<div class="form-group">
			<label>Description</label>
			<input type="text" class="form-control" name="description" value="<?= $ad['description']; ?>">
		</div>
		<div class="form-group">
			<label>Code postal</label>
			<input type="number" class="form-control" name="postcode" value="<?= $ad['postcode']; ?>" />
		</div>
		<div class="form-group">
			<label>Ville</label>
			<input type="text" class="form-control" name="city" value="<?= $ad['city']; ?>" />
		</div>
		<div class="form-group">
			<label>Type</label>
			<?php echo $ad['value'] ?>

			<select name="category" class="custom-select">
				<option value="<?= $ad['category_id'] ?>"><?= $ad['category'] ?></option>
				<?php foreach ($categories as $cat) : ?>
					<option value="<?= $cat['id_category'] ?>">
						<?= $cat['value'] ?>
					</option>
				<?php endforeach; ?>

			</select>
		</div>
		<div class="form-group">
			<label>Prix</label>
			<div class="input-group">
				<input type="number" step="10" class="form-control" name="price" value="<?= $ad['price']; ?>" />
				<div class="input-group-append">
					<div class="input-group-text">€</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<input type="hidden" class="form-control" name="reservation_message" value="disponible" />
		</div>

		<a href="index.php" class="btn btn-outline-secondary">Annuler</a>
		<input type="submit" class="btn btn-primary" name="submit" value="Modifier">
	</form>
</div>
</body>

</html>