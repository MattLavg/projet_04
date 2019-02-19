<?php 

namespace Math\projet04;

use Math\projet04\Model\PostManager;

// require_once(__DIR__ . '/model/Autoloader.php');
// Autoloader::register;

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

<a href="index.php?page=updatePost&id=<?= $post['id']; ?>">Modifier</a><br>
<a class="deleteBtn" href="#">Supprimer</a>


<div id="overlayDeletePost" class="position-fixed">
    
    <div class="deleteQuestion position-relative">
        <div class="crossArea"><a href="#" class="close"></a></div>
        <p>Souhaitez-vous vraiment effacer l'article <?= htmlspecialchars($post['title']); ?> ?</p><br>
        <a href="index.php?page=admin&id=<?= $post['id']; ?>&delete=true"><button type="button" class="btn btn-warning">Oui</button></a>
        <button type="button" class="btn btn-primary noDeletePost">Non</button>
    </div>

</div>

<?php $content = ob_get_clean(); ?>

<?php require(dirname(__DIR__) . '/template.php'); ?>