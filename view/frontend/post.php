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
<p><?= $post->getContent(); ?></p>

<?php
if (isset($isSessionValid)) {
?>
    <a href="<?= HOST; ?>edit/id/<?= $post->getid(); ?>">Modifier</a><br>
    <a href="" class="deletePostBtn" data-toggle="modal" data-target="#deleteModal" data-title="<?= htmlspecialchars($post->getTitle()); ?>" data-url="<?= HOST; ?>delete-post/id/<?= $post->getid(); ?>">Supprimer</a><br>
    <a href="<?= HOST; ?>post-management">Revenir à la gestion des articles</a>
<?php
}
?>

<hr>

<h4 id="anchorPost" class="anchor">Ajouter un commentaire</h4>

<form method="post" action="<?= HOST; ?>add-comment">

    <div class="form-group">
        <label for="author">Pseudo :&nbsp;</label>
        <input type="text" id="author" name="author" class="form-control" value="<?php if (isset($isSessionValid)) { echo 'Jean Forteroche';} ?>" />
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

<hr>

<?php

$elementsOnPage = false;
$commentsOnPage = false;

foreach ($comments as $comment)
{
    $elementsOnPage = true;
    $commentsOnPage = true;

    $backgroundComment = 'bg-secondary text-white';

    if ($comment->getReported()) {
        $backgroundComment = 'bg-warning';
    } elseif ($comment->getIsAdmin()) {
        $backgroundComment = 'bg-info text-white';
    } elseif ($comment->getIsAdmin() && $comment->getReported()) {
        $backgroundComment = 'bg-warning';
    }

?>

<div class="comment container">

    <div class="row">
    
        <p class="col-12 authorCommentBloc <?= $backgroundComment; ?>"><span id="commentAuthor<?= $comment->getId(); ?>" class="font-weight-bold"><?= htmlspecialchars($comment->getAuthor()); ?></span> (publié le <?= $comment->getCreationDate(); ?>)</p>
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
            <button type="button" class="btn btn-danger btn-sm ml-2" data-toggle="modal" data-target="#deleteModal" data-author="<?= htmlspecialchars($comment->getAuthor()); ?>" data-url="<?= HOST; ?>delete-comment/id/<?= $comment->getId(); ?>/post-id/<?= $post->getId(); ?>">Supprimer</button>
<?php
        } 
?>

        </div>
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


if (isset($errorMessage)) {
?>
    <div class="alert alert-danger alert-dismissible fade show actionErrorMessage fixed-bottom" role="alert">
        <?= $errorMessage; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
} else if (isset($actionDone)) {
?>
    <div class="alert alert-success alert-dismissible fade show actionErrorMessage fixed-bottom" role="alert">
        <?= $actionDone; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
}
?>