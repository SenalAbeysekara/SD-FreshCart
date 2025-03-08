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

        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        body > *:not(.Footer):not(.Endbar) {
            flex: 1;
        }
        
        .centered-message {
        text-align: center;
        font-size: 32px; 
        font-weight: bold;
        margin: 30px 0;
        color: #013220; 
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); 
        background: linear-gradient(90deg, limegreen, #00b894); 
        -webkit-background-clip: text; 
        -webkit-text-fill-color: transparent; 
        padding: 10px;
        border-bottom: 3px solid limegreen; 
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: grey;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        td img {
            width: 100px;
            height: 100px;
            display: block;
            margin-right: 10px;
            border-radius: 5px;
        }

        form input[type="number"] {
            width: 50px;
            padding: 5px;
            margin-right: 10px;
            border: 1px solid black;
            border-radius: 10px;
        }

        .remove {
            background-color: #B22222;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .remove:hover {
            background-color: #8B0000;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .action-buttons a {
            background-color: limegreen;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .action-buttons a:hover {
            background-color: #6B8E23;
        }

        .total-amount {
            margin-top: 20px;
            text-align: right;
            font-size: 24px;
            font-weight: bold;
            color: black;
            padding: 10px;
            border: 2px solid grey;
            background-color: #f9fff9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .Endbar {
            position: relative;
            margin-top: auto; 
            background-color: #013220;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 16px;
            top: 10px;
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
<body bgcolor="#e0e0e0" onload="showSlides()">

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
    }

    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $quantity = 1;

        $check_query = "SELECT * FROM cart WHERE id = '$id' AND product_id = $product_id";
        $result = mysqli_query($conn, $check_query);
    
        if (mysqli_num_rows($result) > 0) {
            $update_query = "UPDATE cart SET quantity = quantity + 1 WHERE id = '$id' AND product_id = $product_id";
            mysqli_query($conn, $update_query);
            $message = "Quantity Updated!";
        } else {
            $insert_query = "INSERT INTO cart (quantity, product_id, id) VALUES ($quantity, $product_id, '$id')";
            mysqli_query($conn, $insert_query);
            $message = "Item Added Successfully!";
        }
        echo "<script>
                alert('$message');
                window.history.back();
              </script>";
    }

    $cart_query = "SELECT c.cart_id, c.quantity, p.name, p.price, p.image_path 
               FROM cart c 
               JOIN products p ON c.product_id = p.product_id
               WHERE c.id = '$id'"; 
    $result = mysqli_query($conn, $cart_query);
    echo '<h2 class="centered-message">Your Shopping Cart</h2>';

    $total_cart_amount = 0;

    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th></tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            $total = $row['price'] * $row['quantity'];
            $total_cart_amount += $total;
            
            echo '<tr>';
            echo '<td><img src="' . $row['image_path'] . '" alt="' . $row['name'] . '" width="50"> ' . $row['name'] . '</td>';
            echo '<td>Rs. ' . number_format($row['price'], 2) . '</td>';
            echo '<td>
                    <form action="update_cart.php" method="POST" id="cart-form-' . $row['cart_id'] . '">
                        <input type="hidden" name="cart_id" value="' . $row['cart_id'] . '">
                        <input type="number" name="quantity" value="' . $row['quantity'] . '" min="1" required onchange="updateQuantity(' . $row['cart_id'] . ')">
                    </form>
                  </td>';
            echo '<td>Rs. ' . number_format($total, 2) . '</td>';
            echo '<td><a href="removeFromCart.php?cart_id=' . $row['cart_id'] . '"><button class="remove">Remove</button></a></td>';
            echo '</tr>';
        }
        
        echo '</table>';
    
        echo '<div class="total-amount">';
        echo 'Total Amount: Rs. ' . number_format($total_cart_amount, 2);
        echo '</div>';
    } else {
        echo '<p class="centered-message">Your cart is empty.</p>';
    }
} else {
    echo '<p class="centered-message">You need to log in to view your cart.</p>';
}

mysqli_close($conn);
?>

<div class="action-buttons">
    <a href="Home.php">Continue Shopping</a>
    <a href="checkout.php">Proceed to Checkout</a>
</div>
<br>

<div class="Endbar">
<ul>
  <li> <a href="PrivacyPolicy.php">Privacy Policy</a> </li>
  <li> <a href="Term&Condiions.php">Terms and Conditions</a> </li>
  <li> <a href="AboutUs.php">About Us</a> </li>
  <li> <a href="ContactUs.php">Contact US</a> </li>
  <li> <a href="FAQ.php">FAQ</a> </li>
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

<script>
function updateQuantity(cartId) {
    var form = document.getElementById('cart-form-' + cartId);
    form.submit();
}
</script>

</body>
</html>
