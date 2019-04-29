<?php

// namespace Math\projet04\view\frontend;

$title = 'Le blog de Jean Forteroche';

// if (isset($_SESSION['valid'])) {
//     exit('la session est valide.');
// }

$elementsOnPage = false;

foreach ($posts as $post) 
{
    $elementsOnPage = true;
?>

    <div class="listPosts">

        <h3>
            <a href="<?= HOST; ?>post/id/<?= $post->getId(); ?>"><?= htmlspecialchars($post->getTitle()); ?></a>
        </h3>
        <p>Publié le <?= $post->getCreationDate(); ?> par <?= htmlspecialchars($post->getAuthor()); ?>
        <?php
            if ($post->getUpdateDate() !== NULL) {
                echo '(Dernière modification le ' . $post->getUpdateDate() . ')';
            }
        ?>
        </p>

        <p>
            <?= substr(htmlspecialchars($post->getContent()), 0, 350) . '... '; ?><br>
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
?>
