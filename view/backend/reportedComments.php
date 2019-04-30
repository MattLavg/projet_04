<?php 

// namespace Math\projet04;

// use Math\projet04\Model\CommentManager;

// require_once(dirname(dirname(__DIR__)) . '/model/CommentManager.php');
?>

<h1>Modérer les commentaires</h1>

<?php

$title = 'Modération des commentaires';

if (isset($actionDone)) {
    echo '<p class="actionDone bg-success text-white">' . $actionDone . '</p>';
}

$commentsOnPage = false;

foreach ($reportedComments as $reportedComment) {
    
    $commentsOnPage = true;

?>
    
    <div class="comment container">
    
        <div class="row">
        
            <p class="col-12 authorCommentBloc bg-warning"><span id="commentAuthor<?= $reportedComment->getId(); ?>" class="font-weight-bold"><?= htmlspecialchars($reportedComment->getAuthor()); ?></span> (publié le <?= $reportedComment->getCreationDate(); ?>)</p>
            <p class="col-12 textComment"><?= htmlspecialchars($reportedComment->getContent()); ?></p>

            <div class="col-12 commentButtonBloc d-flex justify-content-end">

                <a href="<?= HOST; ?>valid-comment/id/<?= $reportedComment->getId(); ?>">
                    <button type="button" class="btn btn-success btn-sm">Publier</button>
                </a>

                <a class="deleteCommentBtn ml-2" href="<?= HOST; ?>delete-comment/id/<?= $reportedComment->getId(); ?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">Supprimer</button></a>
            </div>
        </div>
    </div>
    
<?php
} // fin du foreach

if (!$commentsOnPage) {
    echo 'Il n\'y a actuellement aucun commentaire signalé.';
}

if (isset($commentsOnPage) && $pagination->getNotEnoughEntries()) { 
    $pagination->render();
}

?>