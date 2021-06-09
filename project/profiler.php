<?php
include 'functions.php';
session_start();
?>

<?=template_headerr('Workagency', $_SESSION["session_name"])?>
<div style="height:200px;" class="content">
<h2 align=center>Login: <span><?php echo $_SESSION['session_name'];?>! </span></h2>
<br />
<div align=center>
<button class="btn btn-li"><a href="change_datar.php" class="submit"><h5>Change Users Data</h5></a></button>
</div>
</div>
<?=template_footerr()?>
