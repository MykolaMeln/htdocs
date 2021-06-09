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
        $login2 = isset($_POST['login']) ? $_POST['login'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $role = isset($_POST['role']) ? $_POST['role'] : '';

        $stmt = $pdo->prepare('SELECT * FROM users WHERE ID_User = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $logindb = $stmt->fetch();

        if(($id == $logindb['ID_User']))
        {

        $stmt = $pdo->prepare('UPDATE users SET Login = :login, Password = :pass, ID_Role = :role WHERE ID_User = :id');
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $stmt->bindParam(':login', $_POST['login'], PDO::PARAM_STR);
        $stmt->bindParam(':pass', $_POST['password'], PDO::PARAM_STR);
        $stmt->bindParam(':role', $_POST['role'], PDO::PARAM_INT);
        $stmt->execute();

        $msg = 'Updated Successfully!';
        header('Location: users.php');
      }
      else{
        {
          ?>
          <script>
          alert("Login already exists!")
          window.location="updateu.php?id=<?=$user['ID_User']?>";
        </script>
        <?php
        }
      }
    }
    $stmt = $pdo->prepare('SELECT * FROM users WHERE ID_User = ?');
    $stmt->execute([$_GET['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        exit('Work doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_headerad('Update', $_SESSION['session_name'])?>

<div class="content2 update" style="width:500px;">
    <h2>Update User #<?=$user['ID_User']?></h2>
    <form action="updateu.php?id=<?=$user['ID_User']?>" method="post">
        <label for="id">ID_User</label>
        <input type="text" name="id" placeholder="1" value="<?=$user['ID_User']?>" id="id" readonly>
        <label for="login">Login</label>
        <input type="text" name="login" value="<?=$user['Login']?>" id="name">
        <label for="password">Password</label>
        <input type="text" name="password" value="<?=$user['Password']?>" id="pass">
        <label for="name">ID_Role</label>
        <input type="text" name="role" value="<?=$user['ID_Role']?>" id="role">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footerad()?>
