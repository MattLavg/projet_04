<?php 

namespace Math\projet04;

use Math\projet04\Model\PostManager;
use Math\projet04\Model\CommentManager;
use Math\projet04\Model\Pagination;

// require_once(dirname(dirname(__DIR__)) . '/model/Manager.php');
// require_once(dirname(dirname(__DIR__)) . '/model/PostManager.php');
// require_once(dirname(dirname(__DIR__)) . '/model/CommentManager.php');
// require_once(dirname(dirname(__DIR__)) . '/model/Pagination.php');


// if (!isset($_GET['pageNb'])) {
//     $_GET['pageNb'] = 1;
// }

// $data = new PostManager();
// $post = $data->getPost($_GET['id']);
// $post = $post->fetch();

// $dataComments = new CommentManager();
// $totalNbRows = $dataComments->count($_GET['id']);

// $pagination = new Pagination($_GET['pageNb'], $totalNbRows, $_SERVER['PHP_SELF'], $_SERVER['argv'], CommentManager::NB_COMMENTS_BY_PAGE);

// $comments = $dataComments->listComments($_GET['id'], $pagination->getFirstEntry());


?>

<?php ob_start(); ?>

<?php require(VIEW . '/frontend/post.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php require(VIEW . '/frontend/template.php'); ?>