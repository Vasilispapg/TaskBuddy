document.addEventListener("DOMContentLoaded", function() {
    const chatWindows = {}; // Store chat messages for each user by their ID
    const chatMessages = document.getElementById("chat-messages");
    const messageInput = document.getElementById("message-input");
    const sendButton = document.getElementById("send-button");
    const username = document.getElementById("username").innerText;

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
    function sendMessage(receiverID, postID) {
        const message = messageInput.value.trim();
        if (message !== "") {
            // Create a data object to send as JSON
            const data = {
                receiverID: receiverID,
                postID: postID,
                message: message
            };
            // Send the message to the server using a POST request
            fetch('php/sendMessage.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the response from the server (e.g., display a confirmation message)
                    console.log('Message sent:', data);

                    // Check if there's an active chat window for the receiver
                    if (chatWindows[receiverID]) {
                        displayMessage(message, username);
                        // Update chatWindows[receiverID] with the received response
                        // Example: chatWindows[receiverID].push({ sender: "You", message: message });
                    } else {
                        // Create a new chat window
                        chatWindows[receiverID] = [];
                        displayMessage(message, username);
                        // Update chatWindows[receiverID] with the received response
                        // Example: chatWindows[receiverID].push({ sender: "You", message: message });
                    }

                    messageInput.value = "";
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }


    // Event listener for sending a message
    sendButton.addEventListener("click", function() {
        const activeCell = document.querySelector(".products-row.active");
        if (activeCell) {
            sendMessage(activeCell.getAttribute("user"), activeCell.getAttribute("post"));
        }
    });

    // Event listener for Enter key to send a message
    messageInput.addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            const activeCell = document.querySelector(".products-row.active");
            if (activeCell) {
                sendMessage(activeCell.getAttribute("user"), activeCell.getAttribute("post"));
            }
        }
    });

    function retrieveMessages(receiverID, postID) {
        // Make an AJAX request to retrieve chat messages
        fetch(`php/getMessages.php?receiverID=${receiverID}&postID=${postID}`)
            .then(response => response.json())
            .then(data => {
                // Display the retrieved messages
                chatMessages.innerHTML = ""; // Clear previous messages
                data.forEach(messageObj => {
                    if (messageObj.sender_id === userID) {
                        displayMessage(messageObj.msg, messageObj.sender_username);
                    } else {
                        displayMessage(messageObj.msg, messageObj.receiver_username);
                    }
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
            receiverID = activeCell.getAttribute("user");
            postID = activeCell.getAttribute("post");
            retrieveMessages(receiverID, postID);
        }
    }, 5000); // Adjust the interval as needed
});