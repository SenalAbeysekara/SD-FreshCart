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

if (isset($_POST['change_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status']; 

    $update_status_query = "UPDATE orders SET status = '$new_status' WHERE order_id = '$order_id'";
    if (mysqli_query($conn, $update_status_query)) {
        echo "<script>alert('Order status updated successfully!'); 
                      window.location.href='orders.php';
              </script>";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}

$sql = "SELECT orders.order_id, users.name AS customer_name, orders.order_date, orders.total_amount, orders.status
        FROM orders
        JOIN users ON orders.id = users.id";

$result = mysqli_query($conn, $sql);

mysqli_close($conn);
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

        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }

        .order-table-container {
            background-color: white;
            padding: 10px;
            border-radius: 8px;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .order-table th, .order-table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .order-table th {
            background-color: black;
            color: white;
        }

        .view-details-btn {
            padding: 4px 8px;
            background-color: limegreen;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .view-details-btn:hover {
            background-color: gray;
        }

        .status {
            padding: 4px 8px;
            background-color: #5a9bd5;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .status:hover {
            background-color: blue;
        }

        .button-container {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        select {
            padding: 4px;
            border-radius: 4px;
            border: 1px solid #ddd;
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

        <div class="main-content">
            <div class="order-table-container">
                <h2>Orders List</h2>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Order Date</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td>{$row['order_id']}</td>
                                        <td>{$row['customer_name']}</td>
                                        <td>{$row['order_date']}</td>
                                        <td>Rs. {$row['total_amount']}</td>
                                        <td>{$row['status']}</td>
                                        <td>
                                            <div class='button-container'>
                                                <a href='view_order_details.php?order_id={$row['order_id']}'>
                                                    <button class='view-details-btn'>View</button>
                                                </a>
                                                <form action='' method='POST' style='display: inline;'>
                                                    <input type='hidden' name='order_id' value='{$row['order_id']}'>
                                                    <select name='status' required>
                                                        <option value='Processing'>Processing</option>
                                                        <option value='Shipped'>Shipped</option>
                                                        <option value='Out for Delivery'>Out for Delivery</option>
                                                        <option value='Delivered'>Delivered</option>
                                                        <option value='Completed'>Completed</option>
                                                    </select>
                                                    <button type='submit' name='change_status' class='status'>Change Status</button>
                                                </form>
                                            </div>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No orders found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>