<?php
session_start();
?>
<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM works WHERE ID_Work = ?');
    $stmt->execute([$_GET['id']]);
    $work = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$work) {
        exit('Work doesn\'t exist with that ID!');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM works WHERE ID_Work =  ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the work!';
        } else {
            header('Location: works.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_headerm('Delete', $_SESSION['session_name'])?>

<div class="content2 delete">
    <h2>Delete Work #<?=$work['ID_Work']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <p>Are you sure you want to delete work #<?=$work['ID_Work']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$work['ID_Work']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$work['ID_Work']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footerm()?>
