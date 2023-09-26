<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="web_stuff/css/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css"> -->

    <title>Login/Singup</title>
</head>
<body>
    <!-- edw kane na ginei logout ama jana erthei edw -->
    <header class="header">
        <menu class="menu">
            <div class="logo"><a class="logo" href="index.php">TaskBuddy</a></div>
            <ul class="nav-list">
                <li><a href="#">Browse Tasks</a></li>
                <li><a href="login.php">Sign Up / Login</a></li>
                <li><a class='actionbutton' href="#">Become a Buddy</a></li>
            </ul>
        </menu>
    </header>
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto" >
        <div class="card card0 border-0">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="card1 pb-5">
                        <div class="row">
                            <img src="https://i.imgur.com/CXQmsmF.png" class="logo">
                        </div>
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                            <img src="https://i.imgur.com/uNGdWHi.png" class="image">
                        </div>
                    </div>
                </div>
                <form id='form' action='php/sign-up.php'  method="post" class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5">
                        <div class="row mb-4 px-3">
                            <h6 class="mb-0 mr-4 mt-2">Sign up with</h6>
                            <div class="facebook text-center mr-3"><div class="fa fa-facebook"></div></div>
                            <div class="twitter text-center mr-3"><div class="fa fa-twitter"></div></div>
                            <div class="linkedin text-center mr-3"><div class="fa fa-linkedin"></div></div>
                        </div>
                        <div class="row px-3 mb-4">
                            <div class="line"></div>
                            <small class="or text-center">Or</small>
                            <div class="line"></div>
                        </div>
                        <div class="row px-3">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Full Name</h6></label>
                            <input class="mb-4" type="text" name="fullname" required placeholder="Enter your full name">
                        </div>
                        <div class="row px-3">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Username</h6></label>
                            <input class="mb-4" type="text" id='uname' onkeyup="changeName();" required name="username" placeholder="Enter your username">
                            <p id="errorname"></p>
                        </div>
                        <div class="row px-3">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Phone</h6></label>
                            <input class="mb-4" type="text" id='phone' onkeyup="changePhone();" required name="phone" placeholder="Enter your phone">
                            <p id="errorphone"></p>
                        </div>
                        <div class="row px-3">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Email Address</h6></label>
                            <input class="mb-4" type="email" id='email' onkeyup="changeEmail();" required ="email" placeholder="Enter a valid email address">
                            <div id="erroremail"></div>
                        </div>
                        <div class="row px-3">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                            <input type="password" id="password" required name="password" placeholder="Enter password">
                        </div>
                        <div class="row px-3">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Confirm Password</h6></label>
                            <input type="password" id="confirmPassword" required name="confirmPassword" placeholder="Confirm password">
                        </div>
                        <div class="row mb-3 px-3">
                            <span id="passwordError" class="text-danger"></span>
                        </div>
                        <div class="checkbox">
                            <p>Do you want to be TaskBuddy:</p>
                            <input type="checkbox" name="checkbox" value="buddy" style="--s:25px">
                        </div>
                        <div class="row mb-3 px-3">
                            <button type="submit" id='submit' class="btn btn-blue text-center">Register</button>
                        </div>
                        <div class="row mb-4 px-3">
                            <small class="font-weight-bold">Already have an account? <a href="login.php" class="text-danger">Login</a></small> <!-- Update the link to point to your login page -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="bg-blue py-4">
                <div class="row px-3">
                    <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2024. All rights reserved.</small>
                    <div class="social-contact ml-4 ml-sm-auto">
                        <span class="fa fa-facebook mr-4 text-sm"></span>
                        <span class="fa fa-google-plus mr-4 text-sm"></span>
                        <span class="fa fa-linkedin mr-4 text-sm"></span>
                        <span class="fa fa- twitter mr-4 mr-sm-5 text-sm"></span>
                    </div>
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
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            </ul>
        </div>
    </footer>
</body>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const passwordField = document.getElementById("password");
            const confirmPasswordField = document.getElementById("confirmPassword");
            const passwordError = document.getElementById("passwordError");
            const registerButton = document.getElementById("registerButton");

            confirmPasswordField.addEventListener("input", () => {
                const password = passwordField.value;
                const confirmPassword = confirmPasswordField.value;

                if (password === confirmPassword) {
                    passwordError.textContent = "";
                    registerButton.disabled = false;
                } else {
                    passwordError.textContent = "Passwords do not match.";
                    registerButton.disabled = true;
                }
            });
        });
    </script>
    <script src='scripts/checker_beforelogin.js'></script>
</html>