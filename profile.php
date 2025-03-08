<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "sdfreshcart";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT name, username, dob, gender, phone, email FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);
    $name = $user['name'];
    $dob = $user['dob'];
    $gender = $user['gender'];
    $phone = $user['phone'];
    $email = $user['email'];
} else {
    echo "Error retrieving user data.";
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Home.css?v=<?php echo time(); ?>">
    <link rel="icon" href="Logo Pics/Logo11.png" type="image/x-icon">
    <title>Profile | SD FreshCart</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

        .profile-container {
            width: 80%;
            margin: 25px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            text-align: center;
        }

        .profile-pic {
            width: 210px;
            height: 210px;
            border-radius: 50%;
            margin: 20px auto;
            background-color: lightgrey;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .profile-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-details {
            margin-top: 20px;
        }

        .profile-details p {
            font-size: 18px;
            line-height: 1.6;
        }

        .profile-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .logout-btn {
            display: inline-block;
            width: 120px;
            padding: 10px;
            background-color: limegreen;
            color: black;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
        }

        .logout-btn:hover {
            background-color: #A3E77D;
        }
    </style>
</head>
<body bgcolor="#e0e0e0">
    <?php include 'navbar.php'; ?>

    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-pic">
                <img src="profile_pics/Logo1.png" alt="Profile Picture" class="profile-img">
            </div>
            <h2>Welcome, <?php echo $name; ?> !</h2>
        </div>

        <div class="profile-details">
            <p><strong>Username:</strong> <?php echo $username; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Phone:</strong> <?php echo $phone; ?></p>
            <p><strong>Date of Birth:</strong> <?php echo $dob; ?></p>
            <p><strong>Gender:</strong> <?php echo $gender; ?></p>
        </div>

        <div class="profile-buttons">
            <a href="profile_update.php" class="logout-btn">Update Profile</a>
            <a href="profile_delete.php" class="logout-btn">Delete Profile</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <?php include 'Footer.php'; ?>
</body>
</html>
