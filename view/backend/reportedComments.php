<?php 

$title = 'Modération des commentaires | Le blog de Jean Forteroche ';

?>

<h1>Modérer les commentaires</h1>

<?php

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

                <button type="button" class="btn btn-danger btn-sm ml-2" data-toggle="modal" data-target="#deleteModal" data-author="<?= htmlspecialchars($reportedComment->getAuthor()); ?>" data-url="<?= HOST; ?>delete-comment/id/<?= $reportedComment->getId(); ?>">Supprimer</button>
                
            </div>
        </div>
    </div>
    
<?php
} // fin du foreach


if (isset($commentsOnPage) && $pagination->getNotEnoughEntries()) { 

    $pagination->render();

} elseif (!$commentsOnPage) {

    echo 'Il n\'y a actuellement aucun commentaire signalé.';
}


if (isset($actionDone)) {
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