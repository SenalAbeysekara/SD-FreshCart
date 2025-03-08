<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sdfreshcart";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $query = "DELETE FROM products WHERE product_id = $product_id";

    if (mysqli_query($conn, $query)) {

        header("Location: AdminProducts.php?status=deleted");
        exit();
    } else {

        echo "Error: " . mysqli_error($conn);
    }
} else {

    header("Location: AdminProducts.php");
    exit();
}

mysqli_close($conn);
?>
