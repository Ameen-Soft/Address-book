<?php
require 'db.php';

if(isset($_POST['add_contact'])) {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $notes = !empty($_POST['notes'])? $_POST['notes'] : '---';

    $stmt = $pdo->prepare("INSERT INTO contacts (full_name, phone, email, address, notes) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$full_name, $phone, $email, $address, $notes]);

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
    <title>Add New Contact</title>
</head>
<body>
    <form action="" method="POST">
        <h2>Add New Contact</h2>
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required>
        
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address">

        <label for="notes">Notes:</label>
        <textarea id="notes" name="notes"></textarea>

        <button type="submit" name="add_contact">Add Contact</button>
        <a href="index.php">Back to Address Book</a>
    </form>
    
</body>
</html>