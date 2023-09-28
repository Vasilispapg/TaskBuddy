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
                <form id='form' action='php/sign-up.php' enctype="multipart/form-data" method="post" class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5">
                        <div class="row mb-4 px-3 singupwith">
                            <h6 class="mb-0 mr-4 mt-2">Sign up with</h6>
                            <div class="facebook text-center mr-3"><div class="fa fa-facebook"></div></div>
                            <div class="twitter text-center mr-3"><div class="fa fa-twitter"></div></div>
                            <div class="linkedin text-center mr-3"><div class="fa fa-linkedin"></div></div>
                        </div>
                        <div class="row px-3 mb-4 ordiv">
                            <div class="line"></div>
                            <small class="or text-center">Or</small>
                            <div class="line"></div>
                        </div>
                        <div class="row px-3 fullname">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Full Name</h6></label>
                            <input class="mb-4" type="text" name="fullname" required placeholder="Enter your full name">
                        </div>
                        <div class="row px-3 username">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Username</h6></label>
                            <input class="mb-4" type="text" id='uname' required name="username" placeholder="Enter your username">
                            <p id="errorname"></p>
                        </div>
                        <div class="row px-3 phone">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Phone</h6></label>
                            <input class="mb-4" type="tel" id='phone' pattern="69[0-9]{8}" required name="phone" placeholder="Enter your phone">
                            <p id="errorphone"></p>
                        </div>
                        <div class="row px-3 email">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Email Address</h6></label>
                            <input class="mb-4" type="email" id='email' required name="email" placeholder="Enter a valid email address">
                            <div id="erroremail"></div>
                        </div>
                        <div class="row px-3 bdate">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Birthday</h6></label>
                            <div>
                                <select aria-label="Ημέρα" name="birthday_day" id="day" title="Ημέρα"><option class="option" value="1">1</option><option class="option" value="2">2</option><option class="option" value="3">3</option><option class="option" value="4">4</option><option class="option" value="5">5</option><option class="option" value="6">6</option><option class="option" value="7">7</option><option class="option" value="8">8</option><option class="option" value="9">9</option><option class="option" value="10">10</option><option class="option" value="11">11</option><option class="option" value="12">12</option><option class="option" value="13">13</option><option class="option" value="14">14</option><option class="option" value="15">15</option><option class="option" value="16">16</option><option class="option" value="17">17</option><option class="option" value="18">18</option><option class="option" value="19">19</option><option class="option" value="20">20</option><option class="option" value="21">21</option><option class="option" value="22">22</option><option class="option" value="23">23</option><option class="option" value="24">24</option><option class="option" value="25" selected="1">25</option><option class="option" value="26">26</option><option class="option" value="27">27</option><option class="option" value="28">28</option><option class="option" value="29">29</option><option class="option" value="30">30</option><option class="option" value="31">31</option></select>
                                <select aria-label="Μήνας" name="birthday_month" id="month" title="Μήνας"><option class="option" value="1">Ιαν</option><option class="option" value="2">Φεβ</option><option class="option" value="3">Μαρ</option><option class="option" value="4" selected="1">Απρ</option><option class="option" value="5">Μάι</option><option class="option" value="6">Ιουν</option><option class="option" value="7">Ιουλ</option><option class="option" value="8">Αυγ</option><option class="option" value="9">Σεπ</option><option class="option" value="10">Οκτ</option><option class="option" value="11">Νοεμ</option><option class="option" value="12">Δεκ</option></select>
                                <select aria-label="Έτος" name="birthday_year" id="year" title="Έτος"><option class="option" value="2021" selected="1">2021</option><option class="option" value="2020">2020</option><option class="option" value="2019">2019</option><option class="option" value="2018">2018</option><option class="option" value="2017">2017</option><option class="option" value="2016">2016</option><option class="option" value="2015">2015</option><option class="option" value="2014">2014</option><option class="option" value="2013">2013</option><option class="option" value="2012">2012</option><option class="option" value="2011">2011</option><option class="option" value="2010">2010</option><option class="option" value="2009">2009</option><option class="option" value="2008">2008</option><option class="option" value="2007">2007</option><option class="option" value="2006">2006</option><option class="option" value="2005">2005</option><option class="option" value="2004">2004</option><option class="option" value="2003">2003</option><option class="option" value="2002">2002</option><option class="option" value="2001">2001</option><option class="option" value="2000">2000</option><option class="option" value="1999">1999</option><option class="option" value="1998">1998</option><option class="option" value="1997">1997</option><option class="option" value="1996">1996</option><option class="option" value="1995">1995</option><option class="option" value="1994">1994</option><option class="option" value="1993">1993</option><option class="option" value="1992">1992</option><option class="option" value="1991">1991</option><option class="option" value="1990">1990</option><option class="option" value="1989">1989</option><option class="option" value="1988">1988</option><option class="option" value="1987">1987</option><option class="option" value="1986">1986</option><option class="option" value="1985">1985</option><option class="option" value="1984">1984</option><option class="option" value="1983">1983</option><option class="option" value="1982">1982</option><option class="option" value="1981">1981</option><option class="option" value="1980">1980</option><option class="option" value="1979">1979</option><option class="option" value="1978">1978</option><option class="option" value="1977">1977</option><option class="option" value="1976">1976</option><option class="option" value="1975">1975</option><option class="option" value="1974">1974</option><option class="option" value="1973">1973</option><option class="option" value="1972">1972</option><option class="option" value="1971">1971</option><option class="option" value="1970">1970</option><option class="option" value="1969">1969</option><option class="option" value="1968">1968</option><option class="option" value="1967">1967</option><option class="option" value="1966">1966</option><option class="option" value="1965">1965</option><option class="option" value="1964">1964</option><option class="option" value="1963">1963</option><option class="option" value="1962">1962</option><option class="option" value="1961">1961</option><option class="option" value="1960">1960</option><option class="option" value="1959">1959</option><option class="option" value="1958">1958</option><option class="option" value="1957">1957</option><option class="option" value="1956">1956</option><option class="option" value="1955">1955</option><option class="option" value="1954">1954</option><option class="option" value="1953">1953</option><option class="option" value="1952">1952</option><option class="option" value="1951">1951</option><option class="option" value="1950">1950</option><option class="option" value="1949">1949</option><option class="option" value="1948">1948</option><option class="option" value="1947">1947</option><option class="option" value="1946">1946</option><option class="option" value="1945">1945</option><option class="option" value="1944">1944</option><option class="option" value="1943">1943</option><option class="option" value="1942">1942</option><option class="option" value="1941">1941</option><option class="option" value="1940">1940</option><option class="option" value="1939">1939</option><option class="option" value="1938">1938</option><option class="option" value="1937">1937</option><option class="option" value="1936">1936</option><option class="option" value="1935">1935</option><option class="option" value="1934">1934</option><option class="option" value="1933">1933</option><option class="option" value="1932">1932</option><option class="option" value="1931">1931</option><option class="option" value="1930">1930</option><option class="option" value="1929">1929</option><option class="option" value="1928">1928</option><option class="option" value="1927">1927</option><option class="option" value="1926">1926</option><option class="option" value="1925">1925</option><option class="option" value="1924">1924</option><option class="option" value="1923">1923</option><option class="option" value="1922">1922</option><option class="option" value="1921">1921</option><option class="option" value="1920">1920</option><option class="option" value="1919">1919</option><option class="option" value="1918">1918</option><option class="option" value="1917">1917</option><option class="option" value="1916">1916</option><option class="option" value="1915">1915</option><option class="option" value="1914">1914</option><option class="option" value="1913">1913</option><option class="option" value="1912">1912</option><option class="option" value="1911">1911</option><option class="option" value="1910">1910</option><option class="option" value="1909">1909</option><option class="option" value="1908">1908</option><option class="option" value="1907">1907</option><option class="option" value="1906">1906</option><option class="option" value="1905">1905</option></select>
                            </div>
                        </div>
                        <div class="row px-3 password">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                            <input type="password" id="password" required name="password" placeholder="Enter password">
                        </div>
                        <div class="row px-3 passwordconfirm">
                            <label class="mb-1"><h6 class="mb-0 text-sm">Confirm Password</h6></label>
                            <input type="password" id="confirmPassword" required name="confirmPassword" placeholder="Confirm password">
                        </div>
                        <div class="row mb-3 px-3">
                            <span id="passwordError" class="text-danger"></span>
                        </div>
                        <div class="form-group profileimage">
                            <label class="mb-1" for='image'><h6 class="mb-0 text-sm">Profile Image</h6></label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <div class="checkbox buddy">
                            <p>Do you want to be TaskBuddy:</p>
                            <input type="checkbox" name="checkbox" value="buddy" style="--s:25px">
                        </div>
                        <div class="row mb-3 px-3">
                            <button type="submit" id='submit' class="btn btn-blue text-center">Register</button>
                        </div>
                        <div class="row mb-4 px-3 acc">
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
    
<script src='scripts/checker.js'></script>
<script src='scripts/showhideElements.js'></script>
<script src='scripts/passwordSame.js'></script>
</html>