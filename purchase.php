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

$current_username = $_SESSION['username'];

$sql_user = "SELECT id FROM users WHERE username = '$current_username'";
$result_user = mysqli_query($conn, $sql_user);

if (mysqli_num_rows($result_user) > 0) {
    $user = mysqli_fetch_assoc($result_user);
    $user_id = $user['id'];

    $sql_orders = "SELECT o.order_id, o.order_date, o.total_amount, o.status 
                   FROM orders o
                   WHERE o.id = '$user_id' 
                   ORDER BY o.order_date DESC";

    $result_orders = mysqli_query($conn, $sql_orders);
} else {
    echo "User not found.";
    exit();
}
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
        
        .purchase-history-container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .purchase-history-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        table th {
            background-color: gray;
            color: white;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        .details-btn {
            padding: 5px 10px;
            background-color: limegreen;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .details-btn:hover {
            background-color: gray;
        }

        .Endbar {
            position: fixed;
            left: 0;
            bottom: 30px;
            width: 100%;
            background-color: #013220;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 16px;
        }

        .Endbar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        .Endbar ul li {
            margin: 5px 10px;
        }

        .Endbar ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
        }

        .Endbar ul li a:hover {
            color: limegreen;
        }

        .Footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #013220;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
        }

        .Footer p {
            margin: 0;
            color: white;
            font-size: 13px;
            font-weight: bold;
        }
    </style>
</head>
<body bgcolor="#e0e0e0">
    <?php include 'navbar.php'; ?>

    <div class="purchase-history-container">
        <h2>Purchase History</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total Cost</th>
                    <th>Status</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result_orders) > 0) {
                    while ($row = mysqli_fetch_assoc($result_orders)) {
                        echo "<tr>
                              <td>{$row['order_id']}</td>
                              <td>{$row['order_date']}</td>
                              <td>Rs. {$row['total_amount']}</td>
                              <td>{$row['status']}</td>
                              <td>
                                  <a href='purchaseDetails.php?order_id={$row['order_id']}' class='details-btn'>View Details</a>
                              </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No orders found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="Endbar">
        <ul>
            <li><a href="PrivacyPolicy.php">Privacy Policy</a></li>
            <li><a href="Term&Conditions.php">Terms and Conditions</a></li>
            <li><a href="AboutUs.php">About Us</a></li>
            <li><a href="ContactUs.php">Contact Us</a></li>
            <li><a href="FAQ.php">FAQ</a></li>
        </ul>
    </div>

    <div class="Footer">
        <p>Copyright &#169; 2024 SD FreshCart. All rights reserved.</p>
    </div>
</body>
</html>

<?php

mysqli_close($conn);
?>
