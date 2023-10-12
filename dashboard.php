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
    <title>Dashboard</title>
    <link rel="stylesheet" href="web_stuff/css/dashboard.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
</head>
<body>
<?php include_once('./components/header.php');

if (isset($_GET['message']) && $_GET['message'] === 'true') {
    $displayMessage = true;
    $post_id=$_GET['postID'];
    $user_id=$_GET['receiverID'];

    $con = mysqli_connect("localhost", "root", "", "taskbuddynw");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query="SELECT post_images.image_url,
    users.fullname,
    posts.title
    FROM users,post_images,posts
    WHERE users.id = $user_id 
    AND posts.id=$post_id
    AND post_images.post_id = $post_id";
    $result=mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if($row){
            $post_image=$row['image_url'];
            $post_title=$row['title'];
            $userFullname=$row['fullname'];
        }
    }

} else {
    $displayMessage = false;
}

?>

<main class="main">
    <div class="app-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="app-icon">
                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="M507.606 371.054a187.217 187.217 0 00-23.051-19.606c-17.316 19.999-37.648 36.808-60.572 50.041-35.508 20.505-75.893 31.452-116.875 31.711 21.762 8.776 45.224 13.38 69.396 13.38 49.524 0 96.084-19.286 131.103-54.305a15 15 0 004.394-10.606 15.028 15.028 0 00-4.395-10.615zM27.445 351.448a187.392 187.392 0 00-23.051 19.606C1.581 373.868 0 377.691 0 381.669s1.581 7.793 4.394 10.606c35.019 35.019 81.579 54.305 131.103 54.305 24.172 0 47.634-4.604 69.396-13.38-40.985-.259-81.367-11.206-116.879-31.713-22.922-13.231-43.254-30.04-60.569-50.039zM103.015 375.508c24.937 14.4 53.928 24.056 84.837 26.854-53.409-29.561-82.274-70.602-95.861-94.135-14.942-25.878-25.041-53.917-30.063-83.421-14.921.64-29.775 2.868-44.227 6.709-6.6 1.576-11.507 7.517-11.507 14.599 0 1.312.172 2.618.512 3.885 15.32 57.142 52.726 100.35 96.309 125.509zM324.148 402.362c30.908-2.799 59.9-12.454 84.837-26.854 43.583-25.159 80.989-68.367 96.31-125.508.34-1.267.512-2.573.512-3.885 0-7.082-4.907-13.023-11.507-14.599-14.452-3.841-29.306-6.07-44.227-6.709-5.022 29.504-15.121 57.543-30.063 83.421-13.588 23.533-42.419 64.554-95.862 94.134zM187.301 366.948c-15.157-24.483-38.696-71.48-38.696-135.903 0-32.646 6.043-64.401 17.945-94.529-16.394-9.351-33.972-16.623-52.273-21.525-8.004-2.142-16.225 2.604-18.37 10.605-16.372 61.078-4.825 121.063 22.064 167.631 16.325 28.275 39.769 54.111 69.33 73.721zM324.684 366.957c29.568-19.611 53.017-45.451 69.344-73.73 26.889-46.569 38.436-106.553 22.064-167.631-2.145-8.001-10.366-12.748-18.37-10.605-18.304 4.902-35.883 12.176-52.279 21.529 11.9 30.126 17.943 61.88 17.943 94.525.001 64.478-23.58 111.488-38.702 135.912zM266.606 69.813c-2.813-2.813-6.637-4.394-10.615-4.394a15 15 0 00-10.606 4.394c-39.289 39.289-66.78 96.005-66.78 161.231 0 65.256 27.522 121.974 66.78 161.231 2.813 2.813 6.637 4.394 10.615 4.394s7.793-1.581 10.606-4.394c39.248-39.247 66.78-95.96 66.78-161.231.001-65.256-27.511-121.964-66.78-161.231z"/></svg>
                </div>
            </div>
            <ul class="sidebar-list">
                <li class="sidebar-list-item active" id='dashboardButton'>
                    <a href="#" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    <span>Posts</span>
                    </a>
                </li>
                <!-- <li class="sidebar-list-item" id='statisticsButton'>
                    <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
                    <span>Statistics</span>
                    </a>
                </li> -->
                <li class="sidebar-list-item" id='inboxButton' >
                    <a href="#" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
                    <span>Inbox</span>
                    </a>
                </li>
                <!-- <li class="sidebar-list-item" id='notificationsButton'>
                    <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                    <span>Notifications</span>
                    </a>
                </li> -->
            </ul>
            <div class="account-info">
            <div class="account-info-picture">
                <img src="<?php if(isset($_SESSION['image_path'])) echo ltrim($_SESSION['image_path'], './'); else {echo 'assets/user_images/user_icon_df.png"'; echo 'style="object-fit:contain !important"';} ?>" alt="Admin" class="rounded-circle">
            </div>
            <div class="account-info-name" id='username'><?php if(isset($_SESSION['fullname'])) echo $_SESSION['fullname']?></div>

        </div>
    </div>
        <div class="app-content">
            <?php 
                include('./components/dashboardTableHeader.php');
                include('./components/dashboardTableView.php');
                include('./components/chat.php');
            ?>
        </div>
    </div>
</main>

    <?php 
        include('./components/modalPostEdit.php');
        include_once('./components/footer.php');
    ?>

</body>

<script src='scripts/chat.js'></script>
<script src='scripts/dashboardChange.js'></script>
<script src='scripts/dashboard.js'></script>

<script>
    function createChatElement(userId, postId, userName, imageUrl,post_title) {
        // Create a new div element
        var chatDiv = document.createElement("div");
        
        // Set the class and attributes
        chatDiv.className = "products-row active chat";
        chatDiv.id = "senderUser";
        chatDiv.setAttribute("user", userId);
        chatDiv.setAttribute("post", postId);
        
        // Create an <h5> element with the text "12"
        var h5Element = document.createElement("h6");
        h5Element.textContent = userName;
        
        // Create a product cell div with an image and user name
        var productCellDiv = document.createElement("div");
        productCellDiv.className = "product-cell image";
        
        // Create an <img> element with the provided image URL
        var imgElement = document.createElement("img");
        imgElement.src = imageUrl;
        imgElement.alt = "post";
        
        // Create a <span> element for the user name
        var spanElement = document.createElement("span");
        spanElement.className = "user-name";
        spanElement.textContent = post_title;
        
        // Append elements to the product cell div
        productCellDiv.appendChild(imgElement);
        productCellDiv.appendChild(spanElement);
        
        // Append elements to the chat div
        chatDiv.appendChild(h5Element);
        chatDiv.appendChild(productCellDiv);
        
        return chatDiv;
    }
   
    document.addEventListener("DOMContentLoaded", function() {
    
        <?php if ($displayMessage): ?>

            var post_id = <?php if($post_id) echo $post_id; ?>;
            var user_id = <?php if($post_id) echo $user_id; ?>;
            var userFullname = '<?php if($post_id) echo $userFullname; ?>';
            var post_image = '<?php if($post_id) echo $post_image; ?>';
            var post_title = '<?php if($post_id) echo $post_title; ?>';

            chats=document.querySelectorAll('.chat')

            create_new_chat=false
            last_one=chats[chats.length-1]
            its_last_one=false
            flag_ACTIVE=false

            if(chats.length==0) //for empty chat
                create_new_chat=true

           
            chats.forEach(chat => {
                create_new_chat=chat.getAttribute('user') == user_id && chat.getAttribute('post') == post_id ? false : true

                if(create_new_chat==false){
                    chat.classList.add('active') 
                    chat.click()
                    its_last_one = chat == last_one ? true : false
                    flag_ACTIVE=true //an yparxei active chat
                }
            });

            if(create_new_chat && !its_last_one && !flag_ACTIVE){

                chat_box=document.querySelector('.spliter');
                var customChatElement = createChatElement(user_id, post_id, userFullname, post_image,post_title);

                // Get the first child element (if it exists)
                var firstChild = chat_box.firstChild;
                // Append the new element as the first child
                chat_box.insertBefore(customChatElement, firstChild);
                <?php endif; ?>
                <?php if (!$displayMessage): ?>
                chat_box=document.querySelector('.spliter');
                firstChild=chat_box.firstChild;
                firstChild.nextSibling.classList.add('active');
                <?php endif; ?>
            }

           

            dashboard.style.display = "none";
            inbox.style.display = "flex";
            dashboardButton.classList.remove("active");
            inboxButton.classList.add("active");
    });
</script>

</html>