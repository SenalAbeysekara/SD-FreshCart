<?php
session_start();

if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
    header("Location: AdminProducts.php");
    exit(); 
}
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
</head>
<body bgcolor="#e0e0e0" onload="showSlides()">

<?php include 'navbar.php'; ?>

<div class="slideshow-container">
    <div class="mySlides">
        <img src="Promo Pics/Promo1.png" alt="">
    </div>
    <div class="mySlides">
        <img src="Promo Pics/Promo2.png" alt="">
    </div>
    <div class="mySlides">
        <img src="Promo Pics/Promo3.jpg" alt="">
    </div>
    <div class="mySlides">
        <img src="Promo Pics/Promo4.png" alt="">
    </div>
    <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
    <a class="next" onclick="changeSlide(1)">&#10095;</a>
</div>

<div class="categories-container">
    <h1>Shop by categories</h1>
    <div class="categories-grid">
        <div class="categories-item">
            <a href="Vegetables.php"><img src="Categories Pics/vegetables.jpg" alt="Vegetables"><p>Vegetables</p></a>
        </div>
        <div class="categories-item">
            <a href="Fruits.php"><img src="Categories Pics/fruits.jpg" alt="Fruits"><p>Fruits</p></a>
        </div>
        <div class="categories-item">
            <a href="Beverags.php"><img src="Categories Pics/beverages.jpg" alt="Beverages"><p>Beverages</p></a>
        </div>
        <div class="categories-item">
            <a href="Snack.php"><img src="Categories Pics/snacks.jpg" alt="Snacks"><p>Snacks</p></a>
        </div>
        <div class="categories-item">
            <a href="Dairy.php"><img src="Categories Pics/diary.jpg" alt="Dairy"><p>Dairy</p></a>
        </div>
        <div class="categories-item">
            <a href="#"><img src="Categories Pics/spices.jpg" alt="Seeds & Spices"><p>Seeds & Spices</p></a>
        </div>
        <div class="categories-item">
            <a href="#"><img src="Categories Pics/Frozen-Food.jpg" alt="Frozen-Food"><p>Frozen Food</p></a>
        </div>
        <div class="categories-item">
            <a href="#"><img src="Categories Pics/Rice.jpg" alt="Rice"><p>Rice</p></a>
        </div>
        <div class="categories-item">
            <a href="#"><img src="Categories Pics/Household.jpg" alt="Household"><p>Households</p></a>
        </div>
        <div class="categories-item">
            <a href="#"><img src="Categories Pics/Baby-Products.jpg" alt="Baby-Products"><p>Baby Products</p></a>
        </div>
    </div>
</div>

<div class="offers-container">
    <h1>This Week's Top Offers</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sdfreshcart";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM products WHERE category = 'Deals'";
    $result = mysqli_query($conn, $query);

    if (isset($_SESSION['username'])) {
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="offers-grid">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="offers-item">';
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
            echo '<div class="offers-grid">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="offers-item">';
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

<div class="slide-show2">
    <div class="slide-show-images2">
        <img src="Second Slide/slide1.png">
        <img src="Second Slide/slide2.png" alt="">
        <img src="Second Slide/slide3.png" alt="">
        <img src="Second Slide/slide5.png" alt="">
    </div>
</div>

<div class="brands-container">
    <h1>Shop by Brand</h1>
    <div class="brands-grid">
        <div class="brand-item">
            <img src="Brands Pics/magic.jpg" alt="Magic">
            <p>Magic</p>
        </div>
        <div class="brand-item">
            <img src="Brands Pics/kotmale.jpg" alt="Kotmale">
            <p>Kotmale</p>
        </div>
        <div class="brand-item">
            <img src="Brands Pics/kist.jpg" alt="Kist">
            <p>Kist</p>
        </div>
        <div class="brand-item">
            <img src="Brands Pics/maliban1.png" alt="Maliban">
            <p>Maliban</p>
        </div>
        <div class="brand-item">
            <img src="Brands Pics/wijaya1.png" alt="Wijaya">
            <p>Wijaya</p>
        </div>
        <div class="brand-item">
            <img src="Brands Pics/unilever.png" alt="Unilever">
            <p>Unilever</p>
        </div>
        <div class="brand-item">
            <img src="Brands Pics/goldi.jpg" alt="Goldi">
            <p>Goldi</p>
        </div>
        <div class="brand-item">
            <img src="Brands Pics/elehouse.jpg" alt="ElephantHouse">
            <p>Elephant House</p>
        </div>
    </div>
</div>

<?php include 'Footer.php'; ?>

</body>
</html>
