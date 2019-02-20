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

$title = $post['title'];

?>

<h1><?= $post['title']; ?></h1>
<p>Par <?= $post['author']; ?> le <?= $post['creation_date_fr'] ?></p>
<p><?= nl2br(htmlspecialchars($post['content'])); ?></p>

<hr>

<h4>Ajouter un commentaire</h4>

<form method="post" action="index.php?page=postView">

    <div class="form-group">
        <label for="author">Pseudo :&nbsp;</label>
        <input type="text" id="author" name="author" class="form-control" />
    </div>

    <div class="form-group">
        <label for="content">Votre commentaire :</label>
        <textarea class="form-control" id="content" name="content" rows="5"></textarea>
    </div>
  
    <input type="submit" value="Envoyer" name="newComment" class="btn btn-primary" />

</form>

<hr>

<?php $content = ob_get_clean(); ?>

<?php require(dirname(__DIR__) . '/template.php'); ?>