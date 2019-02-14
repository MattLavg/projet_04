<?php 
namespace Math\projet04\Model;

require(dirname(dirname(__DIR__)) . '/model/PostManager.php'); 
?>

<?php $title = 'Le blog de Jean Forteroche'; ?>

<?php ob_start(); ?>

<?php

$data = new PostManager();
$posts = $data->listPosts();

while ($post = $posts->fetch()) 
{
?>

    <h3><a href="index.php?page=single&id=<?= $post['id']; ?>"><?= htmlspecialchars($post['title']); ?></a></h3>
    <p>Le <?= $post['creation_date_fr']; ?> par <?= $post['author']; ?></p>

    <p>
        <?= substr(htmlspecialchars($post['content']), 0, 350) . '... '; ?><br>
        <a href="index.php?page=single&id=<?= $post['id']; ?>">Voir la suite</a>
    </p>

<?php
}
?>


<?php $content = ob_get_clean(); ?>

<?php require(dirname(__DIR__) . '/template.php'); ?>