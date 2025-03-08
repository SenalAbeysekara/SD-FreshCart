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

if (isset($_POST['cart_id']) && isset($_POST['quantity'])) {
    $cart_id = $_POST['cart_id'];
    $new_quantity = $_POST['quantity'];

    if (is_numeric($new_quantity) && $new_quantity > 0) {
        $update_query = "UPDATE cart SET quantity = $new_quantity WHERE cart_id = '$cart_id'";

        if (mysqli_query($conn, $update_query)) {
            header('Location: cart.php'); 
            exit();
        } else {
            echo "<p>Error updating cart: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p>Invalid quantity.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}

mysqli_close($conn);
?>
