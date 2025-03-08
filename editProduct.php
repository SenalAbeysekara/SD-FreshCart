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
    $query = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
} else {
    header("Location: AdminProducts.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['productName'];
    $weight = $_POST['productWeight'];
    $price = $_POST['productPrice'];
    $ori_price = $_POST['productOriPrice'];
    $description = $_POST['productDescription'];

    $query = "UPDATE products SET name = '$name', weight = '$weight', price = '$price', ori_price = '$ori_price', description = '$description' WHERE product_id = $product_id";
    mysqli_query($conn, $query);
    header("Location: AdminProducts.php?status=updated");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="icon" href="Logo Pics/Logo11.png">
    <link rel="stylesheet" href="AdminProduct.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Playpen+Sans&display=swap');
        .container {
            display: flex;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .edit-form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(107, 106, 106, 0.5);
            width: 50%;
            margin-left: 270px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: auto;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        .form-group {
            width: 100%;
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            color: #333;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-group textarea {
            resize: vertical;
        }
        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        @media (max-width: 768px) {
            .edit-form-container {
                width: 50%;
                margin-left: 200px;
            }
            .sidebar {
                width: 200px;
            }
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
        <div class="edit-form-container">
            <h2>Edit Product</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="productName">Product Name:</label>
                    <input type="text" name="productName" id="productName" value="<?php echo $product['name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="productWeight">Weight:</label>
                    <textarea name="productWeight" id="productWeight" rows="1" required><?php echo $product['weight']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="productPrice">Price:</label>
                    <input type="number" name="productPrice" id="productPrice" value="<?php echo $product['price']; ?>" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="productOriPrice">Original Price:</label>
                    <input type="text" name="productOriPrice" id="productOriPrice" value="<?php echo $product['ori_price']; ?>">
                </div>
                <div class="form-group">
                    <label for="productDescription">Description:</label>
                    <textarea name="productDescription" id="productDescription" rows="1" required><?php echo $product['description']; ?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
