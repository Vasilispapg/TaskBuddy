function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function bubleHide() {
    // Check if chat messages are empty
    await sleep(1000)

    chat_elements = document.querySelectorAll('.spliter #senderUser')
        // Check if there are chat messages and the chat element has the "active" class
    chat = undefined
    chat_elements.forEach(chat_element => {
        if (chat_element.classList.contains("active")) {
            chat = chat_element
        }
    });

    isEmpty = document.querySelector('.message.row_s') ? false : true;

    if (isEmpty) {
        const suggestions = document.querySelector(".chat-suggestions");
        suggestions.style.display = "flex";
        bubles = suggestions.childNodes
        if (bubles != undefined)
            bubles.forEach(buble => buble.addEventListener("click", function() {
                document.querySelector('#message-input').value = buble.textContent;
                suggestions.style.display = "none";
            }));
    }

}