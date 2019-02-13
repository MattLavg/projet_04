<?php 
namespace Math\projet04\Model;

require(dirname(dirname(__DIR__)) . '/model/PostManager.php'); 
?>

<?php $title = 'Le blog de Jean Forteroche'; ?>


<?php ob_start(); ?>
<h1>Jean Forteroche</h1>

<?php

$data = new PostManager();
$posts = $data->listPosts();

while ($post = $posts->fetch()) 
{
?>

    <h3><?= htmlspecialchars($post['title']); ?></h3>

    <p><?= htmlspecialchars($post['content']); ?></p>

<?php
}
?>


<?php $content = ob_get_clean(); ?>

<?php require(dirname(__DIR__) . '/frontend/template.php'); ?>