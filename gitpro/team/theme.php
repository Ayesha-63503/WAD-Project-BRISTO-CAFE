<!DOCTYPE html>
<html>
<head>
<title>Our Team</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial;
    background:#0f0f0f;
    overflow-x:hidden;
    color:white;
}

.hero{
    min-height:100vh;
    padding:80px 20px;
    background:linear-gradient(135deg,#120606,#000000,#2a0d0d);
}

.hero h1{
    text-align:center;
    font-size:60px;
    margin-bottom:15px;
    color:#ffb347;
    animation:fadeDown 1s ease;
}

.hero p{
    text-align:center;
    color:#ccc;
    margin-bottom:60px;
    animation:fadeUp 1s ease;
}

.team-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:35px;
    max-width:1300px;
    margin:auto;
}

.card-box{
    position:relative;
    border-radius:25px;
    overflow:hidden;
    background:rgba(255,255,255,0.05);
    backdrop-filter:blur(12px);
    transition:0.5s;
    transform-style:preserve-3d;
    box-shadow:0 0 25px rgba(255,179,71,0.1);
}

.card-box:hover{
    transform:translateY(-12px) scale(1.03);
    box-shadow:0 0 40px rgba(255,179,71,0.4);
}

.image-box{
    position:relative;
    height:350px;
    overflow:hidden;
}

.image-box img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:0.6s;
}

.card-box:hover img{
    transform:scale(1.1);
}

.overlay{
    position:absolute;
    inset:0;
    background:linear-gradient(to top,rgba(0,0,0,0.9),transparent);
}

.content{
    padding:25px;
    text-align:center;
}

.content h2{
    color:#ffb347;
    margin-bottom:10px;
}

.role{
    color:#bbb;
    margin-bottom:18px;
}

.icons{
    margin-bottom:20px;
}

.icons i{
    margin:0 10px;
    font-size:20px;
    color:#ffb347;
    transition:0.4s;
}

.icons i:hover{
    transform:scale(1.3) rotate(8deg);
    color:white;
}

.view-btn{
    display:inline-block;
    padding:12px 28px;
    border-radius:40px;
    text-decoration:none;
    background:#ffb347;
    color:black;
    font-weight:bold;
    transition:0.4s;
}

.view-btn:hover{
    background:white;
    transform:scale(1.05);
}

.glow{
    position:absolute;
    width:250px;
    height:250px;
    background:#ffb347;
    border-radius:50%;
    filter:blur(120px);
    opacity:0.15;
    z-index:-1;
}

.glow1{
    top:-50px;
    left:-50px;
}

.glow2{
    bottom:-50px;
    right:-50px;
}

@keyframes fadeDown{
    from{
        opacity:0;
        transform:translateY(-40px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(40px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

</style>
</head>

<body>

<div class="hero">

<div class="glow glow1"></div>
<div class="glow glow2"></div>

<h1>Meet Our Team</h1>
<p>Creative Developers Behind The Coffee Shop Website</p>

<div class="team-grid">

<!-- Bareera -->
<div class="card-box">

<div class="image-box">
<img src="../assets/images/biyaa.jpeg">
<div class="overlay"></div>
</div>

<div class="content">
<h2>Bareera</h2>
<p class="role">Full stack Developer/project Manager</p>

<div class="icons">
<i class="fab fa-html5"></i>
<i class="fab fa-css3-alt"></i>
<i class="fab fa-js"></i>
</div>

<a class="view-btn" href="member.php?name=bareera">
View Portfolio
</a>

</div>
</div>

<!-- Muqaddisa -->
<div class="card-box">

<div class="image-box">
<img src="../assets/images/muqi.jpeg">
<div class="overlay"></div>
</div>

<div class="content">
<h2>Muqaddisa</h2>
<p class="role">frontend Developer</p>

<div class="icons">
<i class="fab fa-php"></i>
<i class="fas fa-database"></i>
<i class="fas fa-server"></i>
</div>

<a class="view-btn" href="member.php?name=muqaddisa">
View Portfolio
</a>

</div>
</div>

<!-- Sarah -->
<div class="card-box">

<div class="image-box">
<img src="../assets/images/sarh.jpeg">
<div class="overlay"></div>
</div>

<div class="content">
<h2>Sarah</h2>
<p class="role">UI/UX Designer</p>

<div class="icons">
<i class="fab fa-figma"></i>
<i class="fas fa-palette"></i>
<i class="fas fa-paint-brush"></i>
</div>

<a class="view-btn" href="member.php?name=sarah">
View Portfolio
</a>

</div>
</div>

<!-- Ayesha -->
<div class="card-box">

<div class="image-box">
<img src="../assets/images/aish.jpeg">
<div class="overlay"></div>
</div>

<div class="content">
<h2>Ayesha</h2>
<p class="role">Backend Developer</p>

<div class="icons">
<i class="fas fa-users"></i>
<i class="fas fa-chart-line"></i>
<i class="fas fa-briefcase"></i>
</div>

<a class="view-btn" href="member.php?name=ayesha">
View Portfolio
</a>

</div>
</div>

</div>
</div>

</body>
</html>