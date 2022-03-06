<?php

require_once './src/autoload.php';

$advertManager = new AdvertManager();

// Récupération de toutes les annonces
$ads = $advertManager->getAllAdverts();

// Header
require_once './templates/header.php';
?>
<h1>Liste de toutes nos annonces</h1>

<div class="container-fluid">
    <!-- Ici on traite les messages de retour des différentes exécution en vérifiant si un message est présent en Session
			et si oui en l'affichant puis en l'effaçant de la session. -->
    <div class="row text-center">
        <div class="col-6 mx-auto">
            <?php
            if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
                echo ('<div id="message" class="alert alert-success" role="alert">' . $_SESSION['message'] . '</div>');
                unset($_SESSION['message']);
                session_destroy();
            }
            ?>
        </div>
    </div>

    <a href="ajouter.php" class="btn btn-primary mt-2">Ajouter une annonce</a>
    <a href="index.php" class="btn btn-secondary mt-2">Acceuil</a>

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
                <!--       <th>Photo</th> -->
                <th>Titre</th>
                <th>Description</th>
                <th>Code postal</th>
                <th>ville</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th>Date de création</th>

                <th class="text-right">Actions</th>
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

                    <td class="text-right">
                        <a href="details.php?id=<?= $ad['id_advert']; ?>" class="btn btn-warning">Voir le détail</a>
                        <a href="editer.php?id=<?= $ad['id_advert']; ?>" class="btn btn-primary">Mettre à jour</a>
                        <a onclick="return confirm('Voulez-vous bien supprimer ?');" href="index.php?id=<?= $ad['id_advert']; ?>&type=supprimer" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>
</body>

</html>