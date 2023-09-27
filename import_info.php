<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="web_stuff/css/import_info.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
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
    <form class="form" action="">
  <p class="field required">
    <label class="label required" for="name">Full name</label>
    <input class="text-input" id="name" type="text" name="name" required value="Use Tab">
  </p>
  <p class="field required half">
    <label class="label" for="email">E-mail</label>
    <input class="text-input" id="email" type="email" name="email" required>
  </p>
  <p class="field half">
    <label class="label" for="phone">Phone</label>
    <input class="text-input" id="phone" type="tel" name="phone">
  </p>
  <p class="field half required error">
    <label class="label" for="login">Login</label>
    <input class="text-input" id="login" type="text" name="login" required value="mican">
    <!-- <span class="message">Already taken</span> -->
  </p>
  <p class="field half required">
    <label class="label" for="password">Password</label>
    <input class="text-input" id="password" type="password" name="password" required>
  </p>
  <div class="field">
    <label class="label">Sport?</label>
    <ul class="checkboxes">
      <li class="checkbox">
        <input class="checkbox-input" type="checkbox" name="choice" value="0" id="choice-0">
        <label class="checkbox-label" for="choice-0">Football</label>
      </li>
      <li class="checkbox">
        <input class="checkbox-input" type="checkbox" name="choice" value="1" id="choice-1">
        <label class="checkbox-label" for="choice-1">Basketball</label>
      </li>
      <li class="checkbox">
        <input class="checkbox-input" type="checkbox" name="choice" value="2" id="choice-2">
        <label class="checkbox-label" for="choice-2">Volleyball</label>
      </li>
      <li class="checkbox">
        <input class="checkbox-input" type="checkbox" name="choice" value="3" id="choice-3">
        <label class="checkbox-label" for="choice-3">Golf</label>
      </li>
      <li class="checkbox">
        <input class="checkbox-input" type="checkbox" name="choice" value="4" id="choice-4">
        <label class="checkbox-label" for="choice-4">Swimming</label>
      </li>
    </ul>
  </div>
  <div class="field">
    <label class="label">Favourite JS framework</label>
    <ul class="options">
      <li class="option">
        <input class="option-input" type="radio" name="option" value="0" id="option-0">
        <label class="option-label" for="option-0">React</label>
      </li>
      <li class="option">
        <input class="option-input" type="radio" name="option" value="1" id="option-1">
        <label class="option-label" for="option-1">Vue</label>
      </li>
      <li class="option">
        <input class="option-input" type="radio" name="option" value="2" id="option-2">
        <label class="option-label" for="option-2">Angular</label>
      </li>
      <li class="option">
        <input class="option-input" type="radio" name="option" value="3" id="option-3">
        <label class="option-label" for="option-3">Riot</label>
      </li>
      <li class="option">
        <input class="option-input" type="radio" name="option" value="4" id="option-4">
        <label class="option-label" for="option-4">Polymer</label>
      </li>
      <li class="option">
        <input class="option-input" type="radio" name="option" value="5" id="option-5">
        <label class="option-label" for="option-5">Ember</label>
      </li>
      <li class="option">
        <input class="option-input" type="radio" name="option" value="6" id="option-6">
        <label class="option-label" for="option-6">Meteor</label>
      </li>
      <li class="option">
        <input class="option-input" type="radio" name="option" value="7" id="option-7">
        <label class="option-label" for="option-7">Knockout</label>
      </li>
    </ul>
  </div>
  <p class="field">
    <label class="label" for="about">About</label>
    <textarea class="textarea" id="about" cols="50" name="about" rows="4"></textarea>
  </p>
  <p class="field half">
    <label class="label" for="select">Position</label>
    <select class="select" id="select" name="position">
      <option value="" selected></option>
      <option value="ceo">CEO</option>
      <option value="front-end">Front-end developer</option>
      <option value="back-end">Back-end developer</option>
    </select>
  </p>
  <p class="field half">
    <input class="button" type="submit" value="Send">
  </p>
</form>

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
</html>