<?php
session_start();
?>

<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

$id = $_SESSION["session_id"];

$stmt = $pdo->prepare('SELECT * FROM employers WHERE ID_User = :id');
$stmt->bindParam(':id', $id, PDO::PARAM_STR);
$stmt->execute();

$employer = $stmt->fetch();

if($employer['ID_User'] != null)
{
	if(isset($_POST["updater"])){

    $stmt = $pdo->prepare('UPDATE employers SET NameCompany = :namec, Address = :addr, PhoneNumber = :phone, Email = :email WHERE ID_User = :id');
    $stmt->bindParam(':namec', $_POST['orgname'], PDO::PARAM_STR);
    $stmt->bindParam(':addr', $_POST['address'], PDO::PARAM_STR);
    $stmt->bindParam(':phone', $_POST['phone'], PDO::PARAM_STR);
    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $msg = 'Updated Successfully!';

    $stmt = $pdo->prepare('SELECT * FROM employers WHERE ID_User = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();

    $employer = $stmt->fetch();
  }
  else {
    $stmt = $pdo->prepare('SELECT * FROM employers WHERE ID_User = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();

    $employer = $stmt->fetch();
  }
}
else {
  ?>
  <script>
  alert("You don`t have a data, Please Add Your Data!")
  window.location="add_datar.php";
</script>
<?php
}

?>

<?=template_headerr('Your Data',  $_SESSION["session_name"])?>
<br />
<br />
<div class="content2 update">
    <h2>Your Data</h2>
    <form method="post" style="width:500px; height:475px;">
      <label>Name Company</label>
      <input type="text" name="orgname" class="form-control" value="<?=$employer['NameCompany']?>" required>
      <br />
      <label>Address</label>
      <input type="text" name="address" class="form-control" value="<?=$employer['Address']?>" required>
      <br />
      <label>Phone Number</label>
      <input type="text" name="phone" class="form-control" value="<?=$employer['PhoneNumber']?>" required>
      <br />
      <label>Email</label>
      <input type="text" name="email" class="form-control" value="<?=$employer['Email']?>" required>
      <br />
      <input type="submit" name="updater" value="Update"  align=center class="btn btn-info" />
      <br />
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footerr()?>
