<?php

$title = 'Le blog de Jean Forteroche ' . '|' . ' Ajout d\'article';

if (isset($post)) {

    ?>   
    
        <h1>Modifier un article</h1>
    
        <form method="post" action="<?= HOST; ?>update-post">
    
            <div class="form-group">
                <input id="id" type="hidden" name="id" value="<?= $post->getId(); ?>" />
            </div>
    
            <div class="form-group">
                <label for="title">Titre :&nbsp;</label>
                <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($post->getTitle()); ?>" />
            </div>
    
            <div class="form-group">
                <label for="author">Auteur :&nbsp;</label>
                <input type="text" id="author" name="author" class="form-control" value="<?= htmlspecialchars($post->getAuthor()); ?>" />
            </div>
            
            <div class="form-group">
                <textarea id="tinymcetextarea" name="content"><?= nl2br(htmlspecialchars($post->getContent())); ?></textarea>
            </div>
    
            <input type="submit" value="Envoyer" class="btn btn-primary" />
    
        </form>
    
    <?php
    } else {
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
                <textarea id="tinymcetextarea" name="content"></textarea>
            </div>
    
            <input type="submit" value="Envoyer" class="btn btn-primary" />
    
        </form>
    
    <?php
    }

    if (isset($errorMessage)) {
        echo '<p class="errorMessage">' . $errorMessage . '</p>';
    }

    ?>