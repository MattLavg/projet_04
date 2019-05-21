<?php 

$title = 'Gestion d\'articles | Le blog de Jean Forteroche '; 

?>

<h1>Modifier / supprimer un article</h1>

<?php

$nbPost = 1;
$elementsOnPage = false;
?>

<div class="table-responsive tableMargin">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">-</th>
                <th scope="col">Titre</th>
                <th scope="col">Date de création</th>
                <th scope="col">Modification</th>
                <th scope="col">Suppression</th>
            </tr>
        </thead>
        <tbody>
            
                <?php 

                foreach ($posts as $post) 
                {
                    $elementsOnPage = true;
                ?>
                    <tr>
                        <th scope="row"><?= $nbPost++; ?></th>
                        <td><a href="<?= HOST; ?>post/id/<?= $post->getId(); ?>"><span id="postTitle<?= $post->getId(); ?>"><?= htmlspecialchars($post->getTitle()); ?></span></a></td>
                        <td><?= $post->getCreationDate(); ?></td>
                        <td><a href="<?= HOST; ?>edit/id/<?= $post->getId(); ?>">Modifier</a></td>
                        <td><a href="" class="deletePostBtn" data-toggle="modal" data-target="#deleteModal" data-title="<?= htmlspecialchars($post->getTitle()); ?>" data-url="<?= HOST; ?>delete-post/id/<?= $post->getId(); ?>/post-management/">Supprimer</a></td>
                    </tr>  
                <?php
                }
                ?> 
            
        </tbody>
    </table>
</div>

<?php

if (!$elementsOnPage) {
    echo 'Il n\'y a actuellement aucun article';
}


if (isset($elementsOnPage) && $pagination->getNotEnoughEntries()) { 
    $pagination->render();
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