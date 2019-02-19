<?php

namespace Math\projet04;

use Math\projet04\Model\PostManager;

require_once(dirname(dirname(__DIR__)) . '/model/Manager.php');
require_once(dirname(dirname(__DIR__)) . '/model/PostManager.php');

?>

<?php ob_start(); ?>



<?php

$data = new PostManager();
$post = $data->getPost($_GET['id']);
$post = $post->fetch();

$title = 'Modification |' . $post['title'];
?>

<form method="post" action="index.php?page=admin">

    <div class="form-group">
        <label for="title">Titre :&nbsp;</label>
        <input type="text" id="title" value="<?= $post['title']; ?>" name="title" class="form-control" />
    </div>

    <div class="form-group">
        <label for="author">Auteur :&nbsp;</label>
        <input type="text" id="author" name="author" value="<?= $post['author']; ?>" class="form-control" />
    </div>

    <div class="form-group">
        <textarea id="mytextarea" name="content"><?= nl2br($post['content']); ?></textarea>
    </div>

    <div class="form-group">
        <input id="id" type="hidden" name="id" value="<?= $post['id']; ?>" />
    </div>
  
    <input type="submit" value="Envoyer" name="updatePost" class="btn btn-primary" />

</form>

<a href="index.php?page=admin">Annuler les modifications</a>

<?php $content = ob_get_clean(); ?>

<?php require(dirname(__DIR__) . '/template.php'); ?>