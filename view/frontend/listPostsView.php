<?php 

namespace Math\projet04;

use Math\projet04\Model\PostManager;

require_once(dirname(dirname(__DIR__)) . '/model/Manager.php');
require_once(dirname(dirname(__DIR__)) . '/model/PostManager.php'); 
?>

<?php $title = 'Le blog de Jean Forteroche'; ?>

<?php ob_start(); ?>

<?php

$data = new PostManager();
$posts = $data->listPosts();

while ($post = $posts->fetch()) 
{
?>

    <div class="listPosts">

        <h3><a href="index.php?page=postView&id=<?= $post['id']; ?>"><?= htmlspecialchars($post['title']); ?></a></h3>
        <p>Publié le <?= $post['creation_date_fr']; ?> par <?= htmlspecialchars($post['author']); ?>
        <?php
            if ($post['updateDateFr'] !== NULL) {
                echo '(Dernière modification le ' . $post['updateDateFr'] . ')';
            }
        ?>
        </p>

        <p>
            <?= substr(htmlspecialchars($post['content']), 0, 350) . '... '; ?><br>
            <a href="index.php?page=postView&id=<?= $post['id']; ?>">Voir la suite</a>
        </p>

    </div>

    <hr>

<?php
}
?>

<?php $content = ob_get_clean(); ?>

<?php require(dirname(__DIR__) . '/template.php'); ?>