<?php 

namespace Math\projet04;

use Math\projet04\Model\PostManager;
use Math\projet04\Model\Pagination;

require_once(dirname(__DIR__) . '/model/Manager.php');
require_once(dirname(__DIR__) . '/model/PostManager.php'); 
require_once(dirname(__DIR__) . '/model/Pagination.php');


if (!isset($_GET['pageNb'])) {
    $_GET['pageNb'] = 1;
} elseif (isset($_GET['pageNb']) && $_GET['pageNb'] < 1) {
    $_GET['pageNb'] = 1;
}

$data = new PostManager();

$totalNbRows = $data->count();

$pagination = new Pagination($_GET['pageNb'], $totalNbRows, $_SERVER['PHP_SELF'], $_SERVER['argv'], PostManager::NB_POST_BY_PAGE);

$posts = $data->listPosts($pagination->getFirstEntry());


?>

<?php ob_start(); ?>

<?php require(dirname(__DIR__) . '/view/frontend/home.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php require(dirname(__DIR__) . '/view/frontend/template.php'); ?>