<<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>About Us - Baristo Brew</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #f3e0c6, #e6c7a2);
    color: #3b2a1a;
}

/* MAIN CONTAINER */
.about-container {
    padding: 90px 12%;
}

/* TITLE */
h1 {
    font-family: 'Playfair Display', serif;
    font-size: 4.5rem;
    color: #4b2e1e;
    margin-bottom: 25px;
}

/* TEXT */
p {
    font-size: 1.7rem;
    line-height: 2.6rem;
    color: #4a3a2a;
}

/* HIGHLIGHT */
.highlight {
    color: #6b3e26;
    font-weight: 600;
}

/* INFO BOX */
.info-box {
    background: rgba(255, 255, 255, 0.4);
    padding: 20px;
    border-radius: 15px;
    margin-top: 20px;
    backdrop-filter: blur(5px);
}

/* REVIEWS */
.review-title {
    font-family: 'Playfair Display', serif;
    text-align: center;
    font-size: 3.8rem;
    color: #4b2e1e;
    margin: 80px 0 50px;
}

.review-box {
    background: rgba(255, 255, 255, 0.5);
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    height: 100%;
}

.stars {
    color: #d4a373;
    font-size: 1.8rem;
    margin-bottom: 10px;
}

.review-name {
    color: #6b3e26;
    font-weight: 600;
}

<>

.team-section{
    padding:60px 20px;
}

.member-card{
    background:#3a1414;
    border:none;
    border-radius:20px;
    overflow:hidden;
    transition:0.4s;
    box-shadow:0 5px 15px rgba(0,0,0,0.4);
}

.member-card:hover{
    transform:translateY(-10px);
}

.member-img{
    height:250px;
    object-fit:cover;
}

.member-content{
    padding:20px;
    text-align:center;
}

.member-content h3{
    color:#ffb347;
    font-weight:bold;
}

.skill{
    display:inline-block;
    background:#ffb347;
    color:black;
    padding:5px 12px;
    margin:5px;
    border-radius:20px;
    font-size:14px;
    font-weight:bold;
}

.btn-custom{
    background:#ffb347;
    border:none;
    color:black;
    font-weight:bold;
    border-radius:30px;
    padding:10px 20px;
}

.modal-content{
    background:#2a0f0f;
    color:white;
    border-radius:20px;
}

.portfolio-img{
    width:150px;
    height:150px;
    border-radius:50%;
    object-fit:cover;
}


</style>
</head>

<body>

<div class="about-container">

    <!-- ABOUT SECTION -->
    <h1>About Baristo Brew ☕</h1>

    <p>
        Welcome to <span class="highlight">Baristo Brew Coffee Shop</span>, where every cup is crafted with passion,
        warmth, and perfection. We are not just a café — we are an experience.
    </p>

    <div class="info-box">
        <p>
            🌱 We use <span class="highlight">premium coffee beans</span> sourced from the finest farms.  
            Every drink is freshly prepared to ensure rich aroma and smooth taste.
        </p>
    </div>

    <div class="info-box">
        <p>
            ⭐ <span class="highlight">Quality:</span> 100% fresh brewed coffee  
            ⭐ <span class="highlight">Rating:</span> 4.8/5 customer satisfaction  
            ⭐ <span class="highlight">Mission:</span> To deliver comfort in every sip  
        </p>
    </div>

    <p>
        Whether you're studying, working, or relaxing, Baristo Brew is your perfect cozy coffee destination.
    </p>

    <!-- REVIEWS SECTION -->
    <h2 class="review-title">What Our Customers Say ☕</h2>

    <div class="container">
        <div class="row g-4">

            <div class="col-md-4">
                <div class="review-box">
                    <div class="stars">★★★★★</div>
                    <p>“Absolutely amazing coffee! Smooth and perfectly balanced taste.”</p>
                    <div class="review-name">— Ayesha Khan</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="review-box">
                    <div class="stars">★★★★☆</div>
                    <p>“Great atmosphere and perfect place for studying.”</p>
                    <div class="review-name">— Ahmed Ali</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="review-box">
                    <div class="stars">★★★★★</div>
                    <p>“Best cappuccino I’ve ever had in my life!”</p>
                    <div class="review-name">— Fatima Noor</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="review-box">
                    <div class="stars">★★★★★</div>
                    <p>“Very cozy environment and friendly staff.”</p>
                    <div class="review-name">— Hamza Raza</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="review-box">
                    <div class="stars">★★★★☆</div>
                    <p>“Mocha is rich and perfectly brewed.”</p>
                    <div class="review-name">— Sara Malik</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="review-box">
                    <div class="stars">★★★★★</div>
                    <p>“Best café experience in town. Highly recommended!”</p>
                    <div class="review-name">— Usman Tariq</div>
                </div>
            </div>

        </div>
    </div>

</div>



</body>
</html>