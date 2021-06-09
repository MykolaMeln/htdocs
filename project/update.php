<?php
session_start();
?>
<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $stmt = $pdo->prepare('UPDATE works SET NameWork = :workName WHERE ID_Work = :workID');
        $stmt->bindParam(':workID', $_POST['id'], PDO::PARAM_INT);
        $stmt->bindParam(':workName', $_POST['name'], PDO::PARAM_STR);
        $stmt->execute();

        $msg = 'Updated Successfully!';
    }
    $stmt = $pdo->prepare('SELECT * FROM works WHERE ID_Work = ?');
    $stmt->execute([$_GET['id']]);
    $work = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$work) {
        exit('Work doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_headerm('Update', $_SESSION['session_name'])?>

<div class="content2 update" class="form-control" style="width:500px;">
    <h2>Update Work #<?=$work['ID_Work']?></h2>
    <form action="update.php?id=<?=$work['ID_Work']?>" method="post" style="width:401px;">
        <label for="id">ID</label>
        <input type="text" name="id" placeholder="1" value="<?=$work['ID_Work']?>" id="id" readonly>
        <label for="name">NameWork</label>
        <input type="text" name="name" placeholder="Barista" value="<?=$work['NameWork']?>" id="name">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footerm()?>
