<?php
session_start();

if (!isset($_SESSION['username'])) {
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

if (!isset($_GET['order_id'])) {
    echo "No order ID provided.";
    exit();
}

$order_id = intval($_GET['order_id']);

$sql_order = "SELECT order_date, total_amount, status FROM orders WHERE order_id = $order_id";
$result_order = mysqli_query($conn, $sql_order);

if (mysqli_num_rows($result_order) === 0) {
    echo "Order not found.";
    exit();
}

$order = mysqli_fetch_assoc($result_order);

$sql_order_details = "SELECT p.name, op.quantity, op.price, (op.quantity * op.price) AS total_price
                      FROM order_products op
                      JOIN products p ON op.product_id = p.product_id
                      WHERE op.order_id = $order_id";
$result_order_details = mysqli_query($conn, $sql_order_details);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Home.css?v=<?php echo time(); ?>">
    <link rel="icon" href="Logo Pics/Logo11.png" type="image/x-icon">
    <title>Profile | SD FreshCart</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

        .order-details-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 32px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .order-details-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: gray;
            color: white;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: limegreen;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
        }

        .back-btn:hover {
            background-color: gray;
        }
    </style>
</head>
<body bgcolor="#e0e0e0">

<?php include 'navbar.php'; ?>

    <div class="order-details-container">
        <h2>Order Details</h2>
        <p><strong>Order ID:</strong> <?php echo $order_id; ?></p>
        <p><strong>Order Date:</strong> <?php echo $order['order_date']; ?></p>
        <p><strong>Total Amount:</strong> Rs. <?php echo $order['total_amount']; ?></p>
        <p><strong>Status:</strong> <?php echo $order['status']; ?></p>

        <h3>Products</h3>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_order_price = 0;
                while ($detail = mysqli_fetch_assoc($result_order_details)) {
                    echo "<tr>
                            <td>{$detail['name']}</td>
                            <td>{$detail['quantity']}</td>
                            <td>Rs. {$detail['price']}</td>
                            <td>Rs. {$detail['total_price']}</td>
                          </tr>";
                    $total_order_price += $detail['total_price'];
                }
                ?>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td><strong>Rs. <?php echo $total_order_price; ?></strong></td>
                </tr>
            </tbody>
        </table>

        <a href="purchase.php" class="back-btn">Back to Purchase History</a>
    </div>

    <?php include 'Footer.php'; ?>
</body>
</html>

<?php
mysqli_close($conn);
?>
