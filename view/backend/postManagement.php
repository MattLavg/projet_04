<?php 

// namespace Math\projet04;

// use Math\projet04\Model\PostManager;
// use Math\projet04\Model\Pagination;

// require_once(dirname(dirname(__DIR__)) . '/model/Manager.php');
// require_once(dirname(dirname(__DIR__)) . '/model/PostManager.php');
// require_once(dirname(dirname(__DIR__)) . '/model/Pagination.php');


$title = 'Gestion d\'articles'; 

?>

<h1>Modifier / supprimer un article</h1>

<?php

$nbPost = 1;
$elementsOnPage = false;
?>

<table class="table">
    <thead>
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
                    <td><a href="<?= HOST; ?>delete-post/id/<?= $post->getId(); ?>" class="deletePostBtn" data-toggle="modal" data-target="#deleteModal">Supprimer</a></td>
                </tr>  
            <?php
            }
            ?> 
        
    </tbody>
</table>

<?php


if (isset($elementsOnPage) && $pagination->getNotEnoughEntries()) { 
    $pagination->render($pagination);
}
?>