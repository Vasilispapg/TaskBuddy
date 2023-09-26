<?php

$user = $_POST['username'];
$pass = $_POST['password'];

$con = mysqli_connect("localhost", "root", "", "taskbuddynw");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $user = mysqli_real_escape_string($con, $user);

    $sql = "SELECT * FROM users WHERE username='$user'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $storedHashedPassword = $row['password_hash'];

            // Verify the entered password against the stored hashed password
            if (password_verify($pass, $storedHashedPassword)) {

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Handle other login validations (username, password, etc.)

                    if (isset($_POST["remember_me"])) {
                        // If "Remember Me" is selected, set a cookie with a long expiration time
                        $cookie_name = "user";
                        $cookie_value = $row['id']; // Store a user identifier
                        $cookie_expiration = time() + 30 * 24 * 60 * 60; // 30 days (adjust as needed)
                        
                        setcookie($cookie_name, $cookie_value, $cookie_expiration, "/");
                    }

                    // Perform the login and redirect the user as needed
                }

                session_name('user');
                session_start();
                $_SESSION['error'] = 0;
                $_SESSION["username"] = $row['username']; 
                $_SESSION["id"] = $row['id']; 
                $_SESSION["location"] = $row['location']; 
                $_SESSION["fullname"] = $row['fullname']; 
                $_SESSION["role"] = $row['role']; 
                $_SESSION["about"] = $row['about']; 
                $_SESSION["email"] = $row['email']; 
                $_SESSION["phone"] = $row['phone']; 
                $_SESSION["address"] = $row['address']; 
                $_SESSION["created_at"] = $row['created_at']; 
                $_SESSION["job"] = $row['job']; 

                //skills
                $sql_skills = "SELECT skills.name FROM user_skills, users, skills WHERE user_skills.user_id=users.id AND user_skills.skill_id=skills.id;";
                $result_skills = mysqli_query($con, $sql_skills);

                // Check if the query was successful
                if ($result_skills) {
                    // Fetch the data and store it in an array
                    $skills_array = array();

                    while ($row = mysqli_fetch_assoc($result_skills)) {
                        $skills_array[] = $row['name'];
                    }

                    // Store the array in the session
                    $_SESSION["skills"] = $skills_array;
                } else {
                    // Handle the case where the query failed
                    echo "Error executing the query: " . mysqli_error($con);
                }
                //skills

                header("location:../index.php");
                exit(); // Add this line to prevent further execution
            } else {
                $_SESSION['error'] = 1;
                header("location:../login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = 1;
            header("location:../login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = 1;
        header("location:../login.php");
        exit();
    }
    mysqli_close($con);
}
?>
