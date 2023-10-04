document.addEventListener("DOMContentLoaded", function() {
    const chatWindows = {}; // Store chat messages for each user by their ID
    const chatMessages = document.getElementById("chat-messages");
    const messageInput = document.getElementById("message-input");
    const sendButton = document.getElementById("send-button");

    const userID = document.getElementById("profile").getAttribute("pass");
    // Function to display a message
    function displayMessage(message, sender) {
        const messageDiv = document.createElement("div");
        messageDiv.classList.add("message");
        messageDiv.classList.add("row_s");
        messageDiv.textContent = `${sender}: ${message}`;
        chatMessages.appendChild(messageDiv);
    }

    // Function to send a message to the server
    function sendMessage(userID) {
        const message = messageInput.value.trim();
        if (message !== "") {
            // Send the message to the server (you need to implement this part)
            // For now, just display the sent message on the client-side

            // Check if there's an active chat window for the receiver
            if (chatWindows[userID]) {
                displayMessage(message, "You");
                // Send the message to the server with receiverId
                // Update chatWindows[receiverId] with the received response
                // Example: chatWindows[receiverId].push({ sender: "You", message: message });
            } else {
                // Create a new chat window
                chatWindows[userID] = [];
                displayMessage(message, "You");
                // Send the message to the server with receiverId
                // Update chatWindows[receiverId] with the received response
                // Example: chatWindows[receiverId].push({ sender: "You", message: message });
            }

            messageInput.value = "";
        }
    }

    // Event listener for sending a message
    sendButton.addEventListener("click", function() {
        const activeCell = document.querySelector(".product-cell.active");
        if (activeCell) {
            sendMessage(userID);
        }
    });

    // Event listener for Enter key to send a message
    messageInput.addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            const activeCell = document.querySelector(".product-cell.active");
            if (activeCell) {
                sendMessage(userID);
            }
        }
    });

    function retrieveMessages(receiverId, postID) {
        // Make an AJAX request to retrieve chat messages
        fetch(`php/getMessages.php?receiverID=${receiverId}&postID=${postID}`)
            .then(response => response.json())
            .then(data => {
                // Display the retrieved messages
                chatMessages.innerHTML = ""; // Clear previous messages
                data.forEach(messageObj => {
                    displayMessage(messageObj.msg, messageObj.sender_username);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Add a click event listener to product-cells
    const productCells = document.querySelectorAll(".products-row.chat");
    productCells.forEach((cell) => {
        cell.addEventListener("click", function() {
            // Remove the "active" class from all product-cells
            productCells.forEach((cell) => {
                cell.classList.remove("active");
            });

            // Add the "active" class to the clicked product-cell
            cell.classList.add("active");

            // Retrieve and display chat messages for the selected user
            senderUserID = cell.getAttribute("user");
            postID = cell.getAttribute("post");
            retrieveMessages(senderUserID, postID);
        });
    });

    // Retrieve and display chat messages for the initially active user (if any)
    const initiallyActiveCell = document.querySelector("#inbox .active");
    if (initiallyActiveCell) {
        const userId = initiallyActiveCell.closest(".chat");
        if (userId) {
            senderUserID = document.querySelector('#senderUser').getAttribute("user");
            postID = document.querySelector('#senderUser').getAttribute("post");
            retrieveMessages(senderUserID, postID);
        }
    }

    // Poll for new messages at regular intervals (e.g., every 5 seconds)
    setInterval(() => {
        const activeCell = document.querySelector("#inbox .active");
        if (activeCell) {
            senderUserID = activeCell.getAttribute("user");
            postID = activeCell.getAttribute("post");
            retrieveMessages(senderUserID, postID);
        }
    }, 5000); // Adjust the interval as needed
});