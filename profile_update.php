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

$sql = "SELECT name, dob, gender, phone, email FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "Error retrieving user data.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $updateSql = "UPDATE users SET 
                    name = '$name', 
                    dob = '$dob', 
                    gender = '$gender', 
                    phone = '$phone', 
                    email = '$email' 
                  WHERE username = '$username'";

    if (mysqli_query($conn, $updateSql)) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='profile.php';</script>";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
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
    <title>Profile | SD FreshCart</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

        .update-form {
            width: 80%;
            margin: 25px auto;
            padding: 29px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .update-form h2 {
            text-align: center;
        }

        .update-form form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .update-form input, .update-form select {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .update-form button {
            padding: 10px;
            background-color: limegreen;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .update-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body bgcolor="#e0e0e0">

    <?php include 'navbar.php'; ?>

    <div class="update-form">
        <h2>Update Profile</h2>
        <form method="POST" action="">
            <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" placeholder="Name" required>
            <input type="date" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" required>
            <select name="gender" required>
                <option value="Male" <?php echo $user['gender'] === 'Male' ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo $user['gender'] === 'Female' ? 'selected' : ''; ?>>Female</option>
                <option value="Other" <?php echo $user['gender'] === 'Other' ? 'selected' : ''; ?>>Other</option>
            </select>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" placeholder="Phone" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" placeholder="Email" required>
            <button type="submit">Update Profile</button>
        </form>
    </div>

    <?php include 'Footer.php'; ?>
</body>
</html>
