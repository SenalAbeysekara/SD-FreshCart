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

$order_id = $_GET['order_id'];

$sql = "SELECT op.order_product_id, p.name AS product_name, op.quantity, op.price, (op.quantity * op.price) AS total_price
        FROM order_products op
        JOIN products p ON op.product_id = p.product_id
        WHERE op.order_id = $order_id";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SD FreshCart Dashboard - Orders</title>
    <link rel="icon" href="Logo Pics/Logo11.png">
    <link rel="stylesheet" href="AdminProduct.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Playpen+Sans&display=swap');

        .order-details-container {
            margin-left: 270px;
            margin-top: 25px;
            padding: 10px;
            border-radius: 8px;
            width: 80%;
            background-color: white;
        }

        .order-items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .order-items-table th, .order-items-table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .order-items-table th {
            background-color: black;
            color: white;
        }

        .back-btn {
            padding: 10px 15px;
            background-color: limegreen;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }

        .back-btn:hover {
            background-color: gray;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <a href="#"><img src="Logo Pics/Logo10.png" alt="SD Freshcart" width="60%"></a>
            <a href="AdminProducts.php">Products</a>
            <a href="orders.php">Orders</a>
            <a href="FAQ_Admin.php">FAQ Management</a>
            <a href="AdminContactUs.php">Reviews Manager</a>
            <a href="logout.php">Log out</a>
        </div>

        <div class="order-details-container">
            <h2>Order #<?php echo $order_id; ?> - Items List</h2>
            <table class="order-items-table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price (per item)</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['product_name']}</td>
                                    <td>{$row['quantity']}</td>
                                    <td>Rs. {$row['price']}</td>
                                    <td>Rs. {$row['total_price']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No items found for this order.</td></tr>";
                    }

                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
            <br><br>
            <a href="orders.php" class="back-btn">Back to Orders</a>
        </div>
    </div>
</body>
</html>
