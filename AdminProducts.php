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

$category_filter = isset($_GET['category']) ? $_GET['category'] : "";

$category_query = "SELECT DISTINCT category FROM products";
$category_result = mysqli_query($conn, $category_query);

$query = "SELECT * FROM products";
if (!empty($category_filter)) {
    $query .= " WHERE category = '$category_filter'";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SD FreshCart Dashboard</title>
    <link rel="icon" href="Logo Pics/Logo11.png">
    <link rel="stylesheet" href="AdminProduct.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Playpen+Sans&display=swap');

        .filter-container {
            margin-bottom: 20px;
        }
        .filter-container select {
            padding: 10px;
            font-size: 14px;
        }
        .product-container .addBtn {
            margin-bottom: 15px;
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
            <a href="AdminContactUs">Reviews Manager</a>
            <a href="logout.php">Log out</a>
        </div>

        <div class="product-container">
            <div class="header4">Products</div>
            <br>
            <a href="AddProduct.php"><button class="addBtn">Add Products</button></a>

            <div class="filter-container">
                <form method="GET" action="AdminProducts.php">
                    <label for="category">Filter by Category:</label>
                    <select name="category" id="category" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        <?php while ($row = mysqli_fetch_assoc($category_result)) { ?>
                            <option value="<?php echo $row['category']; ?>" 
                                <?php if ($category_filter === $row['category']) echo 'selected'; ?>>
                                <?php echo $row['category']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </form>
            </div>

            <div class="product-grid">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="product-item">
                        <a href="">
                            <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['name']; ?>">
                        </a>
                        <h4><?php echo $row['name']; ?></h4>
                        <p><?php echo $row['weight']; ?></p>
                        <p>Rs. <?php echo $row['price']; ?></p>
                        <p><s><?php echo $row['ori_price']; ?></s></p>
                        <p>(Inclusive of all taxes)</p>
                        <a href="editProduct.php?product_id=<?php echo $row['product_id']; ?>"><button class="btn2">Edit</button></a>
                        <a href="deleteProduct.php?product_id=<?php echo $row['product_id']; ?>"><button class="btn3">Delete</button></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
