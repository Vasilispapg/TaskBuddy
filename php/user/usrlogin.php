<?php
session_name('user');
session_start();

// Check if the user is already logged in with a valid session
if (isset($_SESSION["id"])) {
    // User is already logged in, redirect them to the index page or their dashboard
    header("location:../../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $con = mysqli_connect("localhost", "root", "", "taskbuddynw");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user = mysqli_real_escape_string($con, $user);
    $sql = "SELECT * FROM users WHERE username='$user'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $storedHashedPassword = $row['password_hash'];

        if (password_verify($pass, $storedHashedPassword)) {
            // Successful login
            $_SESSION['error'] = 0;
            $_SESSION["status"] = 'Active Now';
            $_SESSION["username"] = $row['username']; 
            $_SESSION["id"] = $row['id']; 
            $_SESSION["location"] = $row['location']; 
            $_SESSION["fullname"] = $row['fullname']; 
            $_SESSION["role"] = $row['role']; 
            $_SESSION["about"] = $row['about']; 
            $_SESSION["email"] = $row['email']; 
            $_SESSION["phone"] = $row['phone']; 
            $_SESSION["created_at"] = $row['created_at']; 
            $_SESSION["job"] = $row['job']; 
            $_SESSION["image_path"] = $row['image_path']; 
            $_SESSION["bdate"] = $row['bdate']; 
            $_SESSION["isBuddy"] = $row['role'] == 'taskbuddy' ? true : false; 
            $_SESSION["isAdmin"] = $row['role'] == 'admin' ? true : false; 
            $_SESSION["wallet"] = $row['wallet'];
            
            $expire = time() + 86400 * 30; // 30 days
            
            setcookie("user", $row['role'], $expire, "/");

            //active user
            $sql_active="UPDATE users set status='active' where id={$row['id']}";
            $result_active = mysqli_query($con, $sql_active);
            if (!$result_active) {
                echo "Error executing the query: " . mysqli_error($con);
                mysqli_close($con);
                // header("location:../../login.php");
                exit();
            }

            // Fetch user's skills
            $sql_skills = "SELECT skills.name FROM user_skills, skills WHERE user_skills.user_id={$row['id']} AND user_skills.skill_id=skills.id";
            $result_skills = mysqli_query($con, $sql_skills);

            if ($result_skills) {
                $skills_array = [];
                while ($skill_row = mysqli_fetch_assoc($result_skills)) {
                    $skills_array[] = $skill_row['name'];
                }
                $_SESSION["skills"] = $skills_array;
            } else {
                echo "Error executing the query: " . mysqli_error($con);
            }

            mysqli_close($con);

            // Set a cookie to remember the user (optional)
            $expire = time() + 86400 * 30; // 30 days
            setcookie("user", $row['id'], $expire, "/");
            header("location:../../index.php");
            exit();
        }
    }

    // If login is not successful, set an error session variable
    $_SESSION['error'] = "Invalid username or password";
    mysqli_close($con);
    header("location:../../login.php");
    exit();
}

?>
