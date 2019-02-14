<?php 

$title = 'Administration'; 

?>

<?php ob_start(); ?>
<h1>Administration</h1>

<form method="post">
    <textarea id="mytextarea">Hello, World!</textarea>
  </form>


<?php $content = ob_get_clean(); ?>

<?php require(dirname(__DIR__) . '/template.php'); ?>