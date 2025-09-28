<?php
require 'db.php';

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$stmt = $pdo->query("SELECT * FROM contacts LIMIT $limit OFFSET $offset");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_stmt = $pdo->query("SELECT COUNT(*) FROM contacts");
$total_contacts = $total_stmt->fetchColumn();
$total_pages = ceil($total_contacts / $limit);

if (isset($_GET['delete_id'])) {
    $delete_id = (int) $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->execute([$delete_id]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>Address Book</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body dir="rtl">

    <div class="container">
        <h1>Address Book</h1>

        <div class="add-btn">
            <a href="add.php">+ Add new contact</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($contacts): ?>
                <?php $counter = ($page - 1) * $limit + 1; ?>
                <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><?= $counter ?></td>
                    <td><?= htmlspecialchars($contact['full_name'])?></td>
                    <td><?= htmlspecialchars($contact['phone'])?></td>
                    <td><?= htmlspecialchars($contact['email'])?></td>
                    <td><?= htmlspecialchars($contact['address'])?></td>
                    <td><?= htmlspecialchars($contact['notes'])?></td>
                    <td>
                        <a href="edit.php?id=<?= $contact['id']?>" class="edit">Edit</a>
                        <a href="index.php?delete_id=<?= $contact['id'] ?>" class="delete"
                            onclick="return confirm('Do you want to Delete?')">Delete</a>
                    </td>
                </tr>
                <?php $counter++; ?>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="7">No contacts</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </div>
    </table>
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="index.php?page=<?= $page-1 ?>">&laquo; Previous</a>
        <?php endif; ?>

        <?php if ($page < $total_pages): ?>
            <a href="index.php?page=<?= $page+1 ?>">Next &raquo;</a>
        <?php endif; ?>
    </div>

</body>

</html>