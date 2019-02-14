<?php

if (isset($_GET['page'])) {

    if ($_GET['page'] === 'home') {
        require(__DIR__ . '/view/frontend/listPostsView.php');
    } else if ($_GET['page'] === 'admin') {
        require(__DIR__ . '/view/backend/adminView.php');
    }

} else {

    require(__DIR__ . '/view/frontend/listPostsView.php');

}
