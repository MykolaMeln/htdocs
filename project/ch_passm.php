<?php
session_start();
?>

<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

	if(isset($_POST["change2"])){

      $id = $_SESSION["session_id"];

      $stmt = $pdo->prepare('SELECT * FROM users WHERE ID_User = :id');
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      $row = $stmt->fetch();

			if((!empty($_POST['password']) and !empty($_POST['password2'])) and (md5($_POST['password']) == $row['Password'])) {
				$password = md5($_POST['password2']);
        $id = $_SESSION["session_id"];

				$stmt2 = $pdo->prepare('UPDATE users SET Password = :password WHERE ID_User = :id');
				$stmt2->bindParam(':password', $password, PDO::PARAM_STR);
				$stmt2->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt2->execute();

        $msg = 'Updated Successfully!';
				session_start();
        header('location:homem.php');

				}
        else
  			{
  				?>
  				<script>
  				alert("Passwords do not match!")
  				window.location="change_datam.php";
  			</script>
  			<?php
  		 }
  	}
  	else {
      $message = "All fields are required!";
  	}
?>
