<?php
session_start();
?>

<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

	if(isset($_POST["change1"])){

			if((!empty($_POST['login']) and !empty($_POST['login2'])) and ($_POST['login'] == $_SESSION["session_name"])) {
				$login = $_POST['login'];
        $id = $_SESSION["session_id"];

        $login2 = $_POST['login2'];

        $stmt = $pdo->prepare('SELECT * FROM users WHERE Login = :login');
        $stmt->bindParam(':login', $login2, PDO::PARAM_STR);
        $stmt->execute();

        $logindb = $stmt->fetch();

        if(($login2 != $logindb['Login']))
        {
				$stmt2 = $pdo->prepare('UPDATE users SET Login = :login WHERE ID_User = :id');
				$stmt2->bindParam(':login', $login2, PDO::PARAM_STR);
				$stmt2->bindParam(':id', $id, PDO::PARAM_INT);
				$stmt2->execute();

        $msg = 'Updated Successfully!';
				session_start();
				$_SESSION['session_id'] = $id;
				$_SESSION['session_name'] = $login2;
        header('location:homem.php');
      }
      else {
        {
          ?>
          <script>
          alert("Login already exists!")
          window.location="change_datam.php";
        </script>
        <?php
        }
      }
				}
        else
  			{
  				?>
  				<script>
  				alert("Logins do not match!")
  				window.location="change_datam.php";
  			</script>
  			<?php
  		 }
  	}
  	else {
      $message = "All fields are required!";
  	}
?>
