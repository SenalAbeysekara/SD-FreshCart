<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sdfreshcart";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['cart_id']) && isset($_SESSION['username'])) {
    $cart_id = $_GET['cart_id'];
    $username = $_SESSION['username'];

    $user_query = "SELECT id FROM users WHERE username = '$username'";
    $user_result = mysqli_query($conn, $user_query);

    if (mysqli_num_rows($user_result) > 0) {
        $user_row = mysqli_fetch_assoc($user_result);
        $id = $user_row['id'];

        $delete_query = "DELETE FROM cart WHERE cart_id = $cart_id AND id = '$id'";

        if (mysqli_query($conn, $delete_query)) {
            header("Location: cart.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
