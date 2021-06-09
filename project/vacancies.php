<?php
session_start();
?>
<?php
include 'functions.php';
$pdo = pdo_connect_mysql();


$stmt = $pdo->prepare('SELECT * FROM employees WHERE ID_User = :id');
$stmt->bindValue(':id', $_SESSION['session_id'], PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch();

$stmt2 = $pdo->prepare('SELECT * FROM works WHERE ID_Work = :id');
$stmt2->bindValue(':id', $user['ID_Work'], PDO::PARAM_INT);
$stmt2->execute();

$work = $stmt2->fetch();

$stmt2 = $pdo->prepare('SELECT * FROM vacancies WHERE ID_Work = :id AND StateOfVacancy != "Not Available" ORDER BY ID_Vacancy');
$stmt2->bindValue(':id', $work['ID_Work'], PDO::PARAM_INT);
$stmt2->execute();

$vacancies = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$stmt3 = $pdo->prepare('SELECT * FROM works WHERE ID_Work = :id');
$stmt3->bindParam(':id', $user['ID_Work'], PDO::PARAM_INT);
$stmt3->execute();

$works = $stmt3->fetch();

?>
<?=template_headere('Vacancies', $_SESSION['session_name'])?>

<div class="content2 work">
	<h2>Available Vacancies</h2>
	<table>
        <thead>
            <tr>
                <td>NameWork</td>
                <td>Salary</td>
                <td>Work_schedule</td>
                <td>State of Vacancy</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vacancies as $vacancy): ?>
            <tr>
                <td><?=$works['NameWork']?></td>
                <td><?=$vacancy['Salary']?></td>
                <td><?=$vacancy['Work_schedule']?></td>
                <td><?=$vacancy['StateOfVacancy']?></td>
                <td class="actions">
                    <a href="vacanciese.php?id=<?=$vacancy['ID_Vacancy']?>" class="edit"><i class="fas fa-thumbs-up"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<br />
<br />
<br />
<br />
<br />
<br />
<?=template_footere()?>
