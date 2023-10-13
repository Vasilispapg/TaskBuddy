document.addEventListener("DOMContentLoaded", function() {
    const notificationsContainer = document.getElementById("notification");

    function fetchNotifications() {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "php/getNotifications.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Handle the response and display notifications
                    const response = JSON.parse(xhr.responseText);

                    if (response.length > 0) {
                        notificationsContainer.innerHTML = ""; // Clear previous notifications

                        response.forEach(function(notification) {
                            const message = notification.message;
                            const image_url = notification.image_url;
                            const userFullname = notification.fullname;

                            const notificationBox = document.createElement("div");
                            notificationBox.className = "notification-box";

                            const notificationContent = `
                                <div class='notification-box-body'>
                                    <div class='notification-box-body-content'>
                                        <div class='notification-box-body-content-image'>
                                            <img style='width: 20px' src='${image_url}' alt='post'>
                                        </div>
                                        <div class='notification-box-body-content-text'>
                                            <h5>${userFullname}</h5>
                                            <p>${message}</p>
                                        </div>
                                    </div>
                                </div>
                            `;

                            notificationBox.innerHTML = notificationContent;
                            notificationsContainer.appendChild(notificationBox);
                        });
                    } else {
                        notificationsContainer.innerHTML = "<p>No new notifications.</p>";
                    }
                } else {
                    // Handle errors
                    console.error("Request failed with status: " + xhr.status);
                }
            }
        };

        xhr.send();
    }

    // Fetch notifications when the page loads
    setInterval(() => {
        fetchNotifications();
    }, 1000);
});