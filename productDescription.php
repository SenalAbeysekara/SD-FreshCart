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

if (isset($_GET['id'])) {
    $productId = intval($_GET['id']); 

    $query = "SELECT * FROM products WHERE product_id = $productId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "No product ID provided.";
    exit();
}

if (isset($_POST['add_to_cart'])) {

    $productExistsInCart = false;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $cartItem) {
            if ($cartItem['id'] == $product['product_id']) {
                $_SESSION['cart'][$key]['quantity'] += 1; 
                $productExistsInCart = true;
                break;
            }
        }
    }

    if (!$productExistsInCart) {
        $cartItem = [
            'id' => $product['product_id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1 
        ];

        $_SESSION['cart'][] = $cartItem;
    }

    header("Location: cart.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Home.css?v=<?php echo time(); ?>">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Playpen+Sans&display=swap');
    
        .description-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            background: #fff;
            margin: 20px auto;
            padding: 20px;
            max-width: 1000px;
            border: 1px solid rgba(107, 106, 106, 0.732);
            box-shadow:0 0 15px rgba(107, 106, 106, 0.732);
            border-radius: 10px;
        }

        .description-image {
            display: flex;
            justify-content: center;
            flex: 1;
            align-items: center;
            max-width: 40%;
        }

        .description-image img {
            border-radius: 8px;
            max-width: 100%;
            height: auto;
        }

        .description-info {
            flex: 1;
            margin-left: 20px;
            min-width: 300px;
        }

        .description-info h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .price {
            margin: 10px 0;
        }

        .discounted-price {
            color: green;
            font-size: 22px;
            font-weight: bold;
        }

        .original-price {
            text-decoration: line-through;
            color: red;
            margin-left: 10px;
            font-size: 18px;
        }

        .description-info button {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .description-info button:hover {
            background-color: #218838;
        }

        .item-description h2 {
            font-size: 20px;
            margin-top: 20px;
        }

        .item-description p {
            font-size: 14px;
            line-height: 1.5;
            color: #555;
        }
    </style>
    <link rel="icon" href="Logo Pics/Logo11.png" type="image/x-icon">
    <title>SD FreshCart | <?php echo htmlspecialchars($product['name']); ?></title>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="description-container">
        <div class="description-image">
            <img src="<?php echo $product['image_path']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <div class="description-info">
            <h1><?php echo htmlspecialchars($product['name']); ?> - <?php echo htmlspecialchars($product['weight']); ?></h1>
            <p class="price">
                <span class="discounted-price">Rs. <?php echo htmlspecialchars($product['price']); ?></span> 
                <span class="original-price"><?php echo htmlspecialchars($product['ori_price']); ?></span>
            </p>
            <p><b>(Inclusive of all taxes)</b></p>
        
            <div class="item-description">
                <h2>About this product</h2>
                <p>
                    <?php echo htmlspecialchars($product['description']); ?> 
                </p>
            </div>

            <br>

            <form action="cart.php" method="GET">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
    </div>

    <?php include 'Footer.php'; ?>
</body>
</html>
