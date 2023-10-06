<?php
session_name('user');
session_start();
if (isset($_COOKIE["user"])) {
    // Look up the user by the identifier stored in the session
    $user_id = $_COOKIE["user"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="web_stuff/css/404.css">
    <title>TaskBuddy</title>
</head>
<body>
<main class="container">
    <!-- Generate 40 <span> elements with class "particle" and content "4" -->
    <span class="particle">4</span><span class="particle">4</span><span class="particle">4</span>
	<span class="particle">4</span><span class="particle">4</span><span class="particle">4</span>
    <span class="particle">4</span><span class="particle">4</span>
	<span class="particle">4</span><span class="particle">4</span>
    <span class="particle">4</span><span class="particle">4</span>
	<span class="particle">4</span><span class="particle">4</span>
    <span class="particle">4</span><span class="particle">4</span>
    <span class="particle">4</span><span class="particle">4</span>
    <span class="particle">4</span><span class="particle">4</span>
    <span class="particle">4</span><span class="particle">4</span>
	<span class="particle">4</span><span class="particle">4</span>
    <span class="particle">4</span><span class="particle">4</span>
    <span class="particle">4</span><span class="particle">4</span>
    <span class="particle">4</span><span class="particle">4</span>
	<span class="particle">4</span><span class="particle">4</span>
    <!-- Repeat the above two lines 38 more times -->
    
    <!-- Generate 40 <span> elements with class "particle" and content "0" -->
    <span class="particle">0</span><span class="particle">0</span><span class="particle">0</span>
    <span class="particle">0</span><span class="particle">0</span><span class="particle">0</span>
	<span class="particle">0</span><span class="particle">0</span><span class="particle">0</span>
    <span class="particle">0</span><span class="particle">0</span><span class="particle">0</span>
	<span class="particle">0</span><span class="particle">0</span><span class="particle">0</span>
	<span class="particle">0</span><span class="particle">0</span><span class="particle">0</span>
    <span class="particle">0</span><span class="particle">0</span>
    <span class="particle">0</span><span class="particle">0</span>
    <span class="particle">0</span><span class="particle">0</span>
    <span class="particle">0</span><span class="particle">0</span>
    <span class="particle">0</span><span class="particle">0</span>
    <span class="particle">0</span><span class="particle">0</span>
    <!-- Repeat the above two lines 38 more times -->
    
    <!-- The content section with paragraphs and a button -->
    <article class="content">
        <p>Damnit stranger,</p>
        <p>You got lost in the <strong>404</strong> galaxy.</p>
        <p>
            <button><a href='index.php' style='text-decoration:none;color:black'>Go back to earth.</a></button>
        </p>
    </article>
</main>

</body>

</html>