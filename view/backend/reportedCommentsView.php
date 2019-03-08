<?php 

namespace Math\projet04;

use Math\projet04\Model\CommentManager;

require_once(dirname(dirname(__DIR__)) . '/model/CommentManager.php');

?>

<?php ob_start(); ?>

<h1>Modérer les commentaires</h1>

<?php

$title = 'Modération des commentaires';

$data = new CommentManager();
$reportedComments = $data->listReportedComments();

$commentsOnPage = false;

while ($reportedComment = $reportedComments->fetch()) {
    
    $commentsOnPage = true;
?>
    
    <div class="comment container">
    
        <div class="row">
        
            <p class="col-12 authorCommentBloc"><span id="commentAuthor<?= $reportedComment['id']; ?>"><?= htmlspecialchars($reportedComment['author']); ?></span> (publié le <?= $reportedComment['creation_date_fr']; ?>)</p>
            <p class="col-12 textComment"><?= htmlspecialchars($reportedComment['content']); ?></p>
            <div class="col-12 commentButtonBloc d-flex justify-content-end">
                <a class="deleteCommentBtn" href="index.php?page=admin&param=deleteComment&reportedCommentsView=true&comment_id=<?= $reportedComment['id']; ?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">Supprimer</button></a>
            </div>
            
            <?php
                if ($reportedComment['reported']) {
                    echo '<span class="reported"></span>';
                }
            ?>

        </div>

    </div>
    
<?php
} // fin du while

if (!$commentsOnPage) {
    echo 'Il n\'y a actuellement aucun commentaire signalé.';
}

?>

<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/template.php'); ?>