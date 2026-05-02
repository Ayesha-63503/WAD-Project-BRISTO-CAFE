function getBotResponse(input) {

input = input.trim().toLowerCase();

    // GREETING
    if (input.includes("hello") || input.includes("hi")) {
        return "Hello ☕ Welcome to Baristo Brew! How can I help you?";
    }

    // COMMANDS
    else if (input.includes("commands")) {
        return "Keywords:<br/><br/>" +
        "<b>menu</b> - view menu<br/>" +
        "<b>about</b> - about us<br/>" +
        "<b>contact</b> - contact info<br/>" +
        "<b>how to order</b> - ordering guide<br/>" +
        "<b>location</b> - our address";
    }

    // MENU (UPDATED FULL MENU 🔥)
    else if (input.includes("menu")) {
        return "Here is our menu ☕:<br><br>" +

        "<b>☕ Coffee:</b><br>" +
        "Latte - Rs 670<br>" +
        "Espresso - Rs 450<br>" +
        "Cappuccino - Rs 1670<br>" +
        "Mocha - Rs 1240<br><br>" +

        "<b>🥤 Drinks:</b><br>" +
        "Mint Margarita - Rs 999<br>" +
        "Lemonade - Rs 398<br>" +
        "Bubble Drink - Rs 2200<br><br>" +

        "<b>🍕 Pizza:</b><br>" +
        "Chicken Tikka - Rs 2200<br>" +
        "Cheese Pizza - Rs 1590<br><br>" +

        "<b>🥪 Sandwiches:</b><br>" +
        "Chicken Sandwich - Rs 750<br><br>" +

        "<b>🍝 Pasta:</b><br>" +
        "Alfredo Pasta - Rs 1200<br><br>" +

        "<b>🍰 Desserts:</b><br>" +
        "Chocolate Cake - Rs 2300<br>" +
        "Cheesecake - Rs 5900";
    }

    // ABOUT
    else if (input.includes("about")) {
        return "Baristo Brew ☕ is a cozy coffee café offering premium drinks, food, and a relaxing environment.";
    }

    // CONTACT
    else if (input.includes("contact")) {
        return "Contact us:<br>" +
        "<b>Email:</b> your@email.com<br>" +
        "<b>Phone:</b> 03XX-XXXXXXX";
    }

    // ORDER GUIDE
    else if (input.includes("order")) {
        return "To order:<br><br>" +
        "1. Go to Menu<br>" +
        "2. Click 'Add to Cart'<br>" +
        "3. Checkout 🛒";
    }

    // LOCATION
    else if (input.includes("location") || input.includes("where")) {
        return "We are located in Islamabad 📍 Visit us anytime!";
    }

    // DEFAULT
    else {
        return "Sorry 😅 I didn't understand. Try: menu, coffee, pizza, contact.";
    }
}  //responses.js