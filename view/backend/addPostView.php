<?php 

namespace Math\projet04;

use Math\projet04\Model\PostManager;

// require_once(__DIR__ . '/model/Autoloader.php');
// Autoloader::register;

require_once(dirname(dirname(__DIR__)) . '/model/Manager.php');
require_once(dirname(dirname(__DIR__)) . '/model/PostManager.php');

$title = 'Ajout d\'articles'; 

// if (isset($_POST['newPost'])) {
            
//   echo 'TRUE';
// }

if (isset($_GET['post_id'])) {

    $data = new PostManager();
    $updatePost = $data->getPost($_GET['post_id']);
    $updatePost = $updatePost->fetch();

}

?>

<?php ob_start(); ?>

<?php
    if (isset($updatePost)) {
?>

<h1>Modifier un article</h1>

    <form method="post" action="index.php?page=admin&param=updatePost">

        <div class="form-group">
            <label for="title">Titre :&nbsp;</label>
            <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($updatePost['title']); ?>" />
        </div>

        <div class="form-group">
            <label for="author">Auteur :&nbsp;</label>
            <input type="text" id="author" name="author" value="<?= htmlspecialchars($updatePost['author']); ?>" class="form-control"/>
        </div>
        
        <div class="form-group">
            <textarea id="tinymcetextarea" name="content"><?= nl2br(htmlspecialchars($updatePost['content'])); ?></textarea>
        </div>

        <div class="form-group">
            <input id="id" type="hidden" name="id" value="<?= $updatePost['id']; ?>" />
        </div>

        <input type="submit" value="Envoyer" name="updatePost" class="btn btn-primary" />

    </form>

<?php
    } else {
?>

<h1>Ajouter un article</h1>

    <form method="post" action="index.php?page=admin&param=addPost">

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

        <input type="submit" value="Envoyer" name="newPost" class="btn btn-primary" />

    </form>

<?php
    }
?>


<?php

if (isset($_GET['affectedLines'])) {

    if ($_GET['affectedLines']) {
        echo '<p id="addedPost">L\'article a bien été enregistré</p>';
    }
    
}

?>

<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/template.php'); ?>