<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Playpen+Sans&display=swap');
    </style>
    <link rel="stylesheet" href="Home.css?v=<?php echo time(); ?>">
    <link rel="icon" href="Logo Pics/Logo11.png" type="image/x-icon">
    <title>SD FreshCart | Quality and Convenience, Just a Click Away</title>

    <style>
        .Endbar {
            position: fixed;
            left: 0;
            bottom: 30px;
            width: 100%;
            background-color: #013220;
            color: white;
            text-align: center;
            padding: 10px;
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

        .social-icons {
            display: flex;           
            gap: 20px;                
            justify-content: center;  
            margin-top: 15px;       
        }

        .social-icons a img {
            height: 30px;       
            transition: transform 0.3s; 
        }

        .social-icons a img:hover {
            transform: scale(1.2);    
        }

        .Footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #013220;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }

        .Footer p {
            margin: 0;
            color: white;
            font-size: 13px;
            font-weight: bold;
        }

        .checkout-container {
            width: 60%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        .total-amount {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .action-buttons {
            margin-top: 30px;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-continue {
            background-color: #4CAF50;
            color: white;
            margin-right: 20px;
        }

        .btn-checkout {
            background-color: #2196F3;
            color: white;
        }

        .btn:hover {
            opacity: 0.8;
        }

        .centered-message {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
            font-weight: bold;
        }

        .success-message {
            color: #28a745;
        }

        .error-message {
            color: #dc3545;
        }
    </style>
</head>

<body>
<?php include 'navbar.php'; ?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sdfreshcart";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    
    $user_query = "SELECT id FROM users WHERE username = '$username'";
    $user_result = mysqli_query($conn, $user_query);
    
    if (mysqli_num_rows($user_result) > 0) {
        $user_row = mysqli_fetch_assoc($user_result);
        $id = $user_row['id'];
        
        $cart_query = "SELECT c.cart_id, c.quantity, p.product_id, p.name, p.price 
                       FROM cart c 
                       JOIN products p ON c.product_id = p.product_id
                       WHERE c.id = '$id'"; 
        $result = mysqli_query($conn, $cart_query);
        
        $total_cart_amount = 0;

        if (mysqli_num_rows($result) > 0) {
            $cart_items = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $total_cart_amount += $row['price'] * $row['quantity'];
                $cart_items[] = $row;
            }

            if (isset($_POST['checkout'])) {
                mysqli_begin_transaction($conn);

                try {
                    $insert_order_query = "INSERT INTO orders (id, total_amount, status) 
                                           VALUES ('$id', '$total_cart_amount', 'Processing')";
                    if (mysqli_query($conn, $insert_order_query)) {
                        $order_id = mysqli_insert_id($conn);

                        foreach ($cart_items as $item) {
                            $product_id = $item['product_id'];
                            $quantity = $item['quantity'];
                            $price = $item['price'];

                            $insert_order_product_query = "INSERT INTO order_products (product_id, order_id, quantity, price) 
                                                           VALUES ('$product_id', '$order_id', '$quantity', '$price')";
                            mysqli_query($conn, $insert_order_product_query);
                        }

                        $clear_cart_query = "DELETE FROM cart WHERE id = '$id'";
                        mysqli_query($conn, $clear_cart_query);

                        mysqli_commit($conn);

                        echo '<p class="centered-message success-message">Order placed successfully! Your cart has been cleared.</p>';
                    } else {
                        throw new Exception('Error inserting order: ' . mysqli_error($conn));
                    }
                } catch (Exception $e) {
                    mysqli_rollback($conn);
                    echo '<p class="centered-message error-message">Error placing order: ' . $e->getMessage() . '</p>';
                }
            }

            echo '<form action="" method="POST">
                    <div class="checkout-container">
                        <div class="total-amount">
                            <strong>Total Amount: Rs. ' . number_format($total_cart_amount, 2) . '</strong>
                        </div>
                        <div class="action-buttons">
                            <a href="Home.php" class="btn btn-continue">Continue Shopping</a>
                            <input type="submit" name="checkout" value="Proceed to Checkout" class="btn btn-checkout" />
                        </div>
                    </div>
                  </form>';
        } else {
            echo '<p class="centered-message">Your cart is empty.</p>';
        }
    } else {
        echo '<p class="centered-message">User not found.</p>';
    }
} else {
    echo '<p class="centered-message">You need to log in to view your cart.</p>';
}

mysqli_close($conn);
?>

<div class="Endbar">
    <ul>
        <li><a href="PrivacyPolicy.php">Privacy Policy</a></li>
        <li><a href="Term&Condiions.php">Terms and Conditions</a></li>
        <li><a href="AboutUs.php">About Us</a></li>
        <li><a href="ContactUs.php">Contact Us</a></li>
        <li><a href="FAQ.php">FAQ</a></li>
    </ul>
    <div class="social-icons">
    <a href="https://www.facebook.com/login/" target="_blank">
      <img src="Icons/facebook.png" height="30px" alt="Facebook">
    </a>
    <a href="https://www.instagram.com/accounts/login/?hl=en" target="_blank">
      <img src="Icons/instagram.png" height="30px" alt="Instagram">
    </a>
    <a href="https://x.com/?lang=en" target="_blank">
      <img src="Icons/twitter.png" height="30px" alt="Twitter">
    </a>
  </div> 
</div>

<div class="Footer">
    <p>Copyright &#169; 2024 SD FreshCart. All rights reserved.</p>
</div>

</body>
</html>
