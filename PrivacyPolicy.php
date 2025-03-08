<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Home.css?v=<?php echo time(); ?>">
    <link rel="icon" href="Logo Pics/Logo11.png" type="image/x-icon">
    <title>SD FreshCart | Quality and Convenience, Just a Click Away</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Playpen+Sans&display=swap');

        .title {
            position: relative;
            font-weight: bold;
            font-size: 30px;
            text-align: center;
            top: 8px;
        }

        .Privacy-container {
            position: relative;
            width: 80%;
            height: auto;
            padding: 20px;
            background-color: white;
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

<div class="title">Privacy & Policy</div>

<div class="Privacy-container">
    <div class="Privacy">
        <h>Welcome to SD FreshCart!</h>
        <br><br>
        <p>
            SD FreshCart is committed to protecting your privacy and ensuring transparency about how your information is collected, used, and disclosed. We only gather the necessary data and use it as outlined in this Privacy Policy, aiming to enhance your shopping experience. By accessing or using our website or mobile app, you agree to the terms of this policy. You can browse without providing personal details unless you choose to create an account for transactions.
            <br><br>
            Please note that this Privacy Policy may change periodically, so it's recommended to review it regularly. If you have any questions or need clarification, feel free to contact us at support@sdfreshcart.com
        </p>
        <br><br>
        <h>What information do we collect?</h>
        <br><br>
        <p>
            We may collect personal information including but not limited to:
            <br><br>
            <ul style="list-style-type: disc;">
                <li>Personal identifiers such as name and address (location/postal code)</li>
                <li>Online identifiers such as mobile number and email address</li>
                <li>Demographic information such as age and date of birth</li>
                <li>Internet, application, and network activity such as cookie IDs and browser visits</li>
                <li>Purchase history, including products previously bought</li>
            </ul>
        </p>
        <br><br>
        <h>How do we collect the information?</h>
        <br><br>
        <p>
            <ul style="list-style-type: disc;">
                <li>Information you disclose: We collect information if you choose to create an account, modify your account, or participate in surveys and opinion polls</li>
                <li>Automatic Information: We collect information automatically about your use of our services through cookies and other unique identifiers. When your browser or device accesses our services, we gather data such as your interaction with content and services.</li>
            </ul>
        </p>
        <br><br>
        <h>How do we use the information?</h>
        <br><br>
        <p>
            <ul style="list-style-type: disc;">
                <li>Process your orders and provide services through our website/mobile application.</li>
                <li>Administer your account and verify financial transactions.</li>
                <li>Improve and customize the layout/content of our website.</li>
                <li>Send relevant information about products, services, and promotions (provided you have not objected to such communications).</li>
            </ul>
        </p>
        <br><br>
        <h>How do we share your information?</h>
        <br><br>
        <p>
            We may share your information to fulfill legal obligations, facilitate decision-making and marketing within our company and affiliates, and with third-party delivery agents to complete orders. We also share data with third parties for fraud prevention and credit risk management. However, we do not sell or disclose your personal data to third parties without your consent, except as required by this policy or by law.
        </p>
        <br><br>
        <h>Cookies</h>
        <br><br>
        <p>
            Cookies help us recognize your Internet Protocol address and save time while using the site. While you can set your browser to not accept cookies, this may restrict your use of our services. Our cookies are virus-free and do not contain personal information.
        </p>
    </div>
</div>

<?php include 'Footer.php'; ?>

</body>
</html>
