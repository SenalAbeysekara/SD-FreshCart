<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['username']) && !empty($_POST['dob']) && !empty($_POST['gender']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm-password'])) {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sdfreshcart";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $name = $_POST['name'];
        $username = $_POST['username'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];

        if ($password !== $confirmPassword) {
            die("Passwords do not match.");
        }

        $emailCheckQuery = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $emailCheckQuery);

        if (mysqli_num_rows($result) > 0) {
            echo "<script> alert('Email already registered.'); window.location.href = 'signup.php';  </script>";
            exit();
        }

        $sql = "INSERT INTO users (name, username, dob, gender, phone, email, password) 
                VALUES ('$name', '$username', '$dob', '$gender', '$phone', '$email', '$password')";

        if (mysqli_query($conn, $sql)) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Playpen+Sans&display=swap');
    </style>
    <link rel="stylesheet" href="Home.css?v=<?php echo time(); ?>">
    <link rel="icon" href="Logo Pics/Logo11.png" type="image/x-icon">
    <title>SD FreshCart | Quality and Convenience, Just a Click Away</title>
    <style>
        .signup-form {
            position: relative;
            width: 50%;
            background-color: white;
            padding: 20px;
            border: 1px solid rgba(107, 106, 106, 0.732);
            box-shadow: 0 0 15px rgba(107, 106, 106, 0.732);
            border-radius: 10px;
            margin: 0 auto;
            top: 30px;
        }
        .signup-form h2 {
            font-size: 30px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .sign1 {
            display: block;
            margin-bottom: 5px;
        }
        .sign {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 3px;
            height: 35px;
        }
        .regBtn {
            width: 100%;
            padding: 10px;
            background-color: limegreen;
            border: none;
            color: black;
            font-weight: bold;
            border-radius: 3px;
            cursor: pointer;
        }
        .regBtn:hover {
            background-color: #A3E77D;
        }
        @media (max-width: 1024px) {
            .signup-form {
                width: 90%;
            }
        }
        @media (max-width: 768px) {
            .signup-form {
                width: 85%;
            }
        }
    </style>
</head>
<body bgcolor="#e0e0e0" onload="showSlides()">
    <?php include 'navbar.php'; ?>
    
    <div class="signup-form">
    <h2>Registration Form</h2>
    <form class="regForm" action="" method="POST" onsubmit="return validateForm()">
        <div class="form-group">
            <label class="sign1" for="name">Full Name:</label>
            <input class="sign" type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label class="sign1" for="username">Username:</label>
            <input class="sign" type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label class="sign1" for="DOB">DOB:</label>
            <input class="sign" type="date" id="DOB" name="dob" required>
        </div>
        <div class="form-group">
            <label class="sign1" for="gender">Gender:</label>
            <input type="radio" id="male" name="gender" value="male" required>
            <label for="male">Male</label><br>
            <input type="radio" id="female" name="gender" value="female" required>
            <label for="male">Female</label>
        </div>
        <div class="form-group">
            <label class="sign1" for="Phone">Phone:</label>
            <input class="sign" type="tel" id="Phone" name="phone" pattern="[0-9]{10}" title="Enter a valid 10-digit phone number" required>
        </div>
        <div class="form-group">
            <label class="sign1" for="email">Email:</label>
            <input class="sign" type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label class="sign1" for="password">Password:</label>
            <input class="sign" type="password" id="password" name="password" minlength="8" title="Password must be at least 8 characters" required>
        </div>
        <div class="form-group">
            <label class="sign1" for="confirm-password">Confirm Password:</label>
            <input class="sign" type="password" id="confirm-password" name="confirm-password" required>
        </div>
        <div class="form-group">
            <button type="submit" class="regBtn">Register</button>
        </div>
    </form>
</div>
<script>
    function validateForm() {
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm-password").value;

        if (!email.includes("@")) {
            alert("Please enter a valid email address.");
            return false;
        }

       
        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }

     
        const passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$/;
        if (!passwordPattern.test(password)) {
            alert(
                "Password must be at least 8 characters long and include uppercase letters, lowercase letters, a number, and a special character."
            );
            return false;
        }

        return true; 
    }
</script>

    <?php include 'Footer.php'; ?>
</body>
</html>
