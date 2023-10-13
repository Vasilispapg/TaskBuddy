<header class="header">
    <menu class="menu">
    <div class="logo"><a class="logo" href="index.php">TaskBuddy</a></div>
    <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="menu-icon">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </label>
    <ul class="nav-list">
        <li><a href="browseTasks.php">Browse Tasks</a></li>
        <?php
        if (isset($_SESSION["id"])) {
            // User is logged in, display their username and a link to their profile or dashboard
            echo '<li><a href="profile.php" id="profile" >Welcome ' . $_SESSION["fullname"] . '</a></li>';
            if($_SESSION['id'])
                echo '<li><a href="dashboard.php">Dashboard</a></li>';
            echo '<li><a href="php/logout.php">Logout</a></li>';

        } else {
            // User is not logged in, display the "Sign Up / Login" link
            echo '<li><a href="login.php">Sign Up / Login</a></li>';
            echo '<li><a class="actionbutton" href="#">Become a Buddy</a></li>';
            }
            ?>
        </ul>
    </menu>
</header>

<script>
    // JavaScript for handling the hamburger menu toggle
    const menuToggle = document.getElementById("menu-toggle");
    const navList = document.querySelector(".nav-list");

    menuToggle.addEventListener("click", () => {
        navList.classList.toggle("active");
    });
</script>