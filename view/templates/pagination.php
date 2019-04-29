<?php

if ($this->getCurrentUrl() == NULL) {
    $this->setCurrentUrl('home');
}

?>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="<?= $this->getCurrentUrl(); ?>/pageNb/<?= $this->getPreviousPage(); ?>/">Précédent</a>
        </li>
        <?php

        for ($i = 1; $i <= $this->getTotalPages(); $i++) {

            if ($i == $this->getCurrentPage()) {
                echo '<li class="page-item active"><span class="page-link">'. $i .'<span class="sr-only">(current)</span></span></li>';
            } elseif ($this->getCurrentPage() - $i <= 2 && $this->getCurrentPage() - $i >= -2) {
                echo '<li class="page-item"><a class="page-link" href="' . $this->getCurrentUrl() . '/pageNb/' . $i . '/">'. $i .'</a></li>';
            } 
        }
        ?>
        <li class="page-item"><a class="page-link" href="<?= $this->getCurrentUrl(); ?>/pageNb/<?= $this->getNextPage(); ?>/">Suivant</a></li>
    </ul>
</nav>