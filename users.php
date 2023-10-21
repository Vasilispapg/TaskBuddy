<?php
session_name('user');
session_start();
if (isset($_COOKIE["user"]) && !empty($_SESSION["fullname"]) && ($_SESSION["role"]=='admin')) {
    // Look up the user by the identifier stored in the session
    $user_id = $_COOKIE["user"];
}
else{
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="web_stuff/css/dashboard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Admin</title>
</head>
<body>

<?php include 'components/header.php';?>
<div class="app-content">
<div class="products-area-wrapper tableView" id='Dashboard'>
                <div class="products-header">
                    <div class="product-cell image">
                    User
                    <button class="sort-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z"/></svg>
                    </button>
                    </div>
                    <div class="product-cell category">Username<button class="sort-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z"/></svg>
                    </button></div>
                    <div class="product-cell category">Email<button class="sort-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z"/></svg>
                    </button></div>
                    <div class="product-cell category">Phone<button class="sort-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z"/></svg>
                    </button></div>
                    <div class="product-cell status-cell">Status<button class="sort-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z"/></svg>
                    </button></div>
                    <div class="product-cell price">Role<button class="sort-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z"/></svg>
                    </button></div>
                    <div class="product-cell price">Job</div>
                    <div class="product-cell price">Since</div>
                    <div class="product-cell price">Bdate</div>
                    <div class="product-cell price">Location</div>
                    <div class="product-cell price">Valid Email</div>
                    <div class="product-cell price">Delete</div>
                </div> 
                <?php
                            // include('./components/dashboardTableHeader.php');

                    // Assuming you have a database connection established
                    $con = mysqli_connect("localhost", "root", "", "taskbuddynw") or die("Could not connect to the database");
                    if (mysqli_connect_errno() || !$con) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    } else {
                        // Fetch products data from the database (modify this query according to your database structure)
                        $data = array();
                        $query = 'SELECT * from users;';
                        $result = mysqli_query($con, $query);
                        
                        // Check if there are any products in the database
                        if (mysqli_num_rows($result) > 0) {
                            // Loop through the products and generate rows
                            
                            while ($row = mysqli_fetch_assoc($result) ) {

                                if(!$row['image_path']=='empty')
                                    $rowImage="assets/user_images/user_icon_df.png";
                                else
                                    $rowImage=ltrim($row['image_path'],'./');
                                foreach ($row as $key => $value) {
                                    // Check if the value is null or empty and set a default value
                                    if (is_null($value) || $value === '') {
                                        $row[$key] = 'empty';
                                    }
                                }
                                // $rowImages=mysqli_fetch_assoc($resultImages);
                                $data[] = $row;
                               

                                echo '<div class="products-row">';
                                    echo '<div class="product-cell image"> <img src='.$rowImage.' alt="user"><span>' . ucfirst($row['id']) . '</span></div>'; 
                                    echo '<div class="product-cell category">' . ucfirst($row['username']) . '</div>';
                                    echo '<div class="product-cell category" style="font-size:0.45em">' . ucfirst($row['email']) . '</div>';
                                    echo '<div class="product-cell category">' . ucfirst($row['phone']) . '</div>';
                                    echo '<div class="product-cell category">' . ucfirst($row['status']) . '</div>';
                                    echo '<div class="product-cell category">' . ucfirst($row['role']) . '</div>';
                                    echo '<div class="product-cell category">' . ucfirst($row['job']) . '</div>';
                                    echo '<div class="product-cell category">' . ucfirst($row['created_at']) . '</div>';
                                    echo '<div class="product-cell category">' . ucfirst($row['bdate']) . '</div>';
                                    echo '<div class="product-cell category">' . ucfirst($row['location']) . '</div>';
                                    echo '<div class="product-cell category">' . ucfirst($row['valid_email']) . '</div>';
                                    echo '<div class="product-cell action">
                                                <form action="php/user/deleteUser.php" method="GET">
                                                    <input type="hidden" name="user_id" value='.$row['id'].'> 
                                                    <button class="btn btn-danger" type="submit" name="delete_post">Delete</button>
                                                </form>
                                            </div>      
                                        </div>';  
                                }    
                            
                            // Convert the PHP array to JSON
                            $jsonData = json_encode($data);

                            // Store the JSON data in a session variable
                            $_SESSION['json_data'] = $jsonData;

                            echo '</div>';
                            
                        } else {
                            echo '<div style="color:white;margin-left:5px">No products found.</div></div>';
                        }
                    }
                    // Close the database connection
                    mysqli_close($con);
                ?>

    </div>
<?php include 'components/footer.php';?>

    
</body>
</html>