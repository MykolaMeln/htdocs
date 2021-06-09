<?php
session_start();
?>
<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

$records_per_page = 7;

$stmt = $pdo->prepare('SELECT * FROM users ORDER BY ID_User LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$num_users = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
?>
<?=template_headerad('Users', $_SESSION['session_name'])?>
<div class="content2 work">
	<h2>Read Users</h2>
	<a href="createu.php" class="create-work">Add User</a>
	<table>
        <thead>
            <tr>
                <td>ID_User</td>
                <td>Login</td>
                <td>Password</td>
                <td>ID_Role</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?=$user['ID_User']?></td>
                <td><?=$user['Login']?></td>
                <td><?=$user['Password']?></td>
                <td><?=$user['ID_Role']?></td>
                <td class="actions">
                    <a href="updateu.php?id=<?=$user['ID_User']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="deleteu.php?id=<?=$user['ID_User']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="users.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_users): ?>
		<a href="users.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footerad()?>
