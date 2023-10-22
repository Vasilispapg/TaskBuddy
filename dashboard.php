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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />

</head>
<body>
<?php 
    include_once './php/connection.php'; 

    include_once('./components/header.php');

    if (isset($_GET['message']) && $_GET['message'] === 'true') {
        $displayMessage = true;
        $post_id=$_GET['postID'];
        $user_id=$_GET['receiverID'];

        $query="SELECT post_images.image_url,
        users.fullname,
        posts.title
        FROM users,post_images,posts
        WHERE users.id = $user_id 
        AND posts.id=$post_id
        AND post_images.post_id = $post_id";
        $result=mysqli_query($conn, $query);
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
    <?php 
        include('./components/dashboardSidebar.php');
    ?>       
    <div class="app-content">

        <?php 
            include('./components/dashboardTableHeader.php');
            include('./components/dashboardTableView.php');
            include('./components/dashboardTableChat.php');
            include('./components/dashboardTableJobs.php');
            include('./components/dashboardTableNotifications.php');
        ?>
        </div>

    </div>
</main>

    <?php 
        include('./components/modalPostEdit.php');
        include_once('./components/footer.php');
    ?>

</body>

<script src='scripts/chat/chat.js'></script>
<script src='scripts/client/dashboardChange.js'></script>
<script src='scripts/client/dashboard.js'></script>
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
    });</script>

<script src='./scripts/client/suggestionBubbles.js'>

    document.addEventListener("DOMContentLoaded", function() {

        bubleHide()
    })</script>


</html>