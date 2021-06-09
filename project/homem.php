<?php
include 'functions.php';
session_start();

if(!isset($_SESSION["session_name"])):
header("location:login.php");
else:
?>

<?=template_headerm('Workagency', $_SESSION["session_name"])?>
<div class="content" style="height:200px;">
<h2 align=center>Welcome, <span><?php echo $_SESSION['session_name'];?>! </span></h2>
</div>

<?=template_footerm()?>

<?php endif; ?>
