<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
    $stmt->execute([$id]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$contact) {
        die("Contact not found!");
    }
} else {
    die("No ID provided!");
}

if(isset($_POST['update_contact'])) {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $notes = $_POST['notes'];

    $stmt = $pdo->prepare("UPDATE contacts 
    SET full_name=?, phone=?, email=?, address=?, notes=? 
    WHERE id = ?");
    $stmt->execute([$full_name, $phone, $email, $address, $notes, $id]);


    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Edit Contact</title>
</head>

<body>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $contact['id'] ?>">
        <label>Full Name:</label>
        <input type="text" name="full_name" value="<?= htmlspecialchars($contact['full_name']) ?>">

        <label>Phone:</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($contact['phone']) ?>">

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($contact['email']) ?>">


        <label>Address:</label>
        <input type="text" name="address" value="<?= htmlspecialchars($contact['address']) ?>">

        <label>Notes:</label>
        <textarea name="notes"><?= htmlspecialchars($contact['notes']) ?></textarea>

        <button type="submit" name="update_contact">Update</button>
    </form>


</body>

</html>