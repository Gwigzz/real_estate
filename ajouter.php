<?php

require_once './src/autoload.php';
require_once 'fonctions.php';

$adManager = new AdvertManager();

if (isset($_POST['submit'])) {

	echo '<pre>';
	var_dump($_POST);
	echo '</pre>';

	$advertEntity = new AdvertEntity(
		[
			'title' => $_POST['title'],
			'description' => $_POST['description'],
			'postcode' => $_POST['postcode'],
			'city' => $_POST['city'],
			'category_id' => $_POST['category'],
			'price' => $_POST['price'],
		]
	);


	if ($adManager->addAdvert($advertEntity) > 0) {
		echo 'article ajouté';
	} else {
		echo 'erreur';
	}
}

// Header
require_once './templates/header.php'; ?>

<h1>Nouvelle annonce</h1>

<div class="container-fluid">

	<form method="post" class="mt-5" novalidate>
		<div class="form-group">
			<label>Titre</label>
			<input type="text" class="form-control" name="title">
		</div>
		<div class="form-group">
			<label>Description</label>
			<input type="text" class="form-control" name="description">
		</div>
		<div class="form-group">
			<label>Code postal</label>
			<input type="text" class="form-control" name="postcode"></textarea>
		</div>
		<div class="form-group">
			<label>Ville</label>
			<input type="text" class="form-control" name="city"></textarea>
		</div>
		<div class="form-group">
			<label>Type</label>
			<select name="category" class="custom-select">
				<?php foreach ($adManager->showCategoryList() as $cat) : ?>
					<option value="<?= $cat['id_category'] ?>"><?= $cat['value'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group">
			<label>Prix</label>
			<div class="input-group">
				<input type="text" class="form-control" name="price">
				<div class="input-group-append">
					<div class="input-group-text">€</div>
				</div>
			</div>
		</div>

		<a href="index.php" class="btn btn-outline-secondary">Annuler</a>
		<input type="submit" class="btn btn-primary" name="submit" value="Valider">
	</form>
</div>
</body>

</html>