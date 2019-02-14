<?php 
namespace Math\projet04\Model;

require(dirname(dirname(__DIR__)) . '/model/PostManager.php'); 
?>


<?php ob_start(); ?>

<?php $title = 'Le blog de Jean Forteroche'; ?>

<?php $content = ob_get_clean(); ?>

<?php require(dirname(__DIR__) . '/template.php'); ?>