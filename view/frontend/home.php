<?php $title = 'Le blog de Jean Forteroche'; ?>
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
