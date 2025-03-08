<?php
session_start(); // Start session to access login data
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
    <link rel="stylesheet" href="Description.css">
    <link rel="icon" href="Logo Pics/Logo11.png" type="image/x-icon">
    <title>SD FreshCart | Quality and Convenience, Just a Click Away</title>
</head>
<body bgcolor="#e0e0e0" onload="showSlides()">

<?php include 'navbar.php'; ?>

  <div class="description-container">
    <div class="description-image">
        <img src="Vegetabales Pics/carrot.jpg" alt="Carrot">
    </div>
    <div class="description-info">
        <h1>Carrot - 500g</h1>
        <p class="price">
            <span class="discounted-price">Rs. 90.00</span> 
            <span class="original-price">Rs. 100.00</span>
            <p><b>(inclusive of all taxes)</b></p>
        </p><br>

        <a href="cart.html"><button>Add To Cart</button></a>
        <div class="item-description">
            <h2>About this product</h2>
            <p>
                Carrots are the perfect snack — crunchy, full of nutrients, low in calories, and sweet. 
                They’re associated with heart and eye health, improved digestion, and even weight loss. 
                This root vegetable comes in several colors, sizes, and shapes, all of which are great additions to a healthy diet. 
                [Source: www.healthline.com] Disclaimer: Please note that the image is used for presentation purposes only. 
                Actual product may slightly defer. Our team at SD Freshcart takes every step to ensure to maintain the accuracy of all information displayed.
                Images for illustration purposes only. Product received may vary.
            </p>
        </div>
    </div>
</div>

<?php include 'Footer.php'; ?>

  </body>
  </html>