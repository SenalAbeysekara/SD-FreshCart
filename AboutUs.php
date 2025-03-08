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
        body {
            background-color: #e0e0e0;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .AboutUs-container {
            width: 90%;
            padding: 20px;
            background-color: white;
            margin: 20px auto;
            border: 1px solid rgba(107, 106, 106, 0.732);
            box-shadow: 0 0 15px rgba(107, 106, 106, 0.732);
            border-radius: 10px;
        }

        .title {
            font-weight: bold;
            font-size: 30px;
            text-align: center;
            margin: 20px 0;
        }

        h {
            font-size: 22px;
            font-weight: bold;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            color: #333;
        }

        @media (max-width: 1024px) {
            .AboutUs-container {
                width: 90%;
            }
        }

        @media (max-width: 768px) {
            .AboutUs-container {
                width: 85%;
            }

            .title {
                font-size: 25px;
            }

            h {
                font-size: 20px;
            }
        }
    </style>
</head>

<body onload="showSlides()">

    <?php include 'navbar.php'; ?>

    <div class="title">About Us</div>

    <div class="AboutUs-container">
        <div class="aboutus1">
            <h>Our Motivation</h>
            <br><br>
            <p>
                Have you ever ordered groceries online and wondered when they’ll arrive? Ever worried whether you’ll get exactly what you ordered? You’re not alone.
                <br><br>
                At SD FreshCart, we listen to our customers' feedback. That's why we’ve worked tirelessly to make ordering online as seamless and stress-free as it should be. At SD FreshCart, we deliver everything you need, when you need it, fresh to your doorstep.
            </p>
            <br><br>
            <h>About SD FreshCart</h>
            <br><br>
            <p>
                SD FreshCart is an eCommerce platform designed to revolutionize the way you shop for groceries. Our service enables residents in specific areas to enjoy hassle-free delivery, straight to their home. Non-residents can also send groceries to their loved ones in serviceable areas. Delivery is restricted to postcodes listed on our website.
                <br><br>
                Customers can choose from a wide range of fresh produce, chilled and frozen items, including vegetables, fruits, dairy, and even pharmacy essentials. The products we offer will vary depending on availability, consumer demand, and delivery time, ensuring that our offerings are always relevant and fresh.
                <br><br>
                Just as you’ve trusted us with your in-store purchases, you can trust us to pick, pack, and deliver only the best grocery items, 365 days a year. SD FreshCart "Quality and Convenience, Just a Click Away"
            </p>
        </div>
    </div>

    <?php include 'Footer.php'; ?>

</body>

</html>
