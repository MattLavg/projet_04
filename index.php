<?php

use Math\projet04\model\PostManager;

// require_once(__DIR__ . '/model/Autoloader.php');
// Autoloader::register;

require_once(__DIR__ . '/model/Manager.php');
require_once(__DIR__ . '/model/PostManager.php');


if (isset($_GET['page'])) {

    if ($_GET['page'] === 'home') {
        require(__DIR__ . '/view/frontend/listPostsView.php');
    } elseif ($_GET['page'] === 'admin') {

        if (isset($_POST['newPost'])) {
            $newPost = new PostManager();
            $newPost->addPost($_POST['title'], $_POST['author'], $_POST['content']);
        }

        if (isset($_POST['updatePost'])) {
            $updatePost = new PostManager();
            $updatePost->updatePost($_POST['id'], $_POST['title'], $_POST['author'], $_POST['content']);
        }
        require(__DIR__ . '/view/backend/adminView.php');

    } elseif ($_GET['page'] === 'single') {
        require(__DIR__ . '/view/frontend/postView.php');
    } elseif ($_GET['page'] === 'updatePost') {
        require(__DIR__ . '/view/backend/updatePostView.php');
    } elseif ($_GET['page'] === 'adminPostView') {
        require(__DIR__ . '/view/backend/adminPostView.php');
    }

} elseif (isset($_GET['deleting'])) {

    require(__DIR__ . '/view/backend/adminPostsView.php');

}  else {

    require(__DIR__ . '/view/frontend/listPostsView.php');

}
