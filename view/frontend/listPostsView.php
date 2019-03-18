<?php 

namespace Math\projet04;

use Math\projet04\Model\PostManager;
use Math\projet04\Model\Pagination;

require_once(dirname(dirname(__DIR__)) . '/model/Manager.php');
require_once(dirname(dirname(__DIR__)) . '/model/PostManager.php'); 
require_once(dirname(dirname(__DIR__)) . '/model/Pagination.php');


if (!isset($_GET['pageNb'])) {
    $_GET['pageNb'] = 1;
} elseif (isset($_GET['pageNb']) && $_GET['pageNb'] < 1) {
    $_GET['pageNb'] = 1;
}

$data = new PostManager();

$totalNbRows = $data->count();

$pagination = new Pagination($_GET['pageNb'], $totalNbRows, $_SERVER['PHP_SELF'], $_SERVER['argv'], PostManager::NB_POST_BY_PAGE);

$posts = $data->listPosts($pagination->getFirstEntry());


?>

<?php $title = 'Le blog de Jean Forteroche'; ?>

<?php ob_start(); ?>

<?php

$elementsOnPage = false;

while ($post = $posts->fetch()) 
{
    $elementsOnPage = true;
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

<?php require(__DIR__ . '/template.php'); ?>