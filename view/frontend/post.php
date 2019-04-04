<?php

// if (isset($_SESSION['valid'])) {
//     exit('la session est valide.');
// }

$title = 'Le blog de Jean Forteroche ' . '| ' . htmlspecialchars($post->getTitle());

?>

<h1><?= htmlspecialchars($post->getTitle()); ?></h1>
<p>Publié le <?= $post->getCreationDate(); ?> par <?= htmlspecialchars($post->getAuthor()); ?>
<?php
    if ($post->getUpdateDate() !== NULL) {
        echo '(Dernière modification le ' . $post->getUpdateDate() . ')';
    }
?>
</p>
<p><?= nl2br(htmlspecialchars($post->getContent())); ?></p>

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
        <input id="post_id" type="hidden" name="post_id" value="<?= $post->getId(); ?>" />
    </div>
  
    <input type="submit" value="Envoyer" name="newComment" class="btn btn-primary" />

</form>

<a href="<?= HOST; ?>update-post/id/<?= $post->getid(); ?>">Modifier</a><br>
<a href="<?= HOST; ?>delete-post/id/<?= $post->getid(); ?>" class="deletePostBtn" data-toggle="modal" data-target="#deleteModal">Supprimer</a><br>
<a href="<?= HOST; ?>post-management">Revenir à la gestion des articles</a>

<hr>

<?php

$elementsOnPage = false;
$commentsOnPage = false;
// var_dump($comments);exit;
foreach ($comments as $comment)
{
    $elementsOnPage = true;
    $commentsOnPage = true;
?>

<div class="comment container">

    <div class="row">
    
        <p class="col-12 authorCommentBloc"><span class="authorComment"><?= htmlspecialchars($comment->getAuthor()); ?></span> (publié le <?= $comment->getCreationDate(); ?>)</p>
        <p class="col-12 textComment"><?= htmlspecialchars($comment->getContent()); ?></p>
        <div class="col-12 commentButtonBloc d-flex justify-content-end">
            <a href="index.php?page=postView&param=reportComment&post_id=<?= $post->getId(); ?>&comment_id=<?= $comment->getId(); ?>"><button type="button" class="btn btn-warning btn-sm">Signaler</button></a>
        </div>

        <?php
            if ($comment->getReported()) {
                echo '<span class="reported"></span>';
            }
        ?>
    
    </div>

</div>

<?php
}

if (!$commentsOnPage) {
    echo 'Il n\'y a actuellement aucun commentaire';
}


if (isset($elementsOnPage) && $pagination->getNotEnoughEntries()) { 
    $pagination->render($pagination);
}

?>