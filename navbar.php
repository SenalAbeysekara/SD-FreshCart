<!-- navbar.php -->
<?php
    
    if (isset($_SESSION['username'])) {
        
        echo '
        <div class="banner">
            <div class="navbar">
                <a href="Home.php"><img src="Logo Pics/Logo10.png" alt="SD Freshcart" class="logo"></a>
                <div class="hamburger" onclick="toggleMenu()">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
                <ul class="nav-links">
                    <li><a href="Home.php">Home</a></li>
                    <li class="dropdown">
                        <a href="#">Categories ⮟</a>
                        <div class="dropdown-content">
                            <a href="Vegetables.php">Vegetables</a>
                            <a href="Snack.php">Snacks & Confectionery</a>
                            <a href="Fruits.php">Fruits</a>
                            <a href="Beverags.php">Beverages</a>
                            <a href="Dairy.php">Dairy Products</a>
                            <a href="#">Seeds & Spices</a>
                            <a href="#">Frozen Food</a>
                            <a href="#">Rice</a>
                            <a href="#">Household</a>
                            <a href="#">Baby Products</a>
                        </div>
                    </li>
                    <li><a href="Deals.php">Special Deals</a></li>
                    <li><a href="AboutUs.php">About Us</a></li>
                    <li><a href="ContactUs.php">Contact US</a></li>
                </ul>
                <div class="search">
                    <form action="searchResults.php" method="get">
                        <input type="search" name="query" id="searchBox" placeholder="Search For Products..." required>
                        <button type="submit"><b>Search</b></button>
                    </form>
                </div>
                <script src="main.js"></script>
  
  <div class="profile-dropdown">
    <img src="Icons/login New.png" width="30px" class="profile-icon">
    <div class="dropdown-menu">
      <div class ="prof-links"><a href="profile.php">My Profile</a></div>
      <div class ="prof-links"><a href="purchase.php">View Purchase History </a></div>
      <div class ="prof-links"><a href="logout.php">Logout</a></div>
    </div>
  </div>
  
  <div class="cart">
    <a href="cart.php"><img src="Icons/cart2.png" width="30px" class="logo2"></a>
  </div>
            </div>
        </div>';
    } else {
        
        echo '
        <div class="banner">
            <div class="navbar">
                <a href="Home.php"><img src="Logo Pics/Logo10.png" alt="SD Freshcart" class="logo"></a>
                <div class="hamburger" onclick="toggleMenu()">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
                <ul class="nav-links">
                    <li><a href="Home.php">Home</a></li>
                    <li class="dropdown">
                        <a href="#">Categories ⮟</a>
                        <div class="dropdown-content">
                            <a href="Vegetables.php">Vegetables</a>
                            <a href="Snack.php">Snacks & Confectionery</a>
                            <a href="Fruits.php">Fruits</a>
                            <a href="Beverags.php">Beverages</a>
                            <a href="Dairy.php">Dairy Products</a>
                            <a href="#">Seeds & Spices</a>
                            <a href="#">Frozen Food</a>
                            <a href="#">Rice</a>
                            <a href="#">Household</a>
                            <a href="#">Baby Products</a>
                        </div>
                    </li>
                    <li><a href="Deals.php">Special Deals</a></li>
                    <li><a href="AboutUs.php">About Us</a></li>
                    <li><a href="ContactUs.php">Contact US</a></li>
                </ul>
                <div class="search">
                    <form action="searchResults.php" method="get">
                        <input type="search" name="query" id="searchBox" placeholder="Search For Products..." required>
                        <button type="submit"><b>Search</b></button>
                    </form>
                </div>
                <script src="main.js"></script>

                <div class="login">
                    <a href="login.php"><img src="Icons/login New.png" width="30px" class="logo3"></a>
                </div>
                <div class="cart">
                    <a href="cart.php"><img src="Icons/cart2.png" width="30px" class="logo2"></a>
                </div>
            </div>
        </div>';
    }
    ?>

