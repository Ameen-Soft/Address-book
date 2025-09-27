<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM contacts");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($contacts): ?>
                    <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><?= $contact['id']?></td>
                            <td><?= htmlspecialchars($contact['full_name'])?></td>
                            <td><?= htmlspecialchars($contact['email'])?></td>
                            <td><?= htmlspecialchars($contact['phone'])?></td>
                            <td><?= htmlspecialchars($contact['address'])?></td>
                            <td><?= htmlspecialchars($contact['notes'])?></td>
                            <td>
                                <a href="edit.php" class="edit">Edit</a>
                                <a href="delete.php?id=<?= $contact['id'] ?>" class="delete" 
                                onclick="return confirm('Do you want to Delete?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                        <tr>
                            <td colspan="7">No contacts</td>
                        </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>