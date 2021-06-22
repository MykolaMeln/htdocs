<?php
session_start();
?>
<?php
include 'functions.php';
$pdo = pdo_connect_mysql();


$stmt = $pdo->prepare('SELECT * FROM employers WHERE ID_User = :id');
$stmt->bindValue(':id', $_SESSION['session_id'], PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch();

if($user > 0 )
{
$id = $user['ID_Employer'];

$stmt2 = $pdo->prepare('SELECT * FROM vacancies WHERE ID_Employer = :id ORDER BY ID_Vacancy');
$stmt2->bindValue(':id', $id, PDO::PARAM_INT);
$stmt2->execute();

$vacancies = $stmt2->fetchAll(PDO::FETCH_ASSOC);
}
	else {
	  ?>
	  <script>
	  alert("You don`t data, Please Add Your Data!")
	  window.location="add_datar.php";
	 </script>
	 <?php
	}
?>
<?=template_headerr('Vacancies', $_SESSION['session_name'])?>

<div class="content2 work">
	<h2>My Vacancies</h2>
	<a href="createv.php" class="create-work">Add Vacancy</a>
	<table>
        <thead>
            <tr>
                <td>Employer Name</td>
                <td>ID_Work</td>
                <td>Salary</td>
                <td>Work_schedule</td>
                <td>State of Vacancy</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vacancies as $vacancy): ?>
            <tr>
                <td><?=$_SESSION['session_name']?></td>
                <td><?=$vacancy['ID_Work']?></td>
                <td><?=$vacancy['Salary']?></td>
                <td><?=$vacancy['Work_schedule']?></td>
                <td><?=$vacancy['StateOfVacancy']?></td>
                <td class="actions">
                    <a href="updatev.php?id=<?=$vacancy['ID_Vacancy']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="deletev.php?id=<?=$vacancy['ID_Vacancy']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<br />

<?=template_footerr()?>
