const ws = new WebSocket("ws://localhost:2346");

ws.onopen = function() {
    console.log("Connected to WebSocket server");
};

ws.onmessage = function(event) {
    const messageData = JSON.parse(event.data);
    const chatBox = document.getElementById("chat-box");
    const messageElement = document.createElement("div");
    messageElement.className = "message";
    messageElement.textContent = `${messageData.sender_name}: ${messageData.message}`;
    chatBox.appendChild(messageElement);
    chatBox.scrollTop = chatBox.scrollHeight;
};

document.getElementById("chat-form").addEventListener("submit", function(event) {
    event.preventDefault();
    const messageInput = document.getElementById("message-input");
    const messageData = {
        sender_id: document.getElementById("sender-id").value,
        recipient_id: document.getElementById("recipient-id").value,
        sender_name: document.getElementById("sender-name").value,
        message: messageInput.value
    };
    ws.send(JSON.stringify(messageData));
    messageInput.value = "";
});
