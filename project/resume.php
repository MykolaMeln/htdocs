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

if($employee > 0)
{
if($employee['ID_Work'] != null)
{
    $stmt = $pdo->prepare('SELECT * FROM employees WHERE ID_User = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $employee = $stmt->fetch();

    $stmt2 = $pdo->prepare('SELECT * FROM employeedata WHERE ID_Employee = :id');
    $stmt2->bindParam(':id', $employee['ID_Employee'], PDO::PARAM_STR);
    $stmt2->execute();

    $employeed = $stmt2->fetch();

    $stmt3 = $pdo->prepare('SELECT * FROM education WHERE ID_Education = :id');
    $stmt3->bindParam(':id', $employeed['ID_Education'], PDO::PARAM_INT);
    $stmt3->execute();

    $education = $stmt3->fetch();

    $stmt3 = $pdo->prepare('SELECT * FROM works WHERE ID_Work = :id');
    $stmt3->bindParam(':id', $employee['ID_Work'], PDO::PARAM_INT);
    $stmt3->execute();

    $works = $stmt3->fetch();
  }
else {
  ?>
  <script>
  alert("You don`t have a work, Please Add Your Data!")
  window.location="add_resume.php";
</script>
<?php
}
}
else {
  ?>
  <script>
  alert("You don`t data, Please Add Your Data!")
  window.location="add_datae.php";
 </script>
 <?php
}
?>

<?=template_headere('Your Work',  $_SESSION["session_name"])?>
<br />
<br />
<div class="content2 update">
    <button class="btn btn-li"><a href="vacancies.php" class='submit'><h5>Vacancies</h5></a></button>
    <h2>Your Resume</h2>
    <form method="post" style="width:850px; height:400px;">
      <label>First Name</label>
      <input type="text" name="firsname" class="form-control" value="<?=$employee['FirstName']?>" readonly>
      <br />
      <label>Last Name</label>
      <input type="text" name="lasname" class="form-control" value="<?=$employee['LastName']?>" readonly>
      <br />
      <label>Phone Number</label>
      <input type="text" name="phone" class="form-control" value="<?=$employeed['PhoneNumber']?>" readonly>
      <br />
      <label>Email</label>
      <input type="text" name="email" class="form-control" value="<?=$employeed['Email']?>" readonly>
      <br />
      <label>Education</label>
      <input type="text" name="education" class="form-control" value="<?=$education['Education']?>" readonly>
      <br />
      <label>Date of appeal</label>
      <input type="text" name="dateof" class="form-control" value="<?=$employee['Date_of_appeal']?>" readonly>
      <br />
      <label>NameWork</label>
      <input type="text" name="namew" class="form-control" value="<?=$works['NameWork']?>" readonly>
      <br />
      <label>Result</label>
      <input type="text" name="result" class="form-control" value="<?=$employee['Result']?>" readonly>
    </form>
</div>

<?=template_footere()?>
