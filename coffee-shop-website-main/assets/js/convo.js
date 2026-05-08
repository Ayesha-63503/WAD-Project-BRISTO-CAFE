// Collapsible
var coll = document.getElementsByClassName("collapsible");

for (let i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("active");

        var content = this.nextElementSibling;

        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }

    });
}

function getTime() {
    let today = new Date();
    hours = today.getHours();
    minutes = today.getMinutes();

    if (hours < 10) {
        hours = "0" + hours;
    }

    if (minutes < 10) {
        minutes = "0" + minutes;
    }

    let time = hours + ":" + minutes;
    return time;
}

// Gets the first message
function firstBotMessage() {
    let firstMessage = "Keywords/Commands: <br/><br/> <strong>menu</strong> - it will show our menu. <br/> <strong>about</strong> - it will show the 'about us'. <br/> <strong>contact</strong>- it will show 'contact info'. <br/> <strong>commands</strong> - it will show 'keyword'. <br/> <strong>how to order</strong> - it will show the instruction. <br/> <strong>location</strong> - it will show our address."
    document.getElementById("botStarterMessage").innerHTML = '<p class="botText"><span>' + firstMessage + '</span></p>';

    let time = getTime();

    $("#chat-timestamp").append(time);
    document.getElementById("userInput").scrollIntoView(false);
}

firstBotMessage();

// Retrieves the response
function getHardResponse(userText) {
    let botResponse = getBotResponse(userText);
    let botHtml = '<p class="botText"><span>' + botResponse + '</span></p>';
    $("#chatbox").append(botHtml);

    document.getElementById("chat-bar-bottom").scrollIntoView(true);
}

//Gets the text text from the input box and processes it
function getResponse() {
    let userText = $("#textInput").val().toLowerCase();

    if (userText == "") {
        alert('Please enter something!');
        return;
    }

    let userHtml = '<p class="userText"><span>' + userText + '</span></p>';

    $("#textInput").val("");
    $("#chatbox").append(userHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);

    setTimeout(() => {
        getHardResponse(userText);
    }, 1000)

}

// Handles sending text via button clicks
function buttonSendText(sampleText) {
    let userHtml = '<p class="userText"><span>' + sampleText + '</span></p>';

    $("#textInput").val("");
    $("#chatbox").append(userHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);

    //Uncomment this if you want the bot to respond to this buttonSendText event
    // setTimeout(() => {
    //     getHardResponse(sampleText);
    // }, 1000)
}

function sendButton() {
    getResponse();
}

function heartButton() {
    buttonSendText("Heart clicked!")
}

// Press enter to send a message
$("#textInput").keypress(function (e) {
    if (e.which == 13) {
        getResponse();
    }
});
// ===============================
// CHAT OPEN + CLOSE FIX
// ===============================


// OPEN / TOGGLE CHAT
// CHAT OPEN + CLOSE FIX

const chatBtn = document.getElementById("chat-button");
const chatContent = document.querySelector(".chat-bar-collapsible .content");
const closeBtn = document.getElementById("close-chat");

// OPEN CHAT
chatBtn.addEventListener("click", function () {
    chatContent.style.display = "block";
});

// CLOSE CHAT
closeBtn.addEventListener("click", function (event) {
    event.stopPropagation();
    chatContent.style.display = "none";
});
function showToast(message) {
    const toast = document.getElementById("toast");
    toast.innerText = message;
    toast.classList.add("show");

    setTimeout(() => {
        toast.classList.remove("show");
    }, 2000);
}
let cart = JSON.parse(localStorage.getItem("cart")) || [];

function addToCart(name, price) {
    let item = cart.find(p => p.name === name);

    if (item) {
        item.qty++;
    } else {
        cart.push({ name, price, qty: 1 });
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    renderCart();
    showToast("Added to cart ✅");
}

function renderCart() {
    const container = document.querySelector(".cart-content");
    if (!container) return;

    container.innerHTML = "";

    let total = 0;

    cart.forEach((item, index) => {
        total += item.price * item.qty;

        container.innerHTML += `
            <div class="cart-item">
                <h4>${item.name}</h4>
                <p>Rs ${item.price}</p>
                <button onclick="changeQty(${index}, -1)">-</button>
                ${item.qty}
                <button onclick="changeQty(${index}, 1)">+</button>
                <button onclick="removeItem(${index})">❌</button>
            </div>
        `;
    });

    const totalBox = document.querySelector(".total-price");
    if (totalBox) totalBox.innerText = "Rs " + total;
}

function changeQty(index, change) {
    cart[index].qty += change;

    if (cart[index].qty <= 0) {
        cart.splice(index, 1);
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    renderCart();
}

function removeItem(index) {
    cart.splice(index, 1);
    localStorage.setItem("cart", JSON.stringify(cart));
    renderCart();
}

document.addEventListener("DOMContentLoaded", renderCart);
document.addEventListener("DOMContentLoaded", function () {
    const search = document.getElementById("search-box");

    if (search) {
        search.addEventListener("keyup", function () {
            let value = this.value.toLowerCase();
            let items = document.querySelectorAll(".menu-item");

            items.forEach(item => {
                let text = item.innerText.toLowerCase();
                item.style.display = text.includes(value) ? "block" : "none";
            });
        });
    }
});
function quickMsg(text) {
    let userHtml = `<p class="userText"><span>${text}</span></p>`;
    $("#chatbox").append(userHtml);

    setTimeout(() => {
        getHardResponse(text);
    }, 500);
}