<?php 

namespace Math\projet04;

use Math\projet04\Model\PostManager;
use Math\projet04\Model\CommentManager;

// require_once(__DIR__ . '/model/Autoloader.php');
// Autoloader::register;

require_once(dirname(dirname(__DIR__)) . '/model/Manager.php');
require_once(dirname(dirname(__DIR__)) . '/model/PostManager.php');
require_once(dirname(dirname(__DIR__)) . '/model/CommentManager.php');

?>


<?php ob_start(); ?>

<?php

$data = new PostManager();
$post = $data->getPost($_GET['id']);
$post = $post->fetch();

$title = $post['title'];

?>

<h1><span id="postTitle<?= $post['id']; ?>"><?= htmlspecialchars($post['title']); ?></span></h1>
<p>Publié le <?= $post['creation_date_fr']; ?> par <?= htmlspecialchars($post['author']); ?>
        <?php
            if ($post['updateDateFr'] !== NULL) {
                echo '(Dernière modification le ' . $post['updateDateFr'] . ')';
            }
        ?>
        </p>
<p><?= nl2br(htmlspecialchars($post['content'])); ?></p>

<a href="index.php?page=updatePost&id=<?= $post['id']; ?>">Modifier</a><br>
<a href="index.php?page=admin&post_id=<?= $post['id']; ?>&delete=true" class="deletePostBtn">Supprimer</a><br>
<a href="index.php?page=admin">Revenir à l'administration</a>

<hr>

<h4>Commentaires</h4>

<?php

$dataComments = new CommentManager();
$comments = $dataComments->listComments($_GET['id']);

while ($comment = $comments->fetch())
{
?>

<div class="comment container">

    <div class="row">
    
        <p class="col-12 authorCommentBloc"><span id="commentAuthor<?= $comment['id']; ?>"><?= htmlspecialchars($comment['author']); ?></span> (publié le <?= $comment['creation_date_fr']; ?>)</p>
        <p class="col-12 textComment"><?= htmlspecialchars($comment['content']); ?></p>
        <p class="col-12"><a class="deleteCommentBtn" href="index.php?page=adminPostView&id=<?= $comment['post_id']; ?>&comment_id=<?= $comment['id']; ?>&deleteComment=true">Supprimer</a></p>
    
    </div>

</div>

<?php
}
?>

<?php $content = ob_get_clean(); ?>

<?php require(dirname(__DIR__) . '/template.php'); ?>