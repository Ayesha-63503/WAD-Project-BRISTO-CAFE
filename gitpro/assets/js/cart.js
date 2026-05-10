// =========================
// CART STATE
// =========================
let cart = JSON.parse(localStorage.getItem("cart")) || [];

// =========================
// LOAD CART FROM DATABASE (on page load)
// =========================
async function loadCartFromDB() {
    try {
        const res = await fetch("/gitpro/cart/get_cart.php");
        const dbCart = await res.json();

        if (dbCart && dbCart.length > 0) {
            cart = dbCart.map(item => ({
                name: item.name,
                price: parseFloat(item.price),
                qty: parseInt(item.quantity)
            }));
            localStorage.setItem("cart", JSON.stringify(cart));
        }

        syncCartUI();
    } catch (e) {
        syncCartUI();
    }
}

// =========================
// SAVE ITEM TO DATABASE
// =========================
async function saveItemToDB(name, price) {
    try {
        const formData = new FormData();
        formData.append("name", name);
        formData.append("price", price);
        await fetch("/gitpro/cart/add_to_cart_by_name.php", {
            method: "POST",
            body: formData
        });
    } catch (e) {}
}

// =========================
// REMOVE ITEM FROM DATABASE
// =========================
async function removeItemFromDB(name) {
    try {
        const formData = new FormData();
        formData.append("name", name);
        await fetch("/gitpro/cart/remove_cart_by_name.php", {
            method: "POST",
            body: formData
        });
    } catch (e) {}
}

// =========================
// LOAD CART (localStorage)
// =========================
function loadCart() {
    let data = localStorage.getItem("cart");
    try {
        cart = data ? JSON.parse(data) : [];
    } catch (e) {
        cart = [];
    }
}

// =========================
// SAVE CART (localStorage)
// =========================
function saveCart() {
    localStorage.setItem("cart", JSON.stringify(cart));
}

// =========================
// ADD TO CART
// =========================
function addToCart(name, price) {
    price = Number(price);

    let existing = cart.find(item => item.name === name);

    if (existing) {
        existing.qty += 1;
    } else {
        cart.push({ name: name, price: price, qty: 1 });
    }

    saveCart();
    saveItemToDB(name, price);
    syncCartUI();
}

// =========================
// REMOVE ITEM
// =========================
function removeItem(name) {
    loadCart();

    let item = cart.find(i => i.name === name);
    if (!item) return;

    if (item.qty > 1) {
        item.qty--;
    } else {
        cart = cart.filter(i => i.name !== name);
        removeItemFromDB(name);
    }

    saveCart();
    syncCartUI();
}

// =========================
// SYNC UI
// =========================
function syncCartUI() {
    cart = JSON.parse(localStorage.getItem("cart")) || [];

    const cartCount = document.getElementById("cart-count");
    const homeItems = document.getElementById("cart-items");
    const homeTotal = document.getElementById("home-total");
    const menuItems = document.getElementById("cart-items-mini");
    const menuTotal = document.getElementById("menu-total");

    if (cartCount) {
        let totalItems = cart.reduce((sum, i) => sum + i.qty, 0);
        cartCount.innerText = totalItems;
    }

    if (homeItems) {
        homeItems.innerHTML = "";
        let total = 0;
        cart.forEach(item => {
            let qty = item.qty || 1;
            let itemTotal = item.price * qty;
            total += itemTotal;
            homeItems.innerHTML += `
                <div class="cart-item" style="display:flex; justify-content:space-between; gap:10px; padding:6px 0;">
                    <span>${item.name} x${qty}</span>
                    <span>Rs ${itemTotal}</span>
                    <button onclick="removeItem('${item.name}')"
                        style="background:#e74c3c; color:white; border:none; padding:4px 10px; border-radius:10px; cursor:pointer; margin-left:10px; font-size:12px;">
                        Remove
                    </button>
                </div>
            `;
        });
        if (cart.length === 0) {
            homeItems.innerHTML = "<p style='color:#aaa'>Cart is empty</p>";
        }
        if (homeTotal) {
            homeTotal.style.display = "block";
            homeTotal.innerText = "Total: Rs " + total;
        }
    }

    if (menuItems) {
        menuItems.innerHTML = "";
        let total = 0;
        cart.forEach(item => {
            let qty = item.qty || 1;
            let itemTotal = item.price * qty;
            total += itemTotal;
            menuItems.innerHTML += `
                <div class="menu-cart-row">
                    <span>${item.name} x${qty}</span>
                    <span>Rs ${itemTotal}</span>
                </div>
            `;
        });
        if (cart.length === 0) menuItems.innerHTML = "Cart empty";
        if (menuTotal) {
            menuTotal.style.display = "block";
            menuTotal.innerText = "Total: Rs " + total;
        }
    }
}

// =========================
// CHECKOUT
// =========================
function checkout() {
    window.location.href = "checkout.php";
}

// =========================
// TOAST
// =========================
function showToast(msg) {
    const toast = document.getElementById("toast");
    if (!toast) return;
    toast.innerText = msg;
    toast.classList.add("show");
    setTimeout(() => toast.classList.remove("show"), 2000);
}

// =========================
// CART TOGGLE
// =========================
const cartBtn = document.getElementById("cart-btn");
const cartPanel = document.getElementById("cart-panel");
if (cartBtn && cartPanel) {
    cartBtn.addEventListener("click", () => {
        syncCartUI();
        cartPanel.classList.toggle("active");
    });
}

// =========================
// INIT
// =========================
document.addEventListener("DOMContentLoaded", loadCartFromDB);
window.addEventListener("focus", syncCartUI);