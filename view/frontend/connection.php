<?php 

// namespace Math\projet04;
// var_dump($errorMessage);
?>

<?php $title = 'Se connecter'; ?>


<h1>Connexion</h1>

<form method="post" action="<?= HOST; ?>login">
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type=text class="form-control" id="nom" name="name">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type=password class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php 

if (isset($errorMessage)) {
    echo '<p class="errorMessage">' . $errorMessage . '</p>';
}

?>


