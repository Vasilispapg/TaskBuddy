<?php
session_name('user');
session_start();

$con = mysqli_connect("localhost", "root", "", "taskbuddynw") or die("Could not connect to the database");
if (mysqli_connect_errno() || !$con) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $toUserID = $_SESSION['id'];
        $query = "SELECT notifications.*,
                            post_images.image_url,
                            users.fullname
                FROM notifications, post_images, users
                WHERE to_user_id = $toUserID
                AND seen = 'false'
                AND post_images.post_id = notifications.postID
                AND users.id = notifications.from_user_id";
        
        $result = mysqli_query($con, $query);

        $notifications = [];

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $notifications[] = $row;
            }
        }

        echo json_encode($notifications);
    }
}