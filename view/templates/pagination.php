<?php

if ($pagination->getCurrentUrl() == NULL) {
    $pagination->setCurrentUrl('home');
}

?>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="<?= HOST; ?><?= $pagination->getCurrentUrl(); ?>/pageNb/<?= $pagination->getPreviousPage(); ?>/">Précédent</a>
        </li>
        <?php

        for ($i = 1; $i <= $pagination->getTotalPages(); $i++) {

            if ($i == $pagination->getCurrentPage()) {
                echo '<li class="page-item active"><a class="page-link" href="#">'. $i .'</a></li>';
            } elseif ($pagination->getCurrentPage() - $i <= 2 && $pagination->getCurrentPage() - $i >= -2) {
                echo '<li class="page-item"><a class="page-link" href="' . HOST . $pagination->getCurrentUrl() . '/pageNb/' . $i . '/">'. $i .'</a></li>';
            } 
        }
        ?>
        <li class="page-item"><a class="page-link" href="<?= HOST; ?><?= $pagination->getCurrentUrl(); ?>/pageNb/<?= $pagination->getNextPage(); ?>/">Suivant</a></li>
    </ul>
</nav>