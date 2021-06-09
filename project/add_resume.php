<?php
session_start();
?>

<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

$id = $_SESSION["session_id"];
if(isset($_POST['adddata'])){

  $stmt = $pdo->prepare('SELECT * FROM works WHERE NameWork = :name');
  $stmt->bindValue(':name', $_POST['namework'], PDO::PARAM_STR);
  $stmt->execute();

  $work = $stmt->fetch();
  if($work > 0)
  {
     $idw = $work['ID_Work'];
  }
  else {

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $insert_query = "INSERT INTO works (ID_Work, NameWork) VALUES (?, ?)";

    $insert = $pdo->prepare($insert_query);
    $insert->execute(array(null, $_POST['namework']));

    $stmt2 = $pdo->prepare('SELECT * FROM works WHERE NameWork = :name');
    $stmt2->bindValue(':name', $_POST['namework'], PDO::PARAM_STR);
    $stmt2->execute();

    $work2 = $stmt2->fetch();
    $idw = $work2['ID_Work'];
  }
  $date = date_create()->format('Y-m-d');

  $stmt = $pdo->prepare('UPDATE employees SET Date_of_appeal = :dateof, ID_Work = :idw, Result = :result WHERE ID_User = :id');
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->bindValue(':dateof', $date, PDO::PARAM_STR);
  $stmt->bindValue(':idw', $idw, PDO::PARAM_INT);
  $stmt->bindValue(':result', 'In process', PDO::PARAM_STR);
  $stmt->execute();

    header('Location: resume.php');
}
?>

<?=template_headere('Create Resume',  $_SESSION["session_name"])?>
<br />
<br />
<div class="content2 update">
    <h2>Your Resume</h2>
    <form method="post" style="width:850px; height:100px;">
      <label>Name Work</label>
      <input type="text" name="namework" class="form-control" required>
      <br />
      <input type="submit" name="adddata" value="Create" class="btn btn-info" />
      <br />
      <br />
    </form>
</div>

<?=template_footere()?>
