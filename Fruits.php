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
    <link rel="stylesheet" href="Categories.css?v=<?php echo time(); ?>">
    <link rel="icon" href="Logo Pics/Logo11.png" type="image/x-icon">
    <title>SD FreshCart | Quality and Convenience, Just a Click Away</title>
</head>
<body bgcolor="#e0e0e0" onload="showSlides()">

<?php include 'navbar.php'; ?>

  <div class="head">Showing Products Of <span style="color: red;">Fruits</span></div>

  <div class="products-pics">
    <img src="Vegetabales Pics/vege2.jpg" alt="">
  </div>

  <div class="home-tag">
    <a href="Home.html">Home</a> > <a href="Fruits.html">Fruits</a>
  </div>

  <div class="product-container">
    
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sdfreshcart";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM products WHERE category = 'Fruits'";
    $result = mysqli_query($conn, $query);

    if (isset($_SESSION['username'])) {
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="product-grid">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="product-item">';
                echo '<a href="productDescription.php?id=' . $row['product_id'] . '">';
                echo '<img src="' . $row['image_path'] . '" alt="' . $row['name'] . '">';
                echo '</a>';
                echo '<h4>' . $row['name'] . '</h4>';
                echo '<p>' . $row['weight'] . '</p>';
                echo '<p><b>Rs. ' . number_format($row['price'], 2) . '</b></p>';
                echo '<p><s>' . $row['ori_price'] . '</s></p>';
                echo '<p>(Inclusive of all taxes)</p>';
                echo '<a href="cart.php?product_id=' . $row['product_id'] . '"><button>Add To Cart</button></a>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p>No products available in this category.</p>';
        }
    } else {
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="product-grid">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="product-item">';
                echo '<a href="productDescription.php?id=' . $row['product_id'] . '">';
                echo '<img src="' . $row['image_path'] . '" alt="' . $row['name'] . '">';
                echo '</a>';
                echo '<h4>' . $row['name'] . '</h4>';
                echo '<p>' . $row['weight'] . '</p>';
                echo '<p><b>Rs. ' . number_format($row['price'], 2) . '</b></p>';
                echo '<p><s>' . $row['ori_price'] . '</s></p>';
                echo '<p>(Inclusive of all taxes)</p>';
                echo '<a href="cart.php"><button>Add To Cart</button></a>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p>No products available in this category.</p>';
        }
    }

    mysqli_close($conn);
    ?>

  </div>

<?php include 'Footer.php'; ?>

</body>
</html>
