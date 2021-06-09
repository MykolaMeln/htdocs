<?php
include 'functions.php';
?>
<?=template_header('Workagency')?>

<body>
	<br /><br />
   <div class="container" style="width:500px;">
	 <h3 align="center">Log in</h3>
	 <form method="post" action="loginsc.php">
					 <label>Login</label>
					 <input type="text" name="login" class="form-control" autofocus="autofocus" required>
					 <br />
					 <label>Password</label>
					 <input type="password" name="password" class="form-control" required>
					 <br />
					 <input type="submit" name="signin" value="Log in"  align=center class="btn btn-info" />
						<br />
	 </form>
</div>
</body>

<?=template_footer('Workagency')?>
