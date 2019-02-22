<?php

use Math\projet04\model\PostManager;
use Math\projet04\model\CommentManager;

// require_once(__DIR__ . '/model/Autoloader.php');
// Autoloader::register;

require_once(__DIR__ . '/model/Manager.php');
require_once(__DIR__ . '/model/PostManager.php');
require_once(__DIR__ . '/model/CommentManager.php');


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
            $updatePost->updatePost($_POST['id'], $_POST['title'], $_POST['content']);
        }

        if (isset($_GET['delete'])) {
            $deletePost = new PostManager();
            $deletePost->deletePost($_GET['post_id']);
        }

        require(__DIR__ . '/view/backend/adminView.php');

    } elseif ($_GET['page'] === 'postView') {

        if (isset($_POST['newComment'])) {
            $newComment = new CommentManager();
            $newComment->addComment($_POST['post_id'], $_POST['author'], $_POST['content']);

            header('Location: index.php?page=postView&id=' . $_POST['post_id']);
        } 
        
        require(__DIR__ . '/view/frontend/postView.php');

    } elseif ($_GET['page'] === 'updatePost') {
        require(__DIR__ . '/view/backend/updatePostView.php');
    } elseif ($_GET['page'] === 'adminPostView') {

        if (isset($_GET['deleteComment'])) {
            $newComment = new CommentManager();
            $newComment->deleteComment($_GET['comment_id']);
            
            header('Location: index.php?page=adminPostView&id=' . $_GET['id']);
        } 

        require(__DIR__ . '/view/backend/adminPostView.php');
    }

} elseif (isset($_GET['deleting'])) {

    require(__DIR__ . '/view/backend/adminPostsView.php');

}  else {

    require(__DIR__ . '/view/frontend/listPostsView.php');

}
