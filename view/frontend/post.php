<?php

$title = 'Le blog de Jean Forteroche ' . '| ' . htmlspecialchars($post->getTitle());


?>

<h1><span id="postTitle"><?= htmlspecialchars($post->getTitle()); ?></span></h1>
<p>Publié le <?= $post->getCreationDate(); ?> par <?= htmlspecialchars($post->getAuthor()); ?>
<?php
    if ($post->getUpdateDate() !== NULL) {
        echo '(Dernière modification le ' . $post->getUpdateDate() . ')';
    }
?>
</p>
<p><?= nl2br(htmlspecialchars($post->getContent())); ?></p>

<?php
if (isset($isSessionValid)) {
?>
    <a href="<?= HOST; ?>edit/id/<?= $post->getid(); ?>">Modifier</a><br>
    <a href="<?= HOST; ?>delete-post/id/<?= $post->getid(); ?>" class="deletePostBtn" data-toggle="modal" data-target="#deleteModal">Supprimer</a><br>
    <a href="<?= HOST; ?>post-management">Revenir à la gestion des articles</a>
<?php
}
?>

<hr>

<h4>Ajouter un commentaire</h4>

<form method="post" action="<?= HOST; ?>add-comment">

    <div class="form-group">
        <label for="author">Pseudo :&nbsp;</label>
        <input type="text" id="author" name="author" class="form-control" />
    </div>

    <div class="form-group">
        <label for="content">Votre commentaire :</label>
        <textarea class="form-control" id="content" name="content" rows="5"></textarea>
    </div>

    <div class="form-group">
        <input id="post_id" type="hidden" name="post-id" value="<?= $post->getId(); ?>" />
    </div>

<?php
if (isset($isSessionValid)) {
?>
    <div class="form-group">
        <input id="post_id" type="hidden" name="main-author" value="sessionValid" />
    </div>
<?php
}
?>
  
    <input type="submit" value="Envoyer" class="btn btn-primary" />

</form>

<?php
if (isset($errorMessage)) {
    echo '<p class="errorMessage">' . $errorMessage . '</p>';
}
?>


<hr>

<?php

$elementsOnPage = false;
$commentsOnPage = false;

foreach ($comments as $comment)
{
    $elementsOnPage = true;
    $commentsOnPage = true;
?>

<div class="comment container">

    <div class="row">
    
        <p class="col-12 authorCommentBloc"><span id="commentAuthor<?= $comment->getId(); ?>" class="font-weight-bold"><?= htmlspecialchars($comment->getAuthor()); ?></span> (publié le <?= $comment->getCreationDate(); ?>)</p>
        <p class="col-12 textComment"><?= htmlspecialchars($comment->getContent()); ?></p>
        <div class="col-12 commentButtonBloc d-flex justify-content-end">

        <a href="<?= HOST; ?>report-comment/id/<?= $comment->getId(); ?>/post-id/<?= $post->getId(); ?>">
            <button type="button" class="btn btn-warning btn-sm">Signaler</button>
        </a>

<?php
        if ($comment->getReported() && isset($isSessionValid)) { // if author, comments can be approved
?>
            <a class="ml-2" href="<?= HOST; ?>valid-comment/id/<?= $comment->getId(); ?>/post-id/<?= $post->getId(); ?>">
                <button type="button" class="btn btn-success btn-sm">Publier</button>
            </a>

<?php
        }
        
        if (isset($isSessionValid)) { // if author, comments can be deleted
?>
            <a class="deleteCommentBtn ml-2" href="<?= HOST; ?>delete-comment/id/<?= $comment->getId(); ?>/post-id/<?= $post->getId(); ?>">
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">Supprimer</button>
            </a>
<?php
        } 
?>

        </div>

        <?php 
            if ($comment->getReported()) {
                echo '<span class="reported"></span>';
            } elseif ($comment->getIsAuthor()) {
                echo '<span class="isAuthor"></span>';
            } elseif ($comment->getIsAuthor() && $comment->getReported()) {
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
    $pagination->render();
}

?>