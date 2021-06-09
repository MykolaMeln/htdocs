<?php
include 'functions.php';
session_start();
?>
<?=template_headerr('Workagency', $_SESSION["session_name"])?>

<body>
   <div class="content" style="width:500px; height:400px;">
	 <h3 align="center">Change Login</h3>
	 <form method="post" action="ch_login.php">
					 <label>Old Login</label>
					 <input type="text" name="login" class="form-control" autofocus="autofocus" required>
					 <br />
					 <label>New Login</label>
					 <input type="text" name="login2" class="form-control" required>
           <br />
           <input type="submit" name="change1" value="Change Login" class="btn btn-info" />
					 <br />
    </form>
    <br />
    <br />
     <h3 align="center">Change Password</h3>
    <form method="post" action="ch_pass.php">
					 <br />
           <label>Old Password</label>
					 <input type="password" name="password" class="form-control" required>
					 <br />
					 <label>New Password</label>
					 <input type="password" name="password2" class="form-control" required>
					 <br />
					 <input type="submit" name="change2" value="Change Password" class="btn btn-info" />
					 <br />
    </form>
</div>
</body>

<?=template_footerr('Workagency')?>
