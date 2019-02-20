<?php 

namespace Math\projet04;

use Math\projet04\Model\PostManager;

// require_once(__DIR__ . '/model/Autoloader.php');
// Autoloader::register;

require_once(dirname(dirname(__DIR__)) . '/model/Manager.php');
require_once(dirname(dirname(__DIR__)) . '/model/PostManager.php');

$title = 'Administration'; 

if (isset($_POST['newPost'])) {
            
  echo 'TRUE';
}

?>

<?php ob_start(); ?>
<h1>Administration</h1>

<form method="post" action="index.php?page=admin">

    <div class="form-group">
        <label for="title">Titre :&nbsp;</label>
        <input type="text" id="title" name="title" class="form-control" />
    </div>

    <div class="form-group">
        <label for="author">Auteur :&nbsp;</label>
        <input type="text" id="author" name="author" value="Jean Forteroche" class="form-control"/>
    </div>
    
    <div class="form-group">
        <textarea id="tinymcetextarea" name="content">Hello, World!</textarea>
    </div>

    <input type="submit" value="Envoyer" name="newPost" class="btn btn-primary" />

</form>

<hr>

<?php

$data = new PostManager();
$posts = $data->listPosts();

while ($post = $posts->fetch()) 
{
?>

    <div class="listPosts">

        <h3><a href="index.php?page=adminPostView&id=<?= $post['id']; ?>"><?= htmlspecialchars($post['title']); ?></a></h3>
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
                <a class="deleteBtn" href="#">Supprimer</a>
            </p>
        </p>

    </div>

    <div id="overlayDeletePost" class="position-fixed">
    
        <div class="deleteQuestion position-relative">
            <div class="crossArea"><a href="#" class="close"></a></div>
            <p>Souhaitez-vous vraiment effacer l'article <?= htmlspecialchars($post['title']); ?> ?</p><br>
            <a href="index.php?page=admin&id=<?= $post['id']; ?>&delete=true"><button type="button" class="btn btn-warning">Oui</button></a>
            <button type="button" class="btn btn-primary noDeletePost">Non</button>
        </div>

    </div>

<?php
}
?>



<?php $content = ob_get_clean(); ?>

<?php require(dirname(__DIR__) . '/template.php'); ?>