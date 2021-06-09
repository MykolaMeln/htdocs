<?php
session_start();
?>

<?php
include 'functions.php';

$pdo = pdo_connect_mysql();


if(isset($_POST['adddata'])){

  $id = $_SESSION['session_id'];
  $firsname = $_POST["firsname"];
  $lasname = $_POST["lasname"];
  $midname = $_POST["midname"];
  $dateofb = $_POST["dateofb"];
  $city = $_POST["city"];
  $registr = $_POST["registr"];
  $phone = $_POST["phone"];
  $email = $_POST["email"];
  $education = $_POST['education'];


  $insert_query = "INSERT INTO employees (FirstName, LastName, MiddleName, ID_User) VALUES (?, ?, ?, ?)";

  $insert = $pdo->prepare($insert_query);
  $insert->execute(array($firsname, $lasname, $midname, $id));

  $insert_query2 = "INSERT INTO employeedata (Date_of_birth, City, RegistrationAddress, PhoneNumber, Email, ID_Education) VALUES (?, ?, ?, ?, ?, ?)";

  $insert2 = $pdo->prepare($insert_query2);
  $insert2->execute(array($dateofb, $city, $registr, $phone, $email, $education));


  echo "<script>alert('Data successfully added!'); window.location='employeedata.php'</script>";
}
?>

<?=template_headere('Your Data',  $_SESSION["session_name"])?>

<div class="content2 update">
    <h2>Your Data</h2>
    <form method="post" style="width:850px;">
      <label>First Name</label>
      <input type="text" name="firsname" class="form-control" required>
      <br />
      <label>Last Name</label>
      <input type="text" name="lasname" class="form-control" required>
      <br />
      <label>Middle Name</label>
      <input type="text" name="midname" class="form-control">
      <br />
      <label>Date of birthday</label>
      <input type="date" name="dateofb" min="1950-01-01" max="2003-01-01" class="form-control" required>
      <br />
      <label>City</label>
      <input type="text" name="city" class="form-control" required>
      <br />
      <label>Registration</label>
      <input type="text" name="registr" class="form-control"required>
      <br />
      <label>Phone Number</label>
      <input type="text" name="phone" class="form-control" required>
      <br />
      <label>Email</label>
      <input type="text" name="email" class="form-control" required>
      <br />
      <label>Education</label>
      <select name="education" align=center class="form-control" style="width:401px;">
        <option value="1">None</option>
        <option value="2">Secondary education</option>
        <option value="3">Upper secondary education</option>
        <option value="4">Post-secondary non-tertiary education</option>
        <option value="5">Higher Education</option>
      </select>
      <input type="submit" name="adddata" value="Add" class="btn btn-info" />
    </form>
</div>

<?=template_footere()?>
