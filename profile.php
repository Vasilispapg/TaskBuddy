<?php
session_name('user');
session_start();
if (isset($_COOKIE["user"]) && !empty($_SESSION["fullname"])) {
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
    <title>Profile</title>
    
    <link rel="stylesheet" href="web_stuff/css/profile.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<body>
  <?php include_once('./components/header.php');?>

  <div class="container">
      <div class="main-body">
      
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)"><?php if(isset($_SESSION['fullname'])) echo $_SESSION['username'];?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
              </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- TODO
              confirmation email
              phone verification
            -->
      
            <div class="row gutters-sm">
              <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center ">
                    <div class="profile-content">
                        <div class="profile-pic">
                            <img src="<?php if(isset($_SESSION['image_path'])) echo ltrim($_SESSION['image_path'], './'); else {echo 'assets/user_images/user_icon_df.png"'; echo 'style="object-fit:contain !important"';} ?>" alt="Admin" class="rounded-circle">
                        </div>
                    </div>
                      <div class="mt-3">
                        <h4><?php if(isset($_SESSION['fullname'])) echo $_SESSION['fullname'];?></h4>
                        <p class="text-secondary mb-1"><?php if(isset($_SESSION['job'])) {echo $_SESSION['job'];}?></p>
                        <p class="text-muted font-size-sm"><?php if(isset($_SESSION['location'])) echo $_SESSION['location'];?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card mt-3">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                      <span class="text-secondary">https://bootdey.com</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
                      <span class="text-secondary">bootdey</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
                      <span class="text-secondary">@bootdey</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
                      <span class="text-secondary">bootdey</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                      <span class="text-secondary">bootdey</span>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                      <?php if(isset($_SESSION['email'])) echo $_SESSION['email'];?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Phone</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                      <?php if(isset($_SESSION['phone'])) echo $_SESSION['phone'];?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Birth Date</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                      <?php if(isset($_SESSION['bdate'])) echo $_SESSION['bdate'];?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">About</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                      <?php if(isset($_SESSION['about'])) echo $_SESSION['about'];?>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-2">
                        <a class="btn btn-info " target="__blank" href="profile_edit.php">Edit</a>
                      </div>
                      <div class="col-sm-10">
                        <a class="btn btn-info " target="__blank" href="change_password.php">Change Password</a>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
      </div>

    <?php 
      include_once('./components/modal.php');
      include_once('./components/footer.php');
    ?>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
// Add this script to trigger the modal on page load
document.addEventListener("DOMContentLoaded", function() {
    // Check if the password was successfully changed and the query parameter is present
    if (window.location.href.includes('?changed=true')) {
        document.getElementById('modalToggleTrue').click(); // Click on the button to trigger the modal
    }
    else if(window.location.href.includes('?changed=false')){
        document.getElementById('modalToggleFalse').click(); // Click on the button to trigger the modal
    }
});
</script>
</html>