<?php
	session_start();
?>

<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

	if(isset($_POST["signin"])){

			if(!empty($_POST['login']) && !empty($_POST['password'])) {
				$login = $_POST['login'];
				$password = md5($_POST['password']);
				//$password = $_POST['password'];
				$stmt = $pdo->prepare('SELECT * FROM users WHERE Login = :login AND Password = :password');
				$stmt->bindParam(':login', $login, PDO::PARAM_STR);
				$stmt->bindParam(':password', $password, PDO::PARAM_STR);
				$stmt->execute();

      	$row = $stmt->fetch();

				if ($row>0)
				{
					session_start();
					$_SESSION['session_id'] = $row['ID_User'];
					$_SESSION['session_name'] = $row['Login'];
					if($row['ID_Role'] == 3)
					{
					header('location:homee.php');
				  }
					if($row['ID_Role'] == 4)
					{
					header('location:homer.php');
					}
					if($row['ID_Role'] == 1)
					{
					header('location:homead.php');
					}
					if($row['ID_Role'] == 2)
					{
					header('location:homem.php');
					}

				}
  		else
			{
				?>
				<script>
				alert("The combination of User Name and Password is invalid!")
				window.location="login.php";
			</script>
			<?php
		 }
	}
	else {
    $message = "All fields are required!";
	}
}
?>
