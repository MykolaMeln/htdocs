<?php
session_start();
?>
<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM vacancies WHERE ID_Vacancy = ?');
    $stmt->execute([$_GET['id']]);
    $vacancy = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$vacancy) {
        exit('Vacancy doesn\'t exist with that ID!');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM vacancies WHERE ID_Vacancy =  ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the vacancy!';
        } else {
            header('Location: myvacancies.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_headerr('Delete', $_SESSION['session_name'])?>

<div class="content2 delete">
    <h2>Delete Vacancy #<?=$vacancy['ID_Vacancy']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <p>Are you sure you want to delete vacancy #<?=$vacancy['ID_Vacancy']?>?</p>
    <div class="yesno">
        <a href="deletev.php?id=<?=$vacancy['ID_Vacancy']?>&confirm=yes">Yes</a>
        <a href="deletev.php?id=<?=$vacancy['ID_Vacancy']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footerr()?>
