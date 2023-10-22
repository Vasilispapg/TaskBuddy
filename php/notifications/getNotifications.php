<?php
session_name('user');
session_start();

include_once '../connection.php'; 


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $toUserID = $_SESSION['id'];
        $newNotificationsquery = "SELECT notifications.*,
                            posts.title,
                            posts.id as postID,
                            users.fullname,
                            users.id as userID,
                            users.image_path
                FROM notifications, users,posts
                WHERE to_user_id = $toUserID
                AND posts.id = notifications.postID
                AND seen = 'false'
                AND users.id = notifications.from_user_id
                ORDER BY notifications.created_at DESC";
                
        $oldNotificationsquery = "SELECT notifications.*,
                            posts.title,
                            posts.id as postID,
                            users.fullname,
                            users.id as userID,
                            users.image_path
        FROM notifications, users,posts
        WHERE to_user_id = $toUserID
        AND posts.id = notifications.postID
        AND users.id = notifications.from_user_id
        AND seen = 'true'
        ORDER BY notifications.created_at DESC
        LIMIT 5";
        
        $result = mysqli_query($conn, $newNotificationsquery);

        $notifications = [];

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $notifications[] = $row;
            }
        }
        
        $result=mysqli_query($conn, $oldNotificationsquery);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $notifications[] = $row;
            }
        }

        echo json_encode($notifications);
    }