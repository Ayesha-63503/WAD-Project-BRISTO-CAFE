<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:           #0d2b1f;
            --bg2:          #0a2318;
            --surface:      #122e21;
            --surface2:     #163525;
            --border:       rgba(255,255,255,0.08);
            --border-mid:   rgba(255,255,255,0.13);
            --text:         #e8f5ee;
            --text2:        #8ab89e;
            --text3:        #507060;
            --gold:         #d4a843;
            --gold-light:   #ecc25e;
            --gold-bg:      rgba(212,168,67,0.1);
            --gold-border:  rgba(212,168,67,0.28);
            --green-ok:     #4ade80;
            --green-ok-bg:  rgba(74,222,128,0.08);
            --green-ok-br:  rgba(74,222,128,0.22);
            --red:          #f87171;
            --red-bg:       rgba(248,113,113,0.08);
            --red-border:   rgba(248,113,113,0.22);
            --r:            14px;
            --r-sm:         9px;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg:          #080f0b;
                --bg2:         #0d1710;
                --surface:     #101c13;
                --surface2:    #162318;
                --border:      rgba(255,255,255,0.07);
                --border-mid:  rgba(255,255,255,0.12);
                --text:        #dff0e6;
                --text2:       #6a9878;
                --text3:       #3d5e47;
                --gold:        #c9a03a;
                --gold-light:  #e2bc5c;
                --gold-bg:     rgba(201,160,58,0.1);
                --gold-border: rgba(201,160,58,0.28);
                --green-ok:     #4ade80;
                --green-ok-bg:  rgba(74,222,128,0.08);
                --green-ok-br:  rgba(74,222,128,0.22);
                --red:          #f87171;
                --red-bg:       rgba(248,113,113,0.08);
                --red-border:   rgba(248,113,113,0.22);
            }
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-weight: 300;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 52px 16px 88px;
        }

        .wrap {
            width: 100%;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .header {
            text-align: center;
            padding: 0 0 22px;
        }

        .header .eyebrow {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: .22em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 8px;
        }

        .header h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 34px;
            font-weight: 400;
            color: var(--text);
            letter-spacing: -.01em;
            line-height: 1.1;
        }

        .header-sub {
            margin-top: 8px;
            font-size: 12.5px;
            color: var(--text3);
        }

        .rule { display: flex; align-items: center; gap: 10px; margin: 0 0 4px; }
        .rule-line { flex: 1; height: 1px; background: var(--gold-border); }
        .rule-gem  { width: 5px; height: 5px; background: var(--gold); transform: rotate(45deg); flex-shrink: 0; }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
        }

        .card-label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 13px 20px;
            border-bottom: 1px solid var(--border);
        }

        .card-label i { font-size: 14px; color: var(--gold); }

        .card-label span {
            font-size: 10.5px;
            font-weight: 500;
            letter-spacing: .16em;
            text-transform: uppercase;
            color: var(--text3);
        }

        .card-label .pill {
            margin-left: auto;
            font-size: 10.5px;
            font-weight: 500;
            color: var(--gold);
            background: var(--gold-bg);
            border: 1px solid var(--gold-border);
            padding: 2px 10px;
            border-radius: 100px;
        }

        .item-row {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 20px;
            border-bottom: 1px solid var(--border);
            transition: background .12s;
        }
        .item-row:last-child { border-bottom: none; }
        .item-row:hover { background: var(--surface2); }

        .item-index {
            font-family: 'DM Serif Display', serif;
            font-size: 13px;
            color: var(--gold);
            width: 18px;
            flex-shrink: 0;
            text-align: center;
        }

        .item-name {
            flex: 1;
            font-size: 13.5px;
            font-weight: 400;
            color: var(--text);
            min-width: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .item-qty  { font-size: 12px; color: var(--text3); flex-shrink: 0; }

        .item-price { font-size: 13.5px; font-weight: 500; color: var(--text); flex-shrink: 0; }

        .total-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
            background: var(--gold-bg);
            border-top: 1px solid var(--gold-border);
        }

        .total-label {
            font-size: 10.5px;
            font-weight: 500;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--text3);
        }

        .total-amount {
            font-family: 'DM Serif Display', serif;
            font-size: 22px;
            color: var(--gold-light);
        }

        .empty { padding: 30px 20px; text-align: center; color: var(--text3); font-size: 13px; }

        .form-body { padding: 16px 20px 20px; display: flex; flex-direction: column; gap: 13px; }

        .field { display: flex; flex-direction: column; gap: 5px; }

        .field label {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--gold);
        }

        .field input {
            background: var(--gold-bg);
            border: 1px solid var(--gold-border);
            border-radius: var(--r-sm);
            padding: 11px 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 400;
            color: var(--gold-light);
            outline: none;
            transition: border-color .15s, box-shadow .15s, background .15s;
        }

        .field input::placeholder { color: var(--text3); }

        .field input:focus {
            background: rgba(212,168,67,0.15);
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(212,168,67,0.18);
        }

        .btn-order {
            width: 100%;
            padding: 14px 20px;
            background: var(--gold);
            border: none;
            border-radius: var(--r-sm);
            color: #0a1a10;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: .1em;
            text-transform: uppercase;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 2px;
            transition: background .15s, transform .12s, box-shadow .15s;
            box-shadow: 0 2px 20px rgba(212,168,67,0.3);
        }

        .btn-order:hover {
            background: var(--gold-light);
            box-shadow: 0 4px 28px rgba(212,168,67,0.45);
            transform: translateY(-1px);
        }

        .btn-order:active { transform: scale(.99); }
        .btn-order:disabled { opacity: .45; cursor: not-allowed; transform: none; box-shadow: none; }
        .btn-order i { font-size: 15px; }

        .spin { animation: spin .75s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        .msg { display: none; align-items: center; gap: 9px; padding: 11px 14px; border-radius: var(--r-sm); font-size: 13px; }
        .msg.success { display: flex; background: var(--green-ok-bg); border: 1px solid var(--green-ok-br); color: var(--green-ok); }
        .msg.error   { display: flex; background: var(--red-bg);      border: 1px solid var(--red-border);   color: var(--red); }
        .msg i { font-size: 15px; flex-shrink: 0; }

        .footer {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 11.5px;
            color: var(--text3);
            padding-top: 4px;
        }
        .footer i { font-size: 13px; }
        .field input.invalid {
    border-color: var(--red);
    box-shadow: 0 0 0 3px rgba(248,113,113,0.18);
    background: var(--red-bg);
}
    </style>
</head>
<body>

<div class="wrap">

    <div class="header">
        <div class="eyebrow">Secure Checkout</div>
        <h1>Your Order</h1>
        <div class="header-sub">Review and confirm your details below</div>
    </div>

    <div class="rule"><div class="rule-line"></div><div class="rule-gem"></div><div class="rule-line"></div></div>

    <div class="card">
        <div class="card-label">
            <i class="ti ti-shopping-bag" aria-hidden="true"></i>
            <span>Order summary</span>
            <span class="pill" id="item-count">0 items</span>
        </div>
        <div id="items">
            <div class="empty">Your cart is empty</div>
        </div>
        <div class="total-row">
            <span class="total-label">Total</span>
            <span class="total-amount" id="total">Rs 0</span>
        </div>
    </div>

    <div class="card">
        <div class="card-label">
            <i class="ti ti-map-pin" aria-hidden="true"></i>
            <span>Delivery details</span>
        </div>
        <div class="form-body">
            <div class="field">
                <label>Full name</label>
                <input id="name" type="text" placeholder="Your name">
            </div>
            <div class="field">
                <label>Phone number</label>
                <input id="phone" type="tel" placeholder="03xx-xxxxxxx">
            </div>
            <div class="field">
                <label>Delivery address</label>
                <input id="address" type="text" placeholder="Street, area, city">
            </div>

            <div class="msg" id="msg">
                <i id="msg-icon" class="ti ti-circle-check"></i>
                <span id="msg-text"></span>
            </div>

            <button class="btn-order" id="orderBtn" onclick="placeOrder()">
                <i class="ti ti-check" id="btn-icon"></i>
                <span id="btn-label">Confirm Order</span>
            </button>
        </div>
    </div>

    <div class="footer">
        <i class="ti ti-shield-lock" aria-hidden="true"></i>
        Your details are kept private and secure
    </div>

</div>

<script>
let cart = JSON.parse(localStorage.getItem("cart")) || [];

function loadCart() {
    let box = document.getElementById("items");
    let total = 0, count = 0;
    box.innerHTML = "";

    if (!cart.length) {
        box.innerHTML = "<div class='empty'>Your cart is empty</div>";
        document.getElementById("total").innerText = "Rs 0";
        document.getElementById("item-count").innerText = "0 items";
        return;
    }

    cart.forEach((item, i) => {
        let qty = item.qty || 1;
        let price = Number(item.price) || 0;
        let itemTotal = price * qty;
        total += itemTotal;
        count += qty;

        let row = document.createElement("div");
        row.className = "item-row";
        row.innerHTML = `
            <span class="item-index">${i + 1}</span>
            <span class="item-name">${item.name}</span>
            <span class="item-qty">× ${qty}</span>
            <span class="item-price">Rs ${itemTotal.toLocaleString()}</span>
        `;
        box.appendChild(row);
    });

    document.getElementById("total").innerText = "Rs " + total.toLocaleString();
    document.getElementById("item-count").innerText = count + (count === 1 ? " item" : " items");
}

function setLoading(on) {
    document.getElementById("btn-icon").className = on ? "ti ti-loader-2 spin" : "ti ti-check";
    document.getElementById("btn-label").textContent = on ? "Placing order…" : "Confirm Order";
    document.getElementById("orderBtn").disabled = on;
}

function showMsg(type, text) {
    let msg = document.getElementById("msg");
    document.getElementById("msg-text").textContent = text;
    document.getElementById("msg-icon").className = type === "success" ? "ti ti-circle-check" : "ti ti-alert-circle";
    msg.className = "msg " + type;
}

function placeOrder() {
    document.getElementById("msg").className = "msg";
    ["name","phone","address"].forEach(id => document.getElementById(id).classList.remove("invalid"));

    const name    = document.getElementById("name").value.trim();
    const phone   = document.getElementById("phone").value.trim();
    const address = document.getElementById("address").value.trim();

    if (!name) {
        showMsg("error", "Please enter your full name.");
        document.getElementById("name").classList.add("invalid");
        document.getElementById("name").focus(); return;
    }
    if (!phone) {
        showMsg("error", "Please enter your phone number.");
        document.getElementById("phone").classList.add("invalid");
        document.getElementById("phone").focus(); return;
    }
    if (!/^03\d{9}$/.test(phone.replace(/[-\s]/g, ""))) {
        showMsg("error", "Enter a valid phone number (e.g. 03xx-xxxxxxx).");
        document.getElementById("phone").classList.add("invalid");
        document.getElementById("phone").focus(); return;
    }
    if (!address) {
        showMsg("error", "Please enter your delivery address.");
        document.getElementById("address").classList.add("invalid");
        document.getElementById("address").focus(); return;
    }
    if (address.length < 10) {
        showMsg("error", "Please enter a complete delivery address.");
        document.getElementById("address").classList.add("invalid");
        document.getElementById("address").focus(); return;
    }
    if (!cart.length) {
        showMsg("error", "Your cart is empty.");
        return;
    }

    setLoading(true);

    fetch("place_order.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            cart,
            user: {
                name:    document.getElementById("name").value,
                phone:   document.getElementById("phone").value,
                address: document.getElementById("address").value
            }
        })
    })
    .then(r => r.json())
    .then(data => {
        setLoading(false);
        if (data.status === "success") {
            showMsg("success", "Order confirmed! We'll call you shortly.");
            localStorage.removeItem("cart");
            setTimeout(() => { window.location.href = "index.php"; }, 2500);
        } else {
            showMsg("error", data.message || "Something went wrong.");
        }
    })
    .catch(() => {
        setLoading(false);
        showMsg("error", "Server error. Please try again.");
    });
}

loadCart();
</script>
</body>
</html>