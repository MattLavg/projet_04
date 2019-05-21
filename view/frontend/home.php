<?php

$title = 'Accueil | Le blog de Jean Forteroche';


$elementsOnPage = false;

foreach ($posts as $post) 
{
    $elementsOnPage = true;
?>

    <div class="listPosts">

        <h3>
            <a href="<?= HOST; ?>post/id/<?= $post->getId(); ?>"><?= htmlspecialchars($post->getTitle()); ?></a>
        </h3>
        <p class="italic">Publié le <?= $post->getCreationDate(); ?> par <strong><?= htmlspecialchars($post->getAuthor()); ?></strong>
        <?php
            if ($post->getUpdateDate() !== NULL) {
                echo '<span class="modificationColor" >(Dernière modification le ' . $post->getUpdateDate() . ')</span>';
            }
        ?>
        </p>

        <p>
            <?= substr($post->getContent(), 0, 350) . '... '; ?><br>
            <a href="<?= HOST; ?>post/id/<?= $post->getId(); ?>">Voir la suite</a>
        </p>

    </div>

    <hr>

<?php
}

if (!$elementsOnPage) {
    echo 'Il n\'y a actuellement aucun article';
}

if (isset($elementsOnPage) && $pagination->getNotEnoughEntries()) { 
    $pagination->render();
}

if (isset($actionDone)) {
    // echo '<p class="actionDone bg-success text-white">' . $actionDone . '</p>';
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