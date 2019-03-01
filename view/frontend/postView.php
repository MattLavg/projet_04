<?php 

namespace Math\projet04;

use Math\projet04\Model\PostManager;
use Math\projet04\Model\CommentManager;

require_once(dirname(dirname(__DIR__)) . '/model/Manager.php');
require_once(dirname(dirname(__DIR__)) . '/model/PostManager.php');
require_once(dirname(dirname(__DIR__)) . '/model/CommentManager.php');


?>

<?php ob_start(); ?>

<?php

$data = new PostManager();
$post = $data->getPost($_GET['id']);
$post = $post->fetch();


$title = htmlspecialchars($post['title']);

?>

<h1><?= htmlspecialchars($post['title']); ?></h1>
<p>Publié le <?= $post['creation_date_fr']; ?> par <?= htmlspecialchars($post['author']); ?>
<?php
    if ($post['updateDateFr'] !== NULL) {
        echo '(Dernière modification le ' . $post['updateDateFr'] . ')';
    }
?>
</p>
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

    <div class="form-group">
        <input id="post_id" type="hidden" name="post_id" value="<?= $post['id']; ?>" />
    </div>
  
    <input type="submit" value="Envoyer" name="newComment" class="btn btn-primary" />

</form>

<hr>

<?php

$dataComments = new CommentManager();
$comments = $dataComments->listComments($_GET['id']);

while ($comment = $comments->fetch())
{
?>

<div class="comment container">

    <div class="row">
    
        <p class="col-12 authorCommentBloc"><span class="authorComment"><?= htmlspecialchars($comment['author']); ?></span> (publié le<?= $comment['creation_date_fr']; ?>)</p>
        <p class="col-12 textComment"><?= htmlspecialchars($comment['content']); ?></p>
        <div class="col-12 commentButtonBloc d-flex justify-content-end">
            <a href="index.php?page=postView&param=reportComment&post_id=<?= $post['id']; ?>&comment_id=<?= $comment['id']; ?>"><button type="button" class="btn btn-warning btn-sm">Signaler</button></a>
        </div>

        <?php
            if ($comment['reported']) {
                echo '<span class="reported"></span>';
            }
        ?>
    
    </div>

</div>

<?php
}
?>

<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/template.php'); ?>