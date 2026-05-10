<!DOCTYPE html>
<html>
<head>
    <title>Live Chat</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #1c1c1c;
            color: white;
        }

        .chat-container {
            max-width: 500px;
            margin: 50px auto;
            background: #2f2f2f;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #444;
        }

        .chat-header {
            background: #ff4b2b;
            padding: 15px;
            text-align: center;
            font-weight: bold;
        }

        .chat-box {
            height: 350px;
            padding: 15px;
            overflow-y: auto;
        }

        .msg {
            margin: 10px 0;
            padding: 10px;
            border-radius: 10px;
            max-width: 80%;
        }

        .user {
            background: #444;
            margin-left: auto;
            text-align: right;
        }

        .bot {
            background: #333;
            border-left: 3px solid #ff4b2b;
        }

        .input-box {
            display: flex;
            border-top: 1px solid #444;
        }

        .input-box input {
            flex: 1;
            padding: 12px;
            border: none;
            outline: none;
            background: #222;
            color: white;
        }

        .input-box button {
            background: #ff4b2b;
            border: none;
            padding: 12px 18px;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="chat-container">

    <div class="chat-header">
        Live Support (Demo)
    </div>

    <div class="chat-box" id="chatBox">
        <div class="msg bot">Hi! How can we help you today?</div>
    </div>

    <div class="input-box">
        <input type="text" id="msgInput" placeholder="Type message...">
        <button onclick="sendMsg()">Send</button>
    </div>

</div>

<script>
function sendMsg() {
    let input = document.getElementById("msgInput");
    let chatBox = document.getElementById("chatBox");

    if(input.value.trim() === "") return;

    let userMsg = document.createElement("div");
    userMsg.className = "msg user";
    userMsg.innerHTML = input.value;
    chatBox.appendChild(userMsg);

    setTimeout(() => {
        let botMsg = document.createElement("div");
        botMsg.className = "msg bot";
        botMsg.innerHTML = "Thanks for your message. Our team will respond soon.";
        chatBox.appendChild(botMsg);
        chatBox.scrollTop = chatBox.scrollHeight;
    }, 800);

    input.value = "";
}
</script>

</body>
</html>