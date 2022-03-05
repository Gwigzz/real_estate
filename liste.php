<?php

require_once './src/autoload.php';

$advertManager = new AdvertManager();

// Récupération de toutes les annonces
$ads = $advertManager->getAllAdverts();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Liste des annonces</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container p-5">
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
                            <!--        <td><img src="images/<?php echo $logement['photo'] ?>" alt="<?php echo $logement['titre'] ?>" class="img-fluid"></td> -->
                            <td><?php echo mb_strtoupper($ad['title']); ?></td>
                            <td><?php echo ucfirst(substr($ad['description'], 0, 10) . "..."); ?></td>
                            <td><?php echo $ad['postcode']; ?></td>
                            <td><?php echo $ad['city']; ?></td>
                            <td><?php echo $ad['category']; ?></td>
                            <td><?php echo $ad['price']; ?> €</td>
                            <td><?php echo $ad['created_at']; ?></td>

                            <td class="text-right">
                                <a href="details.php?id=<?php echo $ad['id_advert']; ?>" class="btn btn-warning">Voir le détail</a>
                                <a href="editer.php?id=<?php echo $ad['id_advert']; ?>" class="btn btn-primary">Mettre à jour</a>
                                <a onclick="return confirm('Voulez-vous bien supprimer ?');" href="index.php?id=<?php echo $ad['id_advert']; ?>&type=supprimer" class="btn btn-danger">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
</body>

</html>