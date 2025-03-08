<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "sdfreshcart";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "DELETE FROM users WHERE username = '$username'";

if (mysqli_query($conn, $sql)) {
    session_destroy();
    header("Location: login.php");
    exit();
} else {
    echo "Error deleting profile: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
