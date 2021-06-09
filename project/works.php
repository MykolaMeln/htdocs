<?php
session_start();
?>
<?php
include 'functions.php';
$pdo = pdo_connect_mysql();

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

$records_per_page = 7;

$stmt = $pdo->prepare('SELECT * FROM works ORDER BY ID_Work LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

$works = $stmt->fetchAll(PDO::FETCH_ASSOC);

$num_works = $pdo->query('SELECT COUNT(*) FROM works')->fetchColumn();
?>
<?=template_headerm('Works', $_SESSION['session_name'])?>
<div class="content2 work">
	<h2>Read Works</h2>
	<a href="create.php" class="create-work">Create Work</a>
	<table>
        <thead>
            <tr>
                <td>ID_Work</td>
                <td>NameWork</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($works as $work): ?>
            <tr>
                <td><?=$work['ID_Work']?></td>
                <td><?=$work['NameWork']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$work['ID_Work']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$work['ID_Work']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="works.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_works): ?>
		<a href="works.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footerm()?>
