<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background:#200404;
            color:white;
            font-family:Arial;
        }

        .box {
            width:60%;
            margin:50px auto;
            background:#4d2222;
            padding:25px;
            border-radius:12px;
        }

        .item {
            display:flex;
            justify-content:space-between;
            padding:10px;
            border-bottom:1px solid #333;
        }

        .btn-order {
            width:100%;
            padding:12px;
            background:#f5c542;
            border:none;
            font-weight:bold;
            cursor:pointer;
        }

        #loader {
            display:none;
            text-align:center;
            margin-top:15px;
        }

        #msg {
            text-align:center;
            margin-top:15px;
        }
    </style>
</head>

<body>

<div class="box">

    <h2 style="text-align:center; color:#f5c542;">Checkout</h2>

    <div id="items"></div>

    <h3 id="total" style="text-align:right; color:#f5c542;"></h3>

    <hr>

    <input id="name" class="form-control mb-2" placeholder="Name">
    <input id="phone" class="form-control mb-2" placeholder="Phone">
    <input id="address" class="form-control mb-2" placeholder="Address">

    <button class="btn-order" onclick="placeOrder()">Place Order</button>

    <div id="loader">
        <div class="spinner-border text-warning"></div>
        <p>Please wait...</p>
    </div>

    <div id="msg"></div>

</div>

<script>

let cart = JSON.parse(localStorage.getItem("cart")) || [];

/* LOAD CART */
function loadCart() {

    let box = document.getElementById("items");
    let total = 0;

    box.innerHTML = "";

    cart.forEach(item => {

        let qty = item.quantity || 1;

        total += Number(item.price || 0) * qty;

        box.innerHTML += `
            <div class="item">
                <span>${item.name} x ${qty}</span>
                <span>Rs ${Number(item.price || 0) * qty}</span>
            </div>
        `;
    });

    document.getElementById("total").innerText = "Total: Rs " + total;
}

/* PLACE ORDER */
function placeOrder() {

    let loader = document.getElementById("loader");
    let msg = document.getElementById("msg");

    loader.style.display = "block";
    msg.innerHTML = "";

    fetch("place_order.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            cart: cart,
            user: {
                name: document.getElementById("name").value,
                phone: document.getElementById("phone").value,
                address: document.getElementById("address").value
            }
        })
    })
    .then(res => res.json())
    .then(data => {

        loader.style.display = "none";

        if (data.status === "success") {

            msg.innerHTML = `
                <div class="alert alert-success">
                    ✔ Order placed successfully!
                </div>
            `;

            localStorage.removeItem("cart");

            setTimeout(() => {
                window.location.href = "index.php";
            }, 2000);

        } else {
            msg.innerHTML = `
                <div class="alert alert-danger">
                    ❌ ${data.message}
                </div>
            `;
        }
    })
    .catch((err) => {

        console.log(err); // IMPORTANT DEBUG

        loader.style.display = "none";

        msg.innerHTML = `
            <div class="alert alert-danger">
                ❌ Server error. Try again.
            </div>
        `;
    });
}
loadCart();

</script>

</body>
</html>