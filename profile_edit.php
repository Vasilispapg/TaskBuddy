<?php
session_name('user');
session_start();
if (isset($_COOKIE["user"]) && !empty($_COOKIE["fullname"])) {
    // Look up the user by the identifier stored in the cookie
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
</head>
<body>
    <?php include_once('./header.php');?>

    <div class="container">
            <div class="main-body">
                          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)"><?php if(isset($_COOKIE['fullname'])) echo $_COOKIE['username'];?></a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center ">
                                <div class="profile-content">
                                    <div class="profile-pic">
                                        <img src="<?php if(isset($_COOKIE['fullname'])) echo ltrim($_COOKIE['image_path'], './'); else {echo 'assets/user_images/user_icon_df.png"'; echo 'style="object-fit:contain !important"';} ?>" alt="Admin" class="rounded-circle">
                                        <div class="overlay">
                                        <form enctype="multipart/form-data" method="post" action="php/uploadProfileImage.php" id="imageUploadForm">
                                            <label for="fileInput" class="btn btn-info">Pick Photo</label>
                                            <input type="file" id="fileInput" name="new_image" accept="image/*" style="display: none;">
                                            <button type="submit" class="btn btn-info" id="uploadButton" style="display: none;"></button>
                                        </form>
                                        </div>  
                                    </div>
                                </div>
                                                             
                            <div class="mt-3">
                                <h4><?php if(isset($_COOKIE['fullname'])) echo $_COOKIE['fullname'];?></h4>
                                <p class="text-secondary mb-1"><?php if(isset($_COOKIE['job'])) {echo $_COOKIE['job'];}?></p>
                                <p class="text-muted font-size-sm"><?php if(isset($_COOKIE['fullname'])) echo $_COOKIE['location'];?></p>
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
                    <form class="col-lg-8" method=post action='php/update_profile.php'>            
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name='fullname' value='<?php if(isset($_COOKIE['fullname'])) echo $_COOKIE['fullname'];?>'>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" class="form-control" id='email' name='email' value='<?php if(isset($_COOKIE['email'])) echo $_COOKIE['email'];?>'>
                                        <div id="erroremail"></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Username</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" id='uname' name='uname' value='<?php if(isset($_COOKIE['username'])) echo $_COOKIE['username'];?>'>
                                        <div id="errorname"></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="tel" class="form-control" id='phone' name='phone' pattern="69[0-9]{8}" value='<?php if(isset($_COOKIE['phone'])) echo $_COOKIE['phone'];?>'>
                                        <p id="errorphone"></p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Location</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select id="city" name="location" class='custom-select' currentLoc='<?php if(isset($_COOKIE['location'])) echo $_COOKIE['location'];?>'></select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Job</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name='job' value='<?php if(isset($_COOKIE['job'])) echo $_COOKIE['job'];?>'>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">About</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" style='height:calc(3.5em + .75rem + 2px)' class="form-control" name='about' value='<?php if(isset($_COOKIE['about'])) echo $_COOKIE['about'];?>'>
                                    </div>
                                </div>
                                <div class="row" style='margin-left:30%'>
                                    <div class="col-sm-3">                        
                                        <div class="col-lg-8" >
                                            <a class="btn btn-info " target="__blank" href="profile.php">Back</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        
                                        <input id="submit" type="submit" class="btn btn-primary px-4" value="Save Changes">
                                    </div>
                                </div>
                                <div class="row mb-3 px-3">
                                    <span id="passwordError" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    <?php include_once('./footer.php');?>

</body>

<script src='scripts/checker.js'></script>
<script src='scripts/locations.js'></script>

<script src='scripts/passwordSame.js'></script>
<script>
    document.getElementById("fileInput").addEventListener("change", function() {
    // When a file is selected, show the "Upload New Picture" button and submit the form
    document.getElementById("uploadButton").style.display = "block";
    document.getElementById("imageUploadForm").submit();
});
</script>
</html>