<?php
session_start();
?>

<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $stmt = $pdo->prepare('SELECT * FROM users WHERE ID_User = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $user = $stmt->fetch();

  /*  $stmt = $pdo->prepare('SELECT * FROM users WHERE ID_User = ?');
    $stmt->execute([$_GET['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);*/

    if (!$user) {
        exit('User doesn\'t exist with that ID!');
    }
    if(isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes' and $_GET['id'] != 1) {

            if($user['ID_Role'] = 4)
            {
              $ide = $_GET['id'];
              $stmt1 = $pdo->prepare('SELECT * FROM employers WHERE ID_User = :id');
              $stmt1->bindParam(':id', $ide, PDO::PARAM_INT);
              $stmt1->execute();

              $empr = $stmt1->fetch();

              $idem = $empr['ID_Employer'];

              $stmt2 = $pdo->prepare('DELETE FROM vacancies WHERE ID_Employer = :id');
              $stmt2->bindParam(':id', $idem, PDO::PARAM_INT);
              $stmt2->execute();

              $stmt3 = $pdo->prepare('DELETE FROM employers WHERE ID_User = :id');
              $stmt3->bindParam(':id', $ide, PDO::PARAM_INT);
              $stmt3->execute();
            }
            if($user['ID_Role'] = 3)
            {
              $idee = $_GET['id'];

              $stmt1 = $pdo->prepare('SELECT * FROM employees WHERE ID_User = :id');
              $stmt1->bindParam(':id', $idee, PDO::PARAM_INT);
              $stmt1->execute();

              $empl = $stmt1->fetch();

              $idemp = $empl['ID_Employee'];
              $stmt2 = $pdo->prepare('DELETE FROM employeedata WHERE ID_Employee = :id');
              $stmt2->bindParam(':id', $idemp, PDO::PARAM_INT);
              $stmt2->execute();

              $stmt3 = $pdo->prepare('DELETE FROM employees WHERE ID_User = :id');
              $stmt3->bindParam(':id', $ide, PDO::PARAM_INT);
              $stmt3->execute();
            }

            $stmt = $pdo->prepare('DELETE FROM users WHERE ID_User = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $msg = 'You have deleted the user!';
            header('Location: users.php');
        } else {
            header('Location: users.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_headerad('Delete', $_SESSION['session_name'])?>

<div class="content2 delete">
    <h2>Delete User #<?=$user['ID_User']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <p>Are you sure you want to delete user #<?=$user['ID_User']?>?</p>
    <div class="yesno">
        <a href="deleteu.php?id=<?=$user['ID_User']?>&confirm=yes">Yes</a>
        <a href="deleteu.php?id=<?=$user['ID_User']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footerad()?>
