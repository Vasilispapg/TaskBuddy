<header class="header">
    <menu class="menu">
    <div class="logo"><a class="logo" href="index.php">TaskBuddy</a></div>
    <ul class="nav-list">
        <li><a href="#">Browse Tasks</a></li>
        <?php
        if (isset($_COOKIE["username"])) {
            // User is logged in, display their username and a link to their profile or dashboard
            echo '<li><a href="profile.php" id="profile" pass=' . $_COOKIE["id"] .' >Welcome ' . $_COOKIE["username"] . '</a></li>';
            if($_COOKIE['isBuddy']=='true')
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