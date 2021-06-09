<?php
session_start();
?>
<?php
include 'functions.php';

$pdo = pdo_connect_mysql();
if (isset($_POST['add'])) {

  $idw = null;

  $stmt = $pdo->prepare('SELECT * FROM employers WHERE ID_User = :id');
  $stmt->bindValue(':id', $_SESSION['session_id'], PDO::PARAM_INT);
  $stmt->execute();

  $user = $stmt->fetch();

  $id = $user['ID_Employer'];

  $stmt = $pdo->prepare('SELECT * FROM works WHERE NameWork = :name');
  $stmt->bindValue(':name', $_POST['namew'], PDO::PARAM_STR);
	$stmt->execute();

  $works = $stmt->fetch();

  if($works > 0)
  {
    $idw = $works['ID_Work'];
  }
  else {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $insert_query = "INSERT INTO works (ID_Work, NameWork) VALUES (?, ?)";

    $insert = $pdo->prepare($insert_query);
    $insert->execute(array(null, $_POST['namew']));

    $stmt = $pdo->prepare('SELECT * FROM works WHERE NameWork = :name');
    $stmt->bindValue(':id', $_POST['namew'], PDO::PARAM_STR);
    $stmt->execute();

    $work1 = $stmt->fetch();

    $idw = $work1['ID_Work'];
  }

   $datetime = date_create()->format('Y-m-d H:i:s');
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $insert_query = "INSERT INTO vacancies (ID_Employer, Date_of_placing, ID_Work, Salary, Work_schedule, StateOfVacancy) VALUES (?, ?, ?, ?, ?,?)";
   $insert = $pdo->prepare($insert_query);
   $insert->execute(array($id, $datetime, $idw, $_POST['salary'], $_POST['worksh'], 'Available'));

   echo "<script>alert('Vacancy successfully added!'); window.location='myvacancies.php'</script>";
 }
?>

<?=template_headerr('Workagency', $_SESSION["session_name"])?>

<body>
	<br /><br />
   <div class="container" style="width:500px;">
    <h3 align="center">Add Vacancy</h3>
    <form method="post">
        <label for="work">Name of Work</label>
        <input type="text" name="namew"  class="form-control" placeholder="Barista" autofocus=autofocus required>
        <br />
        <label for="sallary">Salary</label>
        <input type="text" name="salary"  class="form-control" placeholder="12000" required>
        <br />
        <label for="worksh">Work schedule</label>
        <input type="text" name="worksh"  class="form-control"  placeholder="18:00-23:00" required>
        <br />
        <input type="submit" name="add" value="Add Vacancy" class="btn btn-info" />
        <br />
    </form>
  </div>
</body>

<?=template_footerr('Workagency')?>
