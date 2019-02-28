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

        if (isset($_GET['param'])) {

            if ($_GET['param'] === 'addPost') {

                if (isset($_POST['newPost'])) {
                    $newPost = new PostManager();
                    $newPostId = $newPost->addPost($_POST['title'], $_POST['author'], $_POST['content']);

                    if ($newPostId > 0) {
                        header('Location: index.php?page=admin&param=addPost&affectedLines=true');
                    } 
                }

                return require(__DIR__ . '/view/backend/addPostView.php');
            }

            if ($_GET['param'] === 'updatePost') {

                if (isset($_POST['updatePost'])) {
                    $updatePost = new PostManager();
                    $updatePost->updatePost($_POST['id'], $_POST['title'], $_POST['content']);

                    header('Location: index.php?page=admin&post_id=' . $_POST['id']);

                } elseif (isset($_GET['post_id'])) {

                    header('Location: index.php?page=admin&post_id=' . $_GET['post_id']);
                }

                return require(__DIR__ . '/view/backend/addPostView.php');
            }
    
            if ($_GET['param'] === 'deletePost') {

                if (isset($_GET['post_id'])) {
                    $deletePost = new PostManager();
                    $deletePost->deletePostAndComments($_GET['post_id']);
                }

                return require(__DIR__ . '/view/backend/postManagement.php');
            }

            if ($_GET['param'] === 'manageListPosts') {

                return require(__DIR__ . '/view/backend/postManagement.php');
            }

            if ($_GET['param'] === 'postView') {

                if (isset($_GET['post_id'])) {
                    header('Location: index.php?page=admin&param=postView&postId=' . $_GET['post_id']);
                }

                return require(__DIR__ . '/view/backend/postView.php');
            }
    
            if ($_GET['param'] === 'comments') {
                return require(__DIR__ . '/view/backend/commentsView.php');
            }
        }

        require(__DIR__ . '/view/backend/addPostView.php');

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
