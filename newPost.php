<?php
session_name('user');
session_start();
if (isset($_COOKIE["user"]) && !empty($_SESSION["id"])) {
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
    <title>TaskBuddy</title>
    <link rel="stylesheet" href="web_stuff/css/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" />
    
    
</head>
<?php include 'components/header.php';?>


<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto" >
        <div class="card card0 border-0">
            <div class="row d-flex">
               
                <form id='postform' action='php/post/createPost.php' enctype="multipart/form-data" method="post" class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5" >

                        <div class="row px-3 title">
                            <label class="mb-1"><h6 class="mb-0 text">Τίτλος</h6></label>
                            <input class="mb-4" type="text" name="title" required placeholder="Enter a title">
                        </div>
                        <div class="row px-3 Description">
                            <label class="mb-1"><h6 class="mb-0 text">Περιγραφή</h6></label>
                            <textarea class="mb-4" type="text" id='desc' name="desc" placeholder="Enter your Description"></textarea>
                        </div>
                        <div class="row px-3 category">
                        <label class="mb-1"><h6 class="mb-0 text">Κατηγορία</h6></label>
                            <select id="categorySelect" name="category" class="custom-select"></select>
                        </div>

                        <div class="row px-3 price">
                            <label class="mb-1"><h6 class="mb-0 text">Τιμή</h6></label>
                            <input class="mb-4" type="price" id='price' required name="price" placeholder="Enter a Price">
                        </div>
                        <div class="form-group profileimages">
                            <label class="mb-1" for='image'><h6 class="mb-0 text">Πρόσθεσε μια φωτογραφία του προβλήματος</h6></label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <div class="row mb-3 px-3">
                            <button type="submit" id='submit' class="btn btn-blue text-center">Create a Post</button>
                        </div>
                    </div>
                </form>
                
            </div>
            <img src="assets/painter2.png" alt="" style='width: 50%;position: absolute;right: 0;'>
        </div>
      
    </div>

<?php include 'components/footer.php';?>
</body>

<style>
    @media screen and (max-width: 768px) {
        img{
            display: none;
        }
        .row,.form-group{
            margin-top:5px;
        }
    }
</style>
</html>

<script src='./scripts/client/addExpireAndCategoryField.js'></script>