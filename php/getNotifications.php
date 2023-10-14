<?php
session_name('user');
session_start();

$con = mysqli_connect("localhost", "root", "", "taskbuddynw") or die("Could not connect to the database");
if (mysqli_connect_errno() || !$con) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $toUserID = $_SESSION['id'];
        $newNotificationsquery = "SELECT notifications.*,
                            posts.title,
                            post_images.image_url,
                            users.fullname,
                            users.image_path
                FROM notifications, post_images, users,posts
                WHERE to_user_id = $toUserID
                AND posts.id = notifications.postID
                AND seen = 'false'
                AND post_images.post_id = notifications.postID
                AND users.id = notifications.from_user_id
                ORDER BY notifications.created_at DESC";
                
        $oldNotificationsquery = "SELECT notifications.*,
                    posts.title,
                    post_images.image_url,
                    users.fullname,
                    users.image_path
        FROM notifications, post_images, users,posts
        WHERE to_user_id = $toUserID
        AND posts.id = notifications.postID
        AND post_images.post_id = notifications.postID
        AND users.id = notifications.from_user_id
        AND seen = 'true'
        ORDER BY notifications.created_at DESC
        LIMIT 5";
        
        $result = mysqli_query($con, $newNotificationsquery);

        $notifications = [];

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $notifications[] = $row;
            }
        }
        
        $result=mysqli_query($con, $oldNotificationsquery);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $notifications[] = $row;
            }
        }

        echo json_encode($notifications);
    }
}