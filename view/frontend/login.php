<?php 

namespace Math\projet04;

?>

<?php $title = 'Se connecter'; ?>

<?php ob_start(); ?>

<h1>Connexion</h1>

<form method="post" action="index.php?page=admin">
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type=text class="form-control" id="nom" name="name">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type=password class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="login">Se connecter</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/template.php'); ?>