// CART STATE
let showTotal = false;
let cart = JSON.parse(localStorage.getItem("cart")) || [];

/* =========================
   SAVE CART
========================= */
function saveCart() {
    localStorage.setItem("cart", JSON.stringify(cart));
}

/* =========================
   SYNC CART UI
========================= */
function syncCartUI() {

    cart = JSON.parse(localStorage.getItem("cart")) || [];

    const cartCount = document.getElementById("cart-count");
    const homeItems = document.getElementById("cart-items");
    const homeTotal = document.getElementById("home-total");
    const menuItems = document.getElementById("cart-items-mini");
    const menuTotal = document.getElementById("menu-total");

    // CART COUNT
    if (cartCount) {
        cartCount.innerText = cart.length;
    }

    // HOME CART
    if (homeItems) {

        homeItems.innerHTML = "";

        if (cart.length === 0) {
            homeItems.innerHTML = "<p style='color:#999;'>Cart is empty</p>";
            return;
        }

        cart.forEach((item, index) => {
            homeItems.innerHTML += `
                <div class="cart-item">
                    <span class="item-name">${item.name}</span>
                    <span class="item-price">Rs ${item.price}</span>
                    <button onclick="removeItem(${index})" class="remove-btn">Remove</button>
                </div>
            `;
        });

        if (homeTotal) homeTotal.style.display = "none";
    }

    // MINI CART
    if (menuItems) {

        let total = 0;

        const text = cart.map(item => {
            total += Number(item.price);
            return `${item.name} Rs ${item.price}`;
        }).join(" | ");

        menuItems.textContent = text || "Cart empty";
    }
}

/* =========================
   ADD TO CART
========================= */
function addToCart(name, price) {
    cart.push({ name, price });
    saveCart();
    syncCartUI();
    showToast(name + " added to cart");
}

/* =========================
   REMOVE ITEM
========================= */
function removeItem(index) {
    cart.splice(index, 1);
    saveCart();
    syncCartUI();
}

/* =========================
   CHECKOUT → OPEN PAGE (FIXED)
========================= */
function checkout() {
    window.location.href = "checkout.php";
}

/* =========================
   HOME CHECKOUT (FIXED + SINGLE VERSION)
========================= */
function homeCheckout() {

    let total = 0;

    cart = JSON.parse(localStorage.getItem("cart")) || [];

    cart.forEach(item => {
        total += Number(item.price);
    });

    const homeTotal = document.getElementById("home-total");

    if (!homeTotal) return;

    if (homeTotal.style.display === "block") {
        homeTotal.style.display = "none";
    } else {
        homeTotal.style.display = "block";
        homeTotal.innerText = "Total: Rs " + total;
    }
}

/* =========================
   TOAST
========================= */
function showToast(msg) {
    const toast = document.getElementById("toast");
    if (!toast) return;

    toast.innerText = msg;
    toast.classList.add("show");

    setTimeout(() => {
        toast.classList.remove("show");
    }, 2000);
}

/* =========================
   CART TOGGLE
========================= */
const cartBtn = document.getElementById("cart-btn");
const cartPanel = document.getElementById("cart-panel");

if (cartBtn && cartPanel) {
    cartBtn.addEventListener("click", () => {
        syncCartUI();
        cartPanel.classList.toggle("active");
    });
}

/* INIT */
document.addEventListener("DOMContentLoaded", syncCartUI);

/* REFRESH ON FOCUS */
window.addEventListener("focus", syncCartUI);