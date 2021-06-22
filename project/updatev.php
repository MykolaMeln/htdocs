<?php
session_start();
?>

<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

if (isset($_GET['id'])) {
    if (!empty($_POST)) {

        $stmt = $pdo->prepare('UPDATE vacancies SET ID_Work = :idw, Salary = :salary, Work_schedule = :worksh, StateOfVacancy = :state WHERE ID_Vacancy = :id');
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->bindParam(':idw', $_POST['idw'], PDO::PARAM_INT);
        $stmt->bindParam(':salary', $_POST['salary'], PDO::PARAM_STR);
        $stmt->bindParam(':worksh', $_POST['worksh'], PDO::PARAM_STR);
        $stmt->bindParam(':state', $_POST['state'], PDO::PARAM_STR);

        $stmt->execute();

        header('Location: myvacancies.php');

    }
    $stmt2 = $pdo->prepare('SELECT * FROM vacancies WHERE ID_Vacancy = ?');
    $stmt2->execute([$_GET['id']]);
    $vacancy = $stmt2->fetch();
    if (!$vacancy) {
        exit('Work doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_headerr('Update', $_SESSION['session_name'])?>

<div class="content2 update"  style="width:500px;">
    <h2>Update Vacancy #<?=$vacancy['ID_Vacancy']?></h2>
    <form action="updatev.php?id=<?=$vacancy['ID_Vacancy']?>" method="post">
        <label for="id">Number of Vacancy</label>
        <input type="text" name="id" value="<?=$vacancy['ID_Vacancy']?>" id="id" readonly>
        <label for="employer">Employer</label>
        <input type="text" name="employer" value="<?=$_SESSION['session_name']?>" id="name" readonly>
        <label for="dateofp">Data_of_placing</label>
        <input type="text" name="dateofp" value="<?=$vacancy['Date_of_placing']?>" id="date" readonly>
        <label for="work">ID_Work</label>
        <input type="text" name="idw" value="<?=$vacancy['ID_Work']?>" id="idw" readonly>
        <label for="sallary">Salary</label>
        <input type="text" name="salary" value="<?=$vacancy['Salary']?>" id="salary">
        <label for="worksh">Work schedule</label>
        <input type="text" name="worksh" value="<?=$vacancy['Work_schedule']?>" id="worksh">
        <label for="state">State of Vacancy</label>
        <input type="text" name="state" value="<?=$vacancy['StateOfVacancy']?>" id="state" readonly>
        <input type="submit" value="Update">
    </form>
</div>

<?=template_footerr()?>
