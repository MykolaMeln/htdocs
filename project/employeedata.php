<?php
session_start();
?>

<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

$id = $_SESSION["session_id"];

$stmt = $pdo->prepare('SELECT * FROM employees WHERE ID_User = :id');
$stmt->bindParam(':id', $id, PDO::PARAM_STR);
$stmt->execute();

$employee = $stmt->fetch();

if($employee['ID_User'] != null)
{
	if(isset($_POST["updater"])){

    $stmt = $pdo->prepare('UPDATE employees SET FirstName = :firsname, LastName = :lasname, MidlleName = :midname WHERE ID_User = :id');
    $stmt->bindParam(':firsname', $_POST['firsname'], PDO::PARAM_STR);
    $stmt->bindParam(':lasname', $_POST['lasname'], PDO::PARAM_STR);
    $stmt->bindParam(':midname', $_POST['midname'], PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();


    $stmt = $pdo->prepare('UPDATE employeedata SET City = :city, RegistrationAddress = :registr, PhoneNumber = :phone, Email = :email WHERE ID_Employee = :id');
    $stmt->bindParam(':city', $_POST['city'], PDO::PARAM_STR);
    $stmt->bindParam(':registr', $_POST['registr'], PDO::PARAM_STR);
    $stmt->bindParam(':phone', $_POST['phone'], PDO::PARAM_STR);
    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt->bindParam(':id', $employee['ID_Employee'], PDO::PARAM_INT);
    $stmt->execute();

    $msg = 'Updated Successfully!';


    $stmt = $pdo->prepare('SELECT * FROM employees WHERE ID_User = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $employee = $stmt->fetch();

    $stmt2 = $pdo->prepare('SELECT * FROM employeedata WHERE ID_Employee = :id');
    $stmt2->bindParam(':id', $employee['ID_Employee'], PDO::PARAM_INT);
    $stmt2->execute();

    $employeed = $stmt2->fetch();

    $stmt3 = $pdo->prepare('SELECT * FROM education WHERE ID_Education = :id');
    $stmt3->bindParam(':id', $employed['ID_Education'], PDO::PARAM_INT);
    $stmt3->execute();

    $education = $stmt3->fetch();

  }
  else {
    $stmt = $pdo->prepare('SELECT * FROM employees WHERE ID_User = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $employee = $stmt->fetch();

    $stmt2 = $pdo->prepare('SELECT * FROM employeedata WHERE ID_Employee = :id');
    $stmt2->bindParam(':id', $employee['ID_Employee'], PDO::PARAM_INT);
    $stmt2->execute();

    $employeed = $stmt2->fetch();

    $stmt3 = $pdo->prepare('SELECT * FROM education WHERE ID_Education = :id');
    $stmt3->bindParam(':id', $employeed['ID_Education'], PDO::PARAM_STR);
    $stmt3->execute();

    $education = $stmt3->fetch();
  }
}
else {
  ?>
  <script>
  alert("You don`t have a data, Please Add Your Data!")
  window.location="add_datae.php";
</script>
<?php
}
?>

<?=template_headere('Your Data',  $_SESSION["session_name"])?>
<br />
<br />
<div class="content2 update">
    <h2>Your Data</h2>
    <form method="post" style="width:850px; height:470px;">
      <label>First Name</label>
      <input type="text" name="firsname" class="form-control" value="<?=$employee['FirstName']?>" required>
      <br />
      <label>Last Name</label>
      <input type="text" name="lasname" class="form-control" value="<?=$employee['LastName']?>" required>
      <br />
      <label>Middle Name</label>
      <input type="text" name="midname" class="form-control" value="<?=$employee['MiddleName']?>">
      <br />
      <label>Date of birthday</label>
      <input type="text" name="dateofb" class="form-control" value="<?=$employeed['Date_of_birth']?>" readonly>
      <br />
      <label>City</label>
      <input type="text" name="city" class="form-control" value="<?=$employeed['City']?>" required>
      <br />
      <label>Registration</label>
      <input type="text" name="registr" class="form-control" value="<?=$employeed['RegistrationAddress']?>" required>
      <br />
      <label>Phone Number</label>
      <input type="text" name="phone" class="form-control" value="<?=$employeed['PhoneNumber']?>" required>
      <br />
      <label>Email</label>
      <input type="text" name="email" class="form-control" value="<?=$employeed['Email']?>" required>
      <br />
      <label>Education</label>
      <input type="text" name="education" class="form-control" value="<?=$education['Education']?>" readonly>
      <br />
      <input type="submit" name="updater" value="Update"  align=center class="btn btn-info" />
      <br />
    </form>
</div>

<?=template_footere()?>
