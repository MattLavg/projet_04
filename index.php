<?php

if (isset($_GET['page'])) {

    if ($_GET['page'] === 'home') {
        require(__DIR__ . '/view/frontend/listPostsView.php');
    } elseif ($_GET['page'] === 'admin') {
        require(__DIR__ . '/view/backend/adminView.php');
    } elseif ($_GET['page'] === 'single') {
        require(__DIR__ . '/view/frontend/postView.php');
    }

} else {

    require(__DIR__ . '/view/frontend/listPostsView.php');

}
