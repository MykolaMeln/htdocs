<?php
session_start();
?>
<?php
include 'functions.php';

$pdo = pdo_connect_mysql();
if (isset($_POST['register'])) {
  $login = $_POST['login'];
  $password = md5($_POST['password']);
  $role = null;

  $stmt = $pdo->prepare('SELECT * FROM users WHERE Login = :login');
  $stmt->bindParam(':login', $login, PDO::PARAM_STR);
	$stmt->execute();

  $num_login = $stmt->fetch();

if($login != $num_login['Login'])
 {
   if($_POST['role'] == 'Employee')
   {
     $role = 3;
   }
   else {
    $role = 4;
   }

   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $insert_query = "INSERT INTO users (Login, Password, ID_Role) VALUES (?, ?, ?)";

   $insert = $pdo->prepare($insert_query);
   $insert->execute(array($login, $password, $role));

   echo "<script>alert('Account successfully added!'); window.location='users.php'</script>";
 }
else {
  ?>
  <script>
  alert("The Login already exists. Please change!")
  window.location="users.php";
</script>
<?php
}

}
?>

<?=template_headerad('Workagency', $_SESSION["session_name"])?>

<body>
	<br /><br />
   <div class="container" style="width:500px;">
    <h3 align="center">Add User</h3>
    <form method="post">
            <label>Login</label>
            <input type="text" name="login" class="form-control" autofocus="autofocus" required>
            <br />
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
            <br />
            <p>Register as
						<select name="role" class="form-control">
							<option value="Employee">Employee</option>
							<option value="Employer">Employer</option>
						</select></p>
            <input type="submit" name="register" value="Add User" class="btn btn-info" />
            <br />
    </form>
  </div>
</body>

<?=template_footerad('Workagency')?>
