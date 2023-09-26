<?php
    session_name('user');
    session_start();
    //mpainw se ayto to session

    $con = mysqli_connect('localhost', 'root', '') or  die("Connection failed: " . mysqli_connect_error());
    mysqli_select_db($con,"taskbuddynw");


    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $fullname=$_POST['fullname'];
    $address=$_POST['address'];
    $password=$_POST['password'];
    $username=$_POST['uname'];
    $location=$_POST['location'];
    $job=$_POST['job'];
    $about=$_POST['about'];

    echo $username;

    // $img=$_FILES['image']['name'];
    // $target = "../assets/user_images/".basename($img);

    //     if ($_FILES["image"]["size"] > 50000000) {
    //       echo "Sorry, your file is too large.";
    //   }

        // if(!empty($img)){
        //   $sql="UPDATE users SET image='".$img."' WHERE username='".$username."'";
        //   if (mysqli_query($con, $sql))
        //     $_SESSION['image']=$img;
        // }//image
        if (empty($password)) {
            $sql="UPDATE users SET email='".$email."',phone='".$phone."', address='".$address."',
             fullname='".$fullname."',username='".$username."', location='".$location."' WHERE id='".$_SESSION['id']."'"; 
        }
        else{
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

            $sql="UPDATE users SET password_hash='".$hashedPassword."',email='".$email."',phone='".$phone."',
            address='".$address."', fullname='".$fullname."',username='".$username."', location='".$location."' WHERE id='".$_SESSION['id']."'"; 
        }

        if (mysqli_query($con, $sql)) {
            echo "Record updated successfully";
            // Update session variables with the updated data
            $_SESSION["location"] = $location;
            $_SESSION["fullname"] = $fullname; 
            $_SESSION["username"] = $username; 
            $_SESSION["about"] = $about; 
            $_SESSION["email"] = $email; 
            $_SESSION["phone"] = $phone; 
            $_SESSION["address"] = $address; 
            $_SESSION["job"] = $job;
            
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
        

        // if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        //     $msg = "Image uploaded successfully";
        // }else{
        //     $msg = "Failed to upload image";
        // }
    
        mysqli_close($con);

        header('location:..\profile.php');
    
?>