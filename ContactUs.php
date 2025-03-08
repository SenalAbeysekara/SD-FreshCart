<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '';
    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

    $conn = mysqli_connect("localhost", "root", "", "sdfreshcart");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    
    if (mysqli_query($conn, $query)) {
        echo "Your message has been sent successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
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

    <style>
        .contact-form {
            position: relative;
            width: 60%;
            height: auto;
            margin: 0 auto;
            text-align: center;
            border: 1px solid rgba(107, 106, 106, 0.732);
            box-shadow: 0 0 15px rgba(107, 106, 106, 0.732);
            border-radius: 10px;
            top: 20px;
            margin-bottom: -20px;
        }
        .contact-form h {
            font-weight: bold;
            font-size: 30px;
        }
        form {
            padding: 20px;
            border-radius: 5px;
        }
        .in, label, textarea {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background: black;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #555;
        }
        .contact {
            margin-top: 20px;
            border-top: 3px solid #ccc;
            padding-top: 20px;
        }
        .contact h2 {
            font-size: 18px;
        }
        @media (max-width: 1024px) {
            .contact-form {
                width: 90%;
            }
        }
        @media (max-width: 768px) {
            .contact-form {
                width: 87%;
            }
        }
    </style>
</head>
<body bgcolor="#e0e0e0">

<?php include 'navbar.php'; ?>

<div class="contact-form">
    <h>Contact Us</h>
    <form action="" method="POST">
        <label for="name">Name:</label>
        <input class="in" type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input class="in" type="email" id="email" name="email" required>
        
        <label for="subject">Subject:</label>
        <input class="in" type="text" id="subject" name="subject" required>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" placeholder="Enter your Message" required></textarea>
        
        <input class="in" type="submit" value="Send Message">
    </form>

    <script src="main.js"></script>

    <div class="contact">
        <h2>Contact Information</h2>
        <p><strong>Address:</strong> No. 192/4, SD FreshCart, Veyangoda, Sri Lanka</p>
        <p><strong>Phone:</strong> +94 77 290 6846</p>
        <p><strong>Email:</strong> <a href="https://www.google.com/intl/en/gmail/about/">SDFreshCart@gmail.com</a></p>
        <p>
            <a href="https://www.facebook.com/login/" target="_blank"><img src="Icons/facebook.png" height="30px"></a>
            <a href="https://www.instagram.com/accounts/login/?hl=en" target="_blank"><img src="Icons/instagram.png" height="30px"></a>
            <a href="https://x.com/?lang=en" target="_blank"><img src="Icons/twitter.png" height="30px"></a>
        </p>
    </div>
</div>

<?php include 'Footer.php'; ?>

</body>
</html>
