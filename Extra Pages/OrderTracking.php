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
    <link rel="icon" href="Logo Pics/Logo11.png" type="image/x-icon">
    <title>SD FreshCart | Quality and Convenience, Just a Click Away</title>

<style>
      .profile-dropdown {
    position: relative;
    display: inline-block;
  }
  .profile-icon {
    position: relative;
    width: 30px;
    top: 5px;
    right: 20px;
    cursor: pointer;
  }
  .dropdown-menu {
    display:none;
    position: absolute;
    top: 37px;
    right: 0;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 9px;
    margin: 0;
    width: 200px;
    z-index: 10;
  }
  .prof-links {
    text-align: left;
  }
  .prof-links a {
    display: block;
    padding: 10px 20px;
    border-radius: 9px;
    white-space: nowrap;
    text-decoration: none;
    color: black;
    font-weight: bold;
    font-size: 15px;
  }

  .prof-links a:hover {
    background-color: lightblue;
  }
  
  .profile-dropdown:hover .dropdown-menu {
    display: block;
  }
     .profile-container {
            max-width: 75%;
            margin: 50px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .orders-container {
            margin-top: 20px;
        }

        .orders-container h3 {
            margin-bottom: 10px;
            font-size: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: gray;
            color: white;
        }

        table td {
            background-color: #f9f9f9;
        }

        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
            }

            table th, table td {
                font-size: 14px;
            }
        }
    </style>
</head>
<body bgcolor="#e0e0e0" onload="showSlides()">

<?php include 'navbar.php'; ?>

  <div class="profile-container">
    <div class="orders-container">
        <h3>Order Tracking </h3>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>001</td>
                    <td>2024-11-15</td>
                    <td>Rs. 2500.00</td>
                    <td>Delivered</td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>2024-11-12</td>
                    <td>Rs. 3200.00</td>
                    <td>Canceled</td>
                </tr>
                <tr>
                    <td>003</td>
                    <td>2024-11-08</td>
                    <td>Rs. 1500.00</td>
                    <td>Shipped</td>
                </tr>
                <tr>
                    <td>004</td>
                    <td>2024-11-15</td>
                    <td>Rs. 850.00</td>
                    <td>Delivered</td>
                </tr>
                <tr>
                    <td>005</td>
                    <td>2024-11-12</td>
                    <td>Rs. 1820.00</td>
                    <td>Canceled</td>
                </tr>
                <tr>
                    <td>006</td>
                    <td>2024-11-08</td>
                    <td>Rs. 1700.00</td>
                    <td>Shipped</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include 'Footer.php'; ?>

  </body>
  </html>
