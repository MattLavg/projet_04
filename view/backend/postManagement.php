<?php 

namespace Math\projet04;

use Math\projet04\Model\PostManager;
use Math\projet04\Model\Pagination;

require_once(dirname(dirname(__DIR__)) . '/model/Manager.php');
require_once(dirname(dirname(__DIR__)) . '/model/PostManager.php');
require_once(dirname(dirname(__DIR__)) . '/model/Pagination.php');

$title = 'Gestion d\'articles'; 

if (!isset($_GET['pageNb'])) {
    $_GET['pageNb'] = 1;
}

$data = new PostManager();

$totalNbRows = $data->count();

$pagination = new Pagination($_GET['pageNb'], $totalNbRows, $_SERVER['PHP_SELF'], $_SERVER['argv'], PostManager::NB_POST_BY_PAGE);

$posts = $data->listPosts($pagination->getFirstEntry());

?>

<?php ob_start(); ?>

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

            while ($post = $posts->fetch()) 
            {
                $elementsOnPage = true;
            ?>
                <tr>
                    <th scope="row"><?= $nbPost++; ?></th>
                    <td><a href="index.php?page=admin&param=postView&post_id=<?= $post['id']; ?>"><span id="postTitle<?= $post['id']; ?>"><?= htmlspecialchars($post['title']); ?></span></a></td>
                    <td><?= $post['creation_date_fr']; ?></td>
                    <td><a href="index.php?page=admin&param=updatePost&post_id=<?= $post['id']; ?>">Modifier</a></td>
                    <td><a href="index.php?page=admin&param=deletePost&post_id=<?= $post['id']; ?>" class="deletePostBtn" data-toggle="modal" data-target="#deleteModal">Supprimer</a></td>
                </tr>  
            <?php
            }
            ?> 
        
    </tbody>
</table>



<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/template.php'); ?>