<?php
session_start();
?>
<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (!empty($_POST)) {

    $id = isset($_POST['ID_Work']) && !empty($_POST['ID_Work']) && $_POST['ID_Work'] != 'auto' ? $_POST['ID_Work'] : NULL;
    $name = isset($_POST['name']) ? $_POST['name'] : '';

    $stmt1 = $pdo->prepare('SELECT * FROM works WHERE NameWork = :name');
    $stmt1->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt1->execute();

    $works = $stmt1->fetch();

    if($works > 0)
    {
      echo "<script>alert('Work already exists!'); window.location='works.php'</script>";
    }
    else{
      $stmt = $pdo->prepare('INSERT INTO works VALUES (?, ?)');
      $stmt->execute([$id, $name]);
    }

     $msg = 'Created Successfully!';
     echo "<script>alert('Work successfully added!'); window.location='works.php'</script>";
}
?>
<?=template_headerm('Create', $_SESSION['session_name'])?>

<div class="content update" class="form-control" style="width:500px;">
    <h2>Create Work</h2>
    <form action="create.php" method="post" >
        <label for="id">ID_Work</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id" readonly>
        <label for="name">NameWork</label>
        <input type="text" name="name" placeholder="Barista" id="name">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footerm()?>
