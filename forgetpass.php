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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $newPassword = trim($_POST['new_password']);
    $confirmPassword = trim($_POST['confirm_password']);

    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('New passwords do not match.');</script>";
    } else {
        $sql = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $updateSql = "UPDATE users SET password = '$newPassword' WHERE email = '$email'";
            if (mysqli_query($conn, $updateSql)) {
                echo "<script>
                        alert('Password reset successfully.');
                        window.location.href = 'login.php';
                      </script>";
                exit();
            } else {
                echo "<script>alert('Failed to reset password. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Email not found.');</script>";
        }
    }
}

mysqli_close($conn);
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

        .PassContainer {
            position: relative;
            text-align: center;
            width: 40%;
            margin: 95px auto 50px;
            padding: 38px 40px;
            background-color: white;
            border: 1px solid rgba(107, 106, 106, 0.732);
            box-shadow: 0 0 15px rgba(107, 106, 106, 0.732);
            border-radius: 10px;
        }

        .pass {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .passBtn {
            color: white;
            background-color: limegreen;
            padding: 8px;
            cursor: pointer;
            border: none;
            border-radius: 10px;
        }

        .passBtn:hover {
            background-color: #A3E77D;
        }
    </style>
</head>
<body bgcolor="#e0e0e0">

<?php include 'navbar.php'; ?>

<div class="PassContainer">
    <h2>Reset Password</h2>
    <form action="" method="POST">
        <input type="email" name="email" placeholder="Enter your email" required class="pass">
        <input type="password" name="new_password" placeholder="Enter new password" required class="pass">
        <input type="password" name="confirm_password" placeholder="Confirm new password" required class="pass">
        <button type="submit" class="passBtn">Reset Password</button>
    </form>
</div>

<?php include 'Footer.php'; ?>

</body>
</html>
