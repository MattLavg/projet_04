<?php

$title = 'Le blog de Jean Forteroche ' . '|' . ' Ajout d\'article';

?>

<h1>Ajouter un article</h1>

<form method="post" action="<?= HOST; ?>add-post">

    <div class="form-group">
        <label for="title">Titre :&nbsp;</label>
        <input type="text" id="title" name="title" class="form-control" />
    </div>

    <div class="form-group">
        <label for="author">Auteur :&nbsp;</label>
        <input type="text" id="author" name="author" value="Jean Forteroche" class="form-control"/>
    </div>
    
    <div class="form-group">
        <textarea id="tinymcetextarea" name="content">Hello, World!</textarea>
    </div>

    <input type="submit" value="Envoyer" class="btn btn-primary" />

</form>