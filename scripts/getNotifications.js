document.addEventListener("DOMContentLoaded", function() {

    function markNotificationsAsSeen(notifications) {
        if (notifications.length > 0) {
            const notIDs = notifications.map(notification => notification.id);
            // Create a data object to send as JSON
            const data = {
                notID: notIDs,
            };

            // Send the message to the server using a POST request
            fetch('php/sendNotificationSeen.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {})
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }

    const notificationsContainerRecent = document.querySelector(".recent");
    const notificationsContainerEarlier = document.querySelector(".earlier");


    function timeDiff(timestamp, isBefore) {
        const currentTimestamp = Math.floor(Date.now() / 1000);
        const timestampInSeconds = Math.floor(new Date(timestamp).getTime() / 1000);
        let timestampDiff;

        if (isBefore) {
            timestampDiff = currentTimestamp - timestampInSeconds;
            var prefix = "Πριν ";
        } else {
            timestampDiff = timestampInSeconds - currentTimestamp;
            var prefix = "Λήγει σε ";
        }

        if (timestampDiff < 60) {
            return prefix + timestampDiff + " δευτερόλεπτα";
        } else if (timestampDiff < 3600) {
            const minutes = Math.ceil(timestampDiff / 60);
            return prefix + minutes + " λεπτά";
        } else if (timestampDiff < 86400) {
            const hours = Math.ceil(timestampDiff / 3600);
            return prefix + hours + " ώρες";
        } else if (timestampDiff < 604800) {
            const days = Math.ceil(timestampDiff / 86400);
            return prefix + days + " μέρες";
        } else {
            const weeks = Math.ceil(timestampDiff / 604800);
            return prefix + weeks + " εβδ.";
        }
    }

    function fetchNotifications() {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "php/getNotifications.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Handle the response and display notifications
                    const response = JSON.parse(xhr.responseText);
                    newNotificationToSee = []

                    if (response.length > 0) {
                        notificationsContainerEarlier.innerHTML = ""; // Clear previous notifications
                        notificationsContainerRecent.innerHTML = ""; // Clear previous notifications

                        response.forEach(function(notification) {
                            const message = notification.message;
                            // const image_url = notification.image_url;
                            const userFullname = notification.fullname;
                            const user_image = notification.image_path;
                            const type = notification.type;
                            const created_at = notification.created_at;
                            const seen = notification.seen;
                            const title = notification.title;

                            buttonMessage = undefined
                            if (type == 'job') {
                                buttonMessage = 'Lets Talk'
                            } else if (type == 'post') {
                                buttonMessage = 'Check it out'
                            } else if (type == 'message') {
                                buttonMessage = 'Go to Chat'
                            }

                            seentext = ''
                            const notificationBox = document.createElement("div");
                            notificationBox.className = "notification-box";


                            if (seen == 'false') {
                                newNotificationToSee.push(notification)
                                seentext = 'New Notification'
                                const RecentContent =
                                    `
                                    <div class="${type} p-3 d-flex align-items-center bg-light border-bottom osahan-post-header">
                                        <div id='image-cont' class="dropdown-list-image mr-3" style='margin-right:50px'>
                                            <img class="rounded-circle" src="${user_image}" alt="" />
                                            <div class="big username">${userFullname}</div>
                                        </div>
                                        <div class="font-weight-bold mr-3" style='margin-left:1em'> 
                                            <div class="text-truncate">${title}</div>
                                            <div class="small">${message}</div>
                                        </div>
                                        <span class="ml-auto mb-auto">
                                            <div class="btn-group">
                                            <button type="button" style='margin-right:2em'class="btn btn-outline-success btn-sm">${buttonMessage}</button>
                                                <button type="button" class="btn btn-light btn-sm rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                ${seentext}
                                                </button>
                                            </div>
                                            <br/>
                                            <div class="text-right text-muted pt-1">${timeDiff(created_at,true)}</div>
                                        </span>
                                    </div>
                                    `
                                notificationBox.innerHTML = RecentContent;
                                notificationsContainerRecent.appendChild(notificationBox)
                            } else {
                                const EarlierContent =
                                    `
                                    <div class="${type} p-3 d-flex align-items-center bg-light border-bottom osahan-post-header">
                                        <div id='image-cont' class="dropdown-list-image mr-3" style='margin-right:50px'>
                                            <img class="rounded-circle" src="${user_image}" alt="" />
                                            <div class="big username">${userFullname}</div>
                                        </div>
                                        <div class="font-weight-bold mr-3" style='margin-left:1em'> 
                                            <div class="text-truncate">${title}</div>
                                            <div class="small">${message}</div>
                                        </div>
                                        <span class="ml-auto mb-auto">
                                            <div class="btn-group">
                                            <button type="button" style='margin-right:2em'class="btn btn-outline-success btn-sm">${buttonMessage}</button>
                                                <button type="button" class="btn btn-light btn-sm rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical">${''}</i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <button class="dropdown-item" type="button"><i class="mdi mdi-delete"></i> Delete</button>
                                                    <button class="dropdown-item" type="button"><i class="mdi mdi-close"></i> Turn Off</button>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="text-right text-muted pt-1">${timeDiff(created_at,true)}</div>
                                        </span>
                                    </div>
                                    `
                                notificationBox.innerHTML = EarlierContent;
                                notificationsContainerEarlier.appendChild(notificationBox)

                            }


                        });
                        if (newNotificationToSee.length > 0 && document.querySelector('#notifButton').classList.contains('active'))
                            setTimeout(function() {
                                markNotificationsAsSeen(newNotificationToSee);
                            }, 3000); // Adjust the time interval as needed (e.g., 3000ms = 3 seconds)
                    } else {
                        if (newNotificationToSee.length == 0)
                            notificationsContainerRecent.innerHTML = "<p style='padding:1em'>No new notifications.</p>";

                        notificationsContainerEarlier.innerHTML = "<p style='padding:1em'>Empty box.</p>";
                    }
                } else {
                    // Handle errors
                    console.error("Request failed with status: " + xhr.status);
                }
            }
        };

        xhr.send();
    }

    fetchNotifications();
    setInterval(() => {
        fetchNotifications();
    }, 5000);
});