<?php 

namespace Math\projet04;

use Math\projet04\Model\PostManager;

// require_once(__DIR__ . '/model/Autoloader.php');
// Autoloader::register;

require_once(dirname(dirname(__DIR__)) . '/model/Manager.php');
require_once(dirname(dirname(__DIR__)) . '/model/PostManager.php');



$title = 'Ajout d\'articles'; 


if (isset($_GET['updatePostId'])) {

    $data = new PostManager();
    $updatePost = $data->getPost($_GET['updatePostId']);
    $updatePost = $updatePost->fetch();

}

if ($_SESSION['login']) {}

    ?>

    <?php ob_start(); ?>

    


<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/template.php'); ?>