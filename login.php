<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];
    $rememberMe = isset($_POST['remember']);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sdfreshcart";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM users WHERE username = '$inputUsername' AND password = '$inputPassword'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user['username'];
        $_SESSION['name'] = $user['name'];

        if ($rememberMe) {
            setcookie('username', $user['username'], time() + (30 * 24 * 60 * 60), "/");
            setcookie('password', $user['password'], time() + (30 * 24 * 60 * 60), "/");
        } else {
            setcookie('username', '', time() - 3600, "/");
            setcookie('password', '', time() - 3600, "/");
        }

        if ($user['username'] === 'admin' && $user['password'] === 'admin') {
            header("Location: AdminProducts.php");
        } else {
            header("Location: Home.php");
        }
        exit();
    } else {
        echo "<script> 
                alert('Invalid username or password.'); 
              </script>";
    }
    mysqli_close($conn);
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
        .login-container {
            position: relative;
            text-align: center;
            width: 50%;
            height: auto;
            background-color: white;
            border: 1px solid rgba(107, 106, 106, 0.732);
            box-shadow: 0 0 15px rgba(107, 106, 106, 0.732);
            border-radius: 10px;
            padding: 38px 40px;
            margin: 0 auto;
            margin-top: 76px;
        }

        .login-container h1 {
            font-size: 30px;
            text-align: center;
        }

        .input-box {
            width: 100%;
            height: 50px;
            margin: 30px 0;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(16, 15, 15, 0.2);
            border-radius: 40px;
            font-size: 16px;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .input-box input::placeholder {
            color: rgb(189, 183, 183);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin: -15px 0 15px;
        }

        .remember-forgot input {
            accent-color: blue;
            margin-right: 3px;
        }

        .remember-forgot a {
            color: black;
            text-decoration: none;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .logBtn {
            width: 100%;
            height: 45px;
            background: limegreen;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgb(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: black;
            font-weight: bold;
        }

        .logBtn:hover {
            background-color: #A3E77D;
        }

        .signup-link {
            margin-top: 10px;
        }

        .signup-link p a {
            color: black;
            text-decoration: none;
            font-weight: bold;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 1024px) {
            .login-container {
                width: 80%;
            }
        }

        @media (max-width: 768px) {
            .login-container {
                width: 75%;
            }
        }
    </style>
</head>
<body bgcolor="#e0e0e0" onload="showSlides()">

<?php include 'navbar.php'; ?>

<div class="login-container">
    <form action="" method="POST">
        <h1>Customer Login</h1>
        <div class="input-box">
            <input type="text" name="username" placeholder="Username" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>" required>
        </div>
        <div class="input-box">
            <input type="password" name="password" placeholder="Password" value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>" required>
        </div>
        <div class="remember-forgot">
            <label><input type="checkbox" name="remember" <?php echo isset($_COOKIE['username']) ? 'checked' : ''; ?>> Remember me</label>
            <a href="forgetpass.php">Forgot password?</a>
        </div>
        <button type="submit" class="logBtn">Login</button>
        <div class="signup-link">
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </div>
    </form>
</div>

<?php include 'Footer.php'; ?>

</body>
</html>