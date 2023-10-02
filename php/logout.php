<?php
   session_name('user');
   session_start();

   $con = mysqli_connect("localhost", "root", "", "taskbuddynw");

   if (!$con) {
       die("Connection failed: " . mysqli_connect_error());
   }
   $sql = "UPDATE users set status='offline' WHERE id={$_SESSION['id']}";
   mysqli_query($con, $sql);
   

   // destroy the session
   session_unset();
   session_destroy();
   // echo 'You have cleaned session';
   header("location:..\index.php");
?>