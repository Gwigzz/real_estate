<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Annonce Immobiliere</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container p-5">

        <!-- Message -->
        <div class="row text-center">
            <div class="col-6 mx-auto">
                <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) : ?>
                    <div id="message" class="alert alert-success" role="alert"><?= $_SESSION['message'] ?></div>;
                <?php endif; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        </div>