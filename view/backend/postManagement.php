<?php 

namespace Math\projet04;

use Math\projet04\Model\PostManager;

require_once(dirname(dirname(__DIR__)) . '/model/Manager.php');
require_once(dirname(dirname(__DIR__)) . '/model/PostManager.php');

$title = 'Gestion d\'articles'; 

?>

<?php ob_start(); ?>

<h1>Modifier / supprimer un article</h1>

<?php

$data = new PostManager();
$posts = $data->listPosts();

$nbPost = 1;

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
            ?>
                <tr>
                    <th scope="row"><?= $nbPost++; ?></th>
                    <td><a href="index.php?page=admin&param=postView&post_id=<?= $post['id']; ?>"><span id="postTitle<?= $post['id']; ?>"><?= htmlspecialchars($post['title']); ?></span></a></td>
                    <td><?= $post['creation_date_fr']; ?></td>
                    <td><a href="index.php?page=admin&param=updatePost&post_id=<?= $post['id']; ?>">Modifier</a></td>
                    <td><a href="index.php?page=admin&param=deletePost&post_id=<?= $post['id']; ?>" class="deletePostBtn">Supprimer</a></td>
                </tr>  
            <?php
            }
            ?> 
        
    </tbody>
</table>






<!-- <?php
while ($post = $posts->fetch()) 
{
?>

    <table>
        <thead>
            <tr>
                <th scope="col">-</th>
                <th scope="col">Titre</th>
                <th scope="col">Date de création</th>
                <th scope="col">-</th>
                <th scope="col">-</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"><?= $nbPost++; ?></th>
                <td><?= htmlspecialchars($post['title']); ?></td>
            </tr>
        </tbody>
    </table>

    <div class="listPosts">

        <h3><a href="index.php?page=adminPostView&id=<?= $post['id']; ?>"><span id="postTitle<?= $post['id']; ?>"><?= htmlspecialchars($post['title']); ?></span></a></h3>
        <p>Publié le <?= $post['creation_date_fr']; ?> par <?= htmlspecialchars($post['author']); ?>
        <?php
            if ($post['updateDateFr'] !== NULL) {
                echo '(Dernière modification le ' . $post['updateDateFr'] . ')';
            }
        ?>
        </p>

        <p>
            <?= substr(htmlspecialchars($post['content']), 0, 350) . '... '; ?><br>
            <p>
                <a href="index.php?page=adminPostView&id=<?= $post['id']; ?>">Voir la suite</a>&nbsp;-
                <a href="index.php?page=updatePost&id=<?= $post['id']; ?>">Modifier</a>&nbsp;-
                <a href="index.php?page=admin&post_id=<?= $post['id']; ?>&delete=true" class="deletePostBtn">Supprimer</a>
            </p>
        </p>

    </div>

    <hr>

<?php
}
?> -->



<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/template.php'); ?>