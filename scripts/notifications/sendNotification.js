document.addEventListener("DOMContentLoaded", function() {
    const takeJobButtons = document.querySelectorAll("#takeTheJob");
    const confirmationMessage = document.querySelectorAll('#confirmation-message')

    takeJobButtons.forEach(function(button, index) {
        button.addEventListener("click", function() {
            const userID = button.getAttribute("data-user-id");
            const postID = button.getAttribute("data-post-id");
            const type = button.getAttribute("type");
            const message = "Ενδιαφέρομαι για την δουλειά";

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "php/notifications/sendNotification.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Handle the response and display the confirmation message
                        const response = xhr.responseText;

                        // Display the confirmation message
                        const confM = confirmationMessage[index]

                        confM.textContent = response;
                        confM.style.display = "block";

                        // Hide the confirmation message after a few seconds (e.g., 5 seconds)
                        setTimeout(function() {
                            confM.style.display = "none";
                        }, 5000);
                    } else {
                        // Handle errors
                        console.error("Request failed with status: " + xhr.status);
                    }
                }
            };

            const data = "to_user_id=" + userID + "&postID=" + postID + "&message=" + message + "&type=" + type;
            xhr.send(data);
        });
    });
});