<?php
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "Address-book";

$conn = new mysqli($localhost, $username, $password, $dbname);

try{
    $pdo = new PDO("mysql:host=$localhost;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}