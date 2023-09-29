<?php
session_name('user');
session_start();
if (isset($_COOKIE["user"])) {
    // Look up the user by the identifier stored in the cookie
    $user_id = $_COOKIE["user"];
}

// Check if the user was just registered (you can set a flag after successful registration)
$justRegistered = isset($_SESSION['justRegistered']) && $_SESSION['justRegistered'] === true;

if ($justRegistered) {
    // Echo JavaScript to trigger the modal
    echo '<script>
            $(document).ready(function() {
                $("#messageModal").modal("show");
            });
          </script>';
    
    // Reset the session flag
    $_SESSION['justRegistered'] = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="web_stuff/css/index.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <title>TaskBuddy</title>
</head>

<body>
<header class="header">

<menu class="menu">
    <div class="logo"><a class="logo" href="index.php">TaskBuddy</a></div>
    <ul class="nav-list">
        <li><a href="#">Browse Tasks</a></li>
        <?php
        if (isset($_SESSION["username"])) {
            // User is logged in, display their username and a link to their profile or dashboard
            echo '<li><a href="profile.php">Welcome ' . $_SESSION["username"] . '</a></li>';
            if($_SESSION['isBuddy'])
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
    <main>
        <section class="search-field">
            <img src="assets/work3.jpg" alt="">
            <section class="search-text">
                <h1>Get help. Gain happiness.</h1>
                <h4>Just task</h4>
                <form action="search.php" method="post" class="search">
                    <input type="text" name="search" placeholder="Search for a task...">
                    <button type="submit" name="submit-search">Search</button>
                </form>
            </section>
        </section>
        <section class="download_app">
            <div class="app-store-links">
                <a data-behavior="app-link-clicked" data-source="desktop-social-proof" href="https://apps.apple.com/app/id374165361" data-registered="">
                    <img alt="Download app from Apple Store" height="60" src="https://assets.taskrabbit.com/v3/assets/web/en-US/appstore_badge-86c9954e1457d27db013c1f10a96ffaba845e5af7765c4ef9df4ac1549e47d67.svg">
                </a>
                <a data-behavior="app-link-clicked" data-source="desktop-social-proof" href="https://play.google.com/store/apps/details?id=com.taskrabbit.droid.consumer" rel="noopener" target="_blank" data-registered="">
                    <img alt="Download app from Google Play Store" height="60" src="https://assets.taskrabbit.com/v3/assets/web/en-US/google_play_badge-49e6ea4ba78ca19b1246873b3369891cb6e289515c11418f1fce4cb3a694c18a.svg">
                </a>
            </div>

        </section>

        <section class="jobs">
            <h2 class="title">Popular projects in your area</h2>
            <div class="box-container-row">
                <div class="box-item">
                    <div class="flip-box">
                        <div class="flip-box-front text-center" style="background-image: url(https://assets.taskrabbit.com/v3/assets/web/homepage/components/popular_projects/desktop_59-97f36ec5d917ec6299b04ba7c94f4ad041a62945fa9c44cbbdc6af48a3cdc42b.jpg); background-size: cover;">
                            <div class="inner color-white">
                                <h3 class="flip-box-header">Home Cleaning</h3>
                                <p>Avg Price:
                                    <h2>10€</h2>
                                </p>
                                <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
                            </div>
                        </div>
                        <div class="flip-box-back text-center" style="background-image: url(https://assets.taskrabbit.com/v3/assets/web/homepage/components/popular_projects/desktop_59-97f36ec5d917ec6299b04ba7c94f4ad041a62945fa9c44cbbdc6af48a3cdc42b.jpg); background-size: cover;">
                            <div class="inner color-white">
                                <h3 class="flip-box-header">Home Cleaning</h3>
                                <p>People who want to help you:
                                    <h2>
                                        <h2>1342</h2>
                                    </h2>
                                </p>
                                <button class="flip-box-button">Ask a Buddy</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-item">
                    <div class="flip-box">
                        <div class="flip-box-front text-center" style="background-image: url(https://assets.taskrabbit.com/v3/assets/web/homepage/components/popular_projects/desktop_63-53a0834f2365d00e7517ed62ddcb344c6c27c9b076f76deb5b3707d2fe2b3f04.jpg); background-size: cover;">
                            <div class="inner color-white">
                                <h3 class="flip-box-header">Electrical help</h3>
                                <p>Avg Price:
                                    <h2>10€</h2>
                                </p>
                                <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
                            </div>
                        </div>
                        <div class="flip-box-back text-center" style="background-image: url(https://assets.taskrabbit.com/v3/assets/web/homepage/components/popular_projects/desktop_63-53a0834f2365d00e7517ed62ddcb344c6c27c9b076f76deb5b3707d2fe2b3f04.jpg); background-size: cover;">
                            <div class="inner color-white">
                                <h3 class="flip-box-header">Electrical help</h3>
                                <p>People who want to help you:
                                    <h2>1342</h2>
                                </p>
                                <button class="flip-box-button">Ask a Buddy</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-item">
                    <div class="flip-box">
                        <div class="flip-box-front text-center filter-" style="background-image: url(https://assets.taskrabbit.com/v3/assets/web/homepage/components/popular_projects/desktop_401-c3ed5c199aa212ee10bda1f06201e4d6676d91d958efb26c4f4722b1f4cd0a38.jpg); background-size: cover;">
                            <div class="inner color-white">
                                <h3 class="flip-box-header">Heavy Lifting</h3>
                                <p>Avg Price:
                                    <h2>10€</h2>
                                </p>
                                <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
                            </div>
                        </div>
                        <div class="flip-box-back text-center" style="background-image: url(https://assets.taskrabbit.com/v3/assets/web/homepage/components/popular_projects/desktop_401-c3ed5c199aa212ee10bda1f06201e4d6676d91d958efb26c4f4722b1f4cd0a38.jpg); background-size: cover;">
                            <div class="inner color-white">
                                <h3 class="flip-box-header">Heavy Lifting</h3>
                                <p>People who want to help you:
                                    <h2>1342</h2>
                                </p>
                                <button class="flip-box-button">Ask a Buddy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-container-row">
                <div class="box-item">
                    <div class="flip-box">
                        <div class="flip-box-front text-center" style="background-image: url(https://assets.taskrabbit.com/v3/assets/web/homepage/components/popular_projects/desktop_33-ff031721fe1fd6feeb779c3f4bc64e6384106167f4bead18f1fabeec31c7a3ba.jpg); background-size: cover;">
                            <div class="inner color-white">
                                <h3 class="flip-box-header">Furniture Assembly</h3>
                                <p>Avg Price:
                                    <h2>10€</h2>
                                </p>
                                <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
                            </div>
                        </div>
                        <div class="flip-box-back text-center" style="background-image: url(https://assets.taskrabbit.com/v3/assets/web/homepage/components/popular_projects/desktop_33-ff031721fe1fd6feeb779c3f4bc64e6384106167f4bead18f1fabeec31c7a3ba.jpg); background-size: cover;">
                            <div class="inner color-white">
                                <h3 class="flip-box-header">Furniture Assembly</h3>
                                <p>People who want to help you:
                                    <h2>1342</h2>
                                </p>
                                <button class="flip-box-button">Ask a Buddy</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-item">
                    <div class="flip-box">
                        <div class="flip-box-front text-center" style="background-image: url(https://assets.taskrabbit.com/v3/assets/web/homepage/components/popular_projects/desktop_405-73a06ac4080d93824936820f5b00e83d48e58a1695c69270961ad2e8819a2eb4.jpg); background-size: cover;">
                            <div class="inner color-white">
                                <h3 class="flip-box-header">Mount a TV, art or shelves</h3>
                                <p>Avg Price:
                                    <h2>10€</h2>
                                </p>
                                <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
                            </div>
                        </div>
                        <div class="flip-box-back text-center" style="background-image: url(https://assets.taskrabbit.com/v3/assets/web/homepage/components/popular_projects/desktop_405-73a06ac4080d93824936820f5b00e83d48e58a1695c69270961ad2e8819a2eb4.jpg); background-size: cover;">
                            <div class="inner color-white">
                                <h3 class="flip-box-header">Mount a TV, art or shelves</h3>
                                <p>People who want to help you:
                                    <h2>1342</h2>
                                </p>
                                <button class="flip-box-button">Ask a Buddy</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-item">
                    <div class="flip-box">
                        <div class="flip-box-front text-center filter-" style="background-image: url(https://assets.taskrabbit.com/v3/assets/web/homepage/components/popular_projects/desktop_6-56d6fa4bb3945b4fb95911ff2b1389e8973f1f7646ba1bf413f561a954b3c6b9.jpg); background-size: cover;">
                            <div class="inner color-white">
                                <h3 class="flip-box-header">Help Moving</h3>
                                <p>Avg Price:
                                    <h2>10€</h2>
                                </p>
                                <img src="https://s25.postimg.cc/65hsttv9b/cta-arrow.png" alt="" class="flip-box-img">
                            </div>
                        </div>
                        <div class="flip-box-back text-center" style="background-image: url(https://assets.taskrabbit.com/v3/assets/web/homepage/components/popular_projects/desktop_6-56d6fa4bb3945b4fb95911ff2b1389e8973f1f7646ba1bf413f561a954b3c6b9.jpg); background-size: cover;">
                            <div class="inner color-white">
                                <h3 class="flip-box-header">Help Moving</h3>
                                <p>People who want to help you:
                                    <h2>1342</h2>
                                </p>
                                <button class="flip-box-button">Ask a Buddy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- <section class="hero">
            <div class="text"></div>
            <div class="img">
                <img alt="A smiling man by a staircase, walking and holding a cardboard moving box" data-src="https://assets.taskrabbit.com/v3/assets/homepage/tasker1-desktop.jpg" src="https://assets.taskrabbit.com/v3/assets/homepage/tasker1-desktop.jpg">
            </div>
        </section> -->

        <section class="taskers_preview">

            <div class="person person1">
                <div class="wrapper">
                    <div class="top-icons">

                        <i class="far fa-heart"></i>
                    </div>

                    <div class="profile">
                        <img src="https://res.cloudinary.com/taskrabbit-com/image/upload/c_fill,g_faces,h_100,w_100/v1536956935/rnvgjqb6sedpox1cxkd3.jpg" class="thumbnail">
                        <div class="check"><i class="fas fa-check"></i></div>
                        <h3 class="name">Jeffrey C.</h3>
                        <p class="title">I'm the right person for the job:</p>
                        <p class="description">I have supplies and resources available for helping you with your move ins, move outs and move aroun...</p>
                        <div class="tasker-history">
                            <div class="tasker-reviews">
                                <i class="fas fa-star" style="color:#f9c339"></i>
                                <span>100% positive reviews</span>
                            </div>
                            <div class="completed-tasks">
                                <i class="fas fa-check" style="color:#0d7a5f"></i>
                                <span>174 completed tasks</span>
                            </div>
                        </div>
                        <button type="button" class="btn">Hire Me</button>
                    </div>

                    <div class="row tasker-card-center">
                        <span class="featured-skills-header">Featured Skills</span>
                        <div class="row tasker-category">
                            <label class="category-name">Help Moving</label>
                            <span class="category-price">€52.94/hr</span>
                        </div>
                        <div class="row tasker-category">
                            <label class="category-name">Home Repairs</label>
                            <span class="category-price">€52.94/hr</span>
                        </div>
                        <div class="row tasker-category">
                            <label class="category-name">Furniture Assembly</label>
                            <span class="category-price">€47.05/hr</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="person person2">
                <div class="wrapper">
                    <div class="top-icons">

                        <i class="far fa-heart"></i>
                    </div>

                    <div class="profile">
                        <img src="https://res.cloudinary.com/taskrabbit-com/image/upload/c_fill,g_faces,h_100,w_100/v1517529625/q19pyz80iljwc7dkr2id.jpg" class="thumbnail">
                        <div class="check"><i class="fas fa-check"></i></div>
                        <h3 class="name">Beverly Little</h3>
                        <p class="title">I'm the right person for the job:</p>
                        <p class="description">I have supplies and resources available for helping you with your move ins, move outs and move aroun...</p>
                        <div class="tasker-history">
                            <div class="tasker-reviews">
                                <i class="fas fa-star" style="color:#f9c339"></i>
                                <span>96% positive reviews</span>
                            </div>
                            <div class="completed-tasks">
                                <i class="fas fa-check" style="color:#0d7a5f"></i>
                                <span>577 completed tasks</span>
                            </div>
                        </div>
                        <button type="button" class="btn">Hire Me</button>
                    </div>

                    <div class="row tasker-card-center">
                        <span class="featured-skills-header">Featured Skills</span>
                        <div class="row tasker-category">
                            <label class="category-name">Help Moving</label>
                            <span class="category-price">€52.94/hr</span>
                        </div>
                        <div class="row tasker-category">
                            <label class="category-name">Home Repairs</label>
                            <span class="category-price">€52.94/hr</span>
                        </div>
                        <div class="row tasker-category">
                            <label class="category-name">Furniture Assembly</label>
                            <span class="category-price">€47.05/hr</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="person person3">
                <div class="wrapper">
                    <div class="top-icons">

                        <i class="far fa-heart"></i>
                    </div>

                    <div class="profile">
                        <img src="https://res.cloudinary.com/taskrabbit-com/image/upload/c_fill,g_faces,h_100,w_100/v1486604592/baiyms34f3zbnhcme6jv.jpg" class="thumbnail">
                        <div class="check"><i class="fas fa-check"></i></div>
                        <h3 class="name">John K.</h3>
                        <p class="title">I'm the right person for the job:</p>
                        <p class="description">I have supplies and resources available for helping you with your move ins, move outs and move aroun...</p>
                        <div class="tasker-history">
                            <div class="tasker-reviews">
                                <i class="fas fa-star" style="color:#f9c339"></i>
                                <span>98% positive reviews</span>
                            </div>
                            <div class="completed-tasks">
                                <i class="fas fa-check" style="color:#0d7a5f"></i>
                                <span>1953 completed tasks</span>
                            </div>
                        </div>
                        <button type="button" class="btn">Hire Me</button>
                    </div>

                    <div class="row tasker-card-center">
                        <span class="featured-skills-header">Featured Skills</span>
                        <div class="row tasker-category">
                            <label class="category-name">Help Moving</label>
                            <span class="category-price">€52.94/hr</span>
                        </div>
                        <div class="row tasker-category">
                            <label class="category-name">Home Repairs</label>
                            <span class="category-price">€52.94/hr</span>
                        </div>
                        <div class="row tasker-category">
                            <label class="category-name">Furniture Assembly</label>
                            <span class="category-price">€47.05/hr</span>
                        </div>
                    </div>
                </div>
            </div>

        </section>




    </main>
    <!-- Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Display your message here -->
                    <p>Your registration was successful.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">TaskBuddy</div>
            <div class="footer-links">
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-social">
            <ul>
                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</html>