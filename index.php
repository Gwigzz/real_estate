<?php

require_once './src/autoload.php';

//  Manager
$advertManager = new AdvertManager();

// Récupération de toutes les annonces
$ads = $advertManager->getLastAdverts();

// Header
require_once './templates/header.php';
?>
<h1>Bienvenue sur annonces.com</h1>

<a href="ajouter.php" class="btn btn-primary mt-2">Ajouter une annonce</a>
<a href="liste.php" class="btn btn-secondary mt-2">Toutes nos annonces</a>

<?php
// Suppression d'une annonce
// Vérifie si un id est envoyé et si une variable $type est bien envoyée
if (!empty($_GET['id']) && !empty($_GET['type']) && $_GET['type'] === 'supprimer') {
    // Suppression d'une annonce en BDD
    $advertManager->deleteAdvertById($_GET['id']);
}
?>

<table class="table table-striped mt-5">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Code postal</th>
            <th>ville</th>
            <th>Catégorie</th>
            <th>Prix</th>
            <th>Date de création</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($ads as $ad) : ?>
            <tr>
                <td><?= mb_strtoupper($ad['title']); ?></td>
                <td><?= ucfirst(substr($ad['description'], 0, 10) . "..."); ?></td>
                <td><?= $ad['postcode']; ?></td>
                <td><?= $ad['city']; ?></td>
                <td><?= $ad['category']; ?></td>
                <td><?= $ad['price']; ?> €</td>
                <td><?= $ad['created_at']; ?></td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
</div>
</body>

</html>