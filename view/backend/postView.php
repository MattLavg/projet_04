<?php 

namespace Math\projet04;

use Math\projet04\Model\PostManager;
use Math\projet04\Model\CommentManager;
use Math\projet04\Model\Pagination;

require_once(dirname(dirname(__DIR__)) . '/model/Manager.php');
require_once(dirname(dirname(__DIR__)) . '/model/PostManager.php');
require_once(dirname(dirname(__DIR__)) . '/model/CommentManager.php');
require_once(dirname(dirname(__DIR__)) . '/model/Pagination.php');


if (!isset($_GET['pageNb'])) {
    $_GET['pageNb'] = 1;
}

$data = new PostManager();
$post = $data->getPost($_GET['postId']);
$post = $post->fetch();

$dataComments = new CommentManager();
$totalNbRows = $dataComments->count($_GET['postId']);

$pagination = new Pagination($_GET['pageNb'], $totalNbRows, $_SERVER['PHP_SELF'], $_SERVER['argv'], CommentManager::NB_COMMENTS_BY_PAGE);

$comments = $dataComments->listComments($_GET['postId'], $pagination->getFirstEntry());

?>

<?php ob_start(); ?>

<?php


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

<a href="index.php?page=admin&param=updatePost&post_id=<?= $post['id']; ?>">Modifier</a><br>
<a href="index.php?page=admin&param=deletePost&post_id=<?= $post['id']; ?>&delete=true" class="deletePostBtn" data-toggle="modal" data-target="#deleteModal">Supprimer</a><br>
<a href="index.php?page=admin&param=manageListPosts">Revenir à la gestion des articles</a>

<hr>

<h4>Commentaires</h4>

<?php

$elementsOnPage = false;
$commentsOnPage = false;

while ($comment = $comments->fetch()) { // début du while
    
    $elementsOnPage = true;
    $commentsOnPage = true;
?>
    
    <div class="comment container">
    
        <div class="row">
        
            <p class="col-12 authorCommentBloc"><span id="commentAuthor<?= $comment['id']; ?>"><?= htmlspecialchars($comment['author']); ?></span> (publié le <?= $comment['creation_date_fr']; ?>)</p>
            <p class="col-12 textComment"><?= htmlspecialchars($comment['content']); ?></p>
            <div class="col-12 commentButtonBloc d-flex justify-content-end">
                <a class="deleteCommentBtn" href="index.php?page=admin&param=deleteComment&postView=true&post_id=<?= $comment['post_id']; ?>&comment_id=<?= $comment['id']; ?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">Supprimer</button></a>
            </div>

            <?php
                if ($comment['reported']) {
                    echo '<span class="reported"></span>';
                }
            ?>

        </div>

    </div>
    
<?php
} // fin du while

if (!$commentsOnPage) {
    echo 'Il n\'y a actuellement aucun commentaire';
}

?>

<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/template.php'); ?>