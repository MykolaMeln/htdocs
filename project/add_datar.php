<?php
session_start();
?>

<?php
include 'functions.php';

$pdo = pdo_connect_mysql();


if(isset($_POST['adddata'])){

  $id = $_SESSION['session_id'];
  $name = $_POST["orgname"];
  $addr = $_POST["address"];
  $phone = $_POST["phone"];
  $email = $_POST["email"];

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $insert_query = "INSERT INTO employers (NameCompany, Address, PhoneNumber, Email, ID_User) VALUES (?, ?, ?, ?, ?)";

  $insert = $pdo->prepare($insert_query);
  $insert->execute(array($name, $addr, $phone, $email, $id));

  echo "<script>alert('Data successfully added!'); window.location='employerdata.php'</script>";
}
?>

<?=template_headerr('Workagency', $_SESSION["session_name"])?>

<body>
	<br /><br />
<div class="content2 update">
    <h2>Your Data</h2>
    <form method="post" style="width:500px;">
      <label>Name Company</label>
      <input type="text" name="orgname" class="form-control" required>
      <br />
      <label>Address</label>
      <input type="text" name="address" class="form-control" required>
      <br />
      <label>Phone Number</label>
      <input type="text" name="phone" class="form-control"  placeholder="+380678597465" required>
      <br />
      <label>Email</label>
      <input type="text" name="email" class="form-control" placeholder="mymail@mail.com" required>
      <br />
      <input type="submit" name="adddata" value="Add" align=center class="btn btn-info" />
      <br />
    </form>

</div>
</body>

<?=template_footerr('Workagency')?>
