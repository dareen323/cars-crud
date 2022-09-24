<?php
$servername = "localhost";
$username = "root";
$password = "root";

try {
    $conn = new PDO("mysql:host=$servername;dbname=shop", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$id = $_GET["id"];

$sql = "delete from cars where CarId = :id";
$statment = $conn->prepare($sql);
$statment->bindParam(":id", $id, PDO::PARAM_STR);
$statment->execute();

header("Location: index.php");
