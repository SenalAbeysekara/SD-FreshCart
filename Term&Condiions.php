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
        .title {
            position: relative;
            font-weight: bold;
            font-size: 30px;
            text-align: center;
            top: 8px;
        }

        .Terms-container {
            padding: 20px;
            background-color: white;
            position: relative;
            width: 80%;
            height: auto;
            top: 10px;
            margin: 0 auto;
            margin-bottom: -20px;
            border: 1px solid rgba(107, 106, 106, 0.732);
            box-shadow: 0 0 15px rgba(107, 106, 106, 0.732);
            border-radius: 10px;
        }

        h {
            font-size: 22px;
            font-weight: bold;
        }
    </style>
</head>
<body bgcolor="#e0e0e0" onload="showSlides()">

<?php include 'navbar.php'; ?>

<div class="title">Terms & Conditions</div>
<div class="Terms-container">
    <div class="Terms">
        <h>SDFreshCart Terms and Conditions</h>
        <br><br>
        <p>Welcome to SDFreshCart! These terms and conditions govern your use of our website and mobile app. By creating an account and using our services, you agree to comply with these terms.</p>
        <br><h>Acceptance of Terms</h><br><br>
        <p>Users must read and understand these terms before using our services. By accessing, downloading, or using our website or app, you consent to these terms. If you disagree with any part, please refrain from using our services.</p>
        <br><h>Use of the Service</h><br><br>
        <p>SDFreshCart services are only available within Sri Lanka, and users are responsible for ensuring internet connectivity. You must have permission if the connection is not in your name.</p>
        <br><h>Registration</h><br><br>
        <p>To register, users must be 18 years or older and provide accurate information. By registering, you confirm that you:
            <ul style="list-style-type: disc;">
                <li>Are over 18 years old.</li>
                <li>Have not been suspended from the site before.</li>
                <li>Will maintain only one account.</li>
            </ul>
        </p>
        <br><h>Responsibility</h><br><br>
        <p>You are responsible for maintaining the confidentiality of your password and should notify us immediately if you suspect any unauthorized access to your account. We reserve the right to suspend or cancel accounts at our discretion in cases of policy breaches, and you may also request account cancellation by notifying us in writing. Regarding pricing, all products are sold at market retail prices, and while prices for fresh goods may change, no additional charges or refunds will be applied once an order is placed.</p>
        <br><h>Privacy Policy</h><br><br>
        <p>We are committed to protecting your data, which will be processed securely and only shared with authorized parties. Data will not be transferred to unaffiliated third parties without your consent.</p>
        <br><h>Limitation of Liability</h><br><br>
        <p>SDFreshCart provides services "as is" and makes no warranties regarding availability or accuracy. We are not liable for any losses or damages arising from the use of the website.</p>
        <br><h>Miscellaneous</h><br><br>
        <p>This agreement represents the entire understanding between users and SDFreshCart. If any part is found unenforceable, the rest remains in effect.</p>
    </div>
</div>

<?php include 'Footer.php'; ?>

</body>
</html>
