<?php

use Math\projet04\model\PostManager;
use Math\projet04\model\CommentManager;
use Math\projet04\model\Authentication;

// require_once(__DIR__ . '/model/Autoloader.php');
// Autoloader::register;

require_once(__DIR__ . '/model/Manager.php');
require_once(__DIR__ . '/model/PostManager.php');
require_once(__DIR__ . '/model/CommentManager.php');
require_once(__DIR__ . '/model/Authentication.php');

session_start();

if (!isset($_SESSION['login'])) {
    $_SESSION['login'] = FALSE;
}


if (isset($_GET['page'])) {

    if ($_GET['page'] === 'home') {

        require(__DIR__ . '/view/frontend/listPostsView.php');

    } elseif ($_GET['page'] === 'authentication') {

        require(__DIR__ . '/view/frontend/login.php');

    } elseif ($_GET['page'] === 'admin') {

        if (isset($_POST['login']) || $_SESSION['login']) {

            if (isset($_POST['name']) && isset($_POST['password'])) {
                $req = new Authentication();
                $checkLogin = $req->checkLogin();
                $checkLogin = $checkLogin->fetch();
                
                if ($_POST['name'] == $checkLogin['name'] && $_POST['password'] == $checkLogin['password']) {

                    $_SESSION['login'] = TRUE;

                    require(__DIR__ . '/view/backend/addAndUpdatePostView.php');
                }

            }

            if (isset($_GET['param'])) {
    
                if ($_GET['param'] === 'addPost') {
    
                    if (isset($_POST['newPost'])) {
                        $newPost = new PostManager();
                        $newPostId = $newPost->addPost($_POST['title'], $_POST['author'], $_POST['content']);
    
                        if ($newPostId > 0) {
                            header('Location: index.php?page=admin&param=addPost&affectedLines=true');
                        } 
                    }
    
                    return require(__DIR__ . '/view/backend/addAndUpdatePostView.php');
                }
    
                if ($_GET['param'] === 'updatePost') {
    
                    // Pour afficher infos déjà présentes
                    if (isset($_GET['post_id'])) {
    
                        header('Location: index.php?page=admin&param=updatePost&updatePostId=' . $_GET['post_id']);
    
                    } elseif (isset($_POST['newUpdatePost'])) {
                        $updatePost = new PostManager();
                        $updatePost->updatePost($_POST['id'], $_POST['title'], $_POST['content']);
    
                        header('Location: index.php?page=admin&param=postView&post_id=' . $_POST['id']);
                    }
    
                    return require(__DIR__ . '/view/backend/addAndUpdatePostView.php');
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
    
                if ($_GET['param'] === 'deleteComment') {
    
                    if (isset($_GET['comment_id'])) {
                        $deleteComment = new CommentManager();
                        $deleteComment->deleteComment($_GET['comment_id']);
    
                        if (isset($_GET['postView'])) {
                            header('Location: index.php?page=admin&param=postView&postId=' . $_GET['post_id']);
                        }
    
                        if (isset($_GET['reportedCommentsView'])) {
                            header('Location: index.php?page=admin&param=reportedCommentsView');
                        }
                        
                    }
    
                    return require(__DIR__ . '/view/backend/postView.php');
                }
        
                if ($_GET['param'] === 'reportedCommentsView') {
                    return require(__DIR__ . '/view/backend/reportedCommentsView.php');
                }

                if ($_GET['param'] === 'signOut') {
    
                    session_destroy();
                    return require(__DIR__ . '/view/frontend/listPostsView.php');
                }
            }

        } else {
            echo 'Veuillez indiquer vos nom et mot de passe pour accéder à la page d\'administration du site<br>';
            echo '<a href="index.php?page=home">Retour à l\'accueil</a>';
        }

        

        

        // require(__DIR__ . '/view/backend/addAndUpdatePostView.php');
        // require(__DIR__ . '/view/frontend/listPostsView.php');

    } elseif ($_GET['page'] === 'postView') {

        if (isset($_POST['newComment'])) {
            $newComment = new CommentManager();
            $newComment->addComment($_POST['post_id'], $_POST['author'], $_POST['content']);

            header('Location: index.php?page=postView&id=' . $_POST['post_id']);
        } 

        if (isset($_GET['param'])) {

            if ($_GET['param'] === 'reportComment') {

                if (isset($_GET['comment_id']) && isset($_GET['post_id'])) {
                    $reportComment = new CommentManager();
                    $reportComment->reportComment($_GET['comment_id']);
    
                    header('Location: index.php?page=postView&id=' . $_GET['post_id']);
                }
    
                return require(__DIR__ . '/view/frontend/postView.php');
            }
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
