<?php

    $phone = $_GET['phone'];
   
    $con = mysqli_connect("localhost","root","") or die("Could not connect to the database");
    if (mysqli_connect_errno() || !$con){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else{
        
        mysqli_select_db($con,"taskbuddynw");
        
        $sql="SELECT phone FROM users WHERE phone='".$phone."'";
        $result=mysqli_query($con,$sql);
        if($result)
            if(mysqli_num_rows($result)>0)
                echo "This phone already exists";
                
        mysqli_close($con);
    }


?>