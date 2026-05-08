<?php
$name = $_GET['name'] ?? 'unknown';

$members = [

"bareera" => [
    "name" => "Bareera",
    "role" => "Full Stack Developer/Project Manager",
    "image" => "../assets/images/biyaa.jpeg",
    "about" => "Passionate frontend developer focused on responsive layouts, interactive interfaces and modern web experiences.",
    "skills" => ["HTML","CSS","JavaScript","Bootstrap","PHP"],
    "socials" => [
        "github" => "https://github.com/Bareera-Amjad",
        "linkedin" => "https://linkedin.com/in/bareera",
        "instagram" => "https://www.instagram.com/_beethereal_/",
        "facebook" => "https://facebook.com/bareera"
    ]
],

"muqaddisa" => [
    "name" => "Muqaddisa",
    "role" => "frontend Developer",
    "image" => "../assets/images/muqi.jpeg",
    "about" => "Backend developer focused on APIs, authentication systems and scalable database solutions.",
    "skills" => ["PHP","MySQL","APIs","Authentication"],
    "socials" => [
        "github" => "https://github.com/muqaddisa",
        "linkedin" => "https://linkedin.com/in/muqaddisa",
        "instagram" => "https://instagram.com/muqaddisa._.rashid/",
        "facebook" => "https://facebook.com/muqaddisa"
    ]
],

"sarah" => [
    "name" => "Sarah",
    "role" => "UI/UX Designer",
    "image" => "../assets/images/sarh.jpeg",
    "about" => "Creative UI/UX designer building clean, modern and engaging digital experiences.",
    "skills" => ["Figma","UI Design","UX Research"],
    "socials" => [
        "github" => "https://pk.linkedin.com/in/sarah-hamid-ali-25769038a",
        "linkedin" => "https://linkedin.com/in/sarah",
        "instagram" => "https://instagram.com/sarah",
        "facebook" => "https://facebook.com/sarahhamidali"
    ]
],

"ayesha" => [
    "name" => "Ayesha",
    "role" => " Backend Developer",
    "image" => "../assets/images/aish.jpeg",
    "about" => "Project manager responsible for workflow planning, communication and team coordination.",
    "skills" => ["Management","Planning","Leadership"],
    "socials" => [
        "github" => "https://github.com/ayesha",
        "linkedin" => "https://linkedin.com/in/ayesha",
        "instagram" => "https://instagram.com/ayesha",
        "facebook" => ""
    ]
]

];


$member = $members[$name] ?? null;
?>

<!DOCTYPE html>
<html>
<head>

<title>Portfolio</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    background:#081018;
    color:white;
    overflow-x:hidden;
}

/* BACKGROUND */

.bg-blur{
    position:fixed;
    width:350px;
    height:350px;
    border-radius:50%;
    filter:blur(120px);
    opacity:0.15;
    z-index:-1;
}

.blur1{
    background:#00bfff;
    top:-100px;
    left:-100px;
}

.blur2{
    background:#004cff;
    bottom:-100px;
    right:-100px;
}

/* HERO */

.hero{
    min-height:100vh;
    padding:80px 8%;
    display:grid;
    grid-template-columns:1fr 1fr;
    align-items:center;
    gap:70px;
}

/* LEFT SIDE */

.hero-left{
    animation:fadeLeft 1s ease;
}

.tag{
    display:inline-block;
    padding:10px 18px;
    border-radius:40px;
    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.08);
    color:#00bfff;
    font-size:14px;
    margin-bottom:25px;
}

.hero-left h1{
    font-size:75px;
    line-height:1;
    font-weight:800;
    margin-bottom:15px;
}

.hero-left h2{
    color:#00bfff;
    font-size:30px;
    margin-bottom:25px;
    font-weight:600;
}

.hero-left p{
    color:#bdbdbd;
    line-height:1.9;
    font-size:17px;
    max-width:600px;
}

/* BUTTONS */

.buttons{
    margin-top:35px;
    display:flex;
    gap:18px;
    flex-wrap:wrap;
}

.primary-btn{
    padding:15px 35px;
    border-radius:16px;
    text-decoration:none;
    background:linear-gradient(135deg,#00bfff,#005eff);
    color:white;
    font-weight:600;
    transition:0.4s;
}

.primary-btn:hover{
    transform:translateY(-6px);
}

.secondary-btn{
    padding:15px 35px;
    border-radius:16px;
    text-decoration:none;
    border:1px solid rgba(255,255,255,0.1);
    color:white;
    transition:0.4s;
}

.secondary-btn:hover{
    background:white;
    color:black;
}

/* SOCIALS */

.socials{
    display:flex;
    gap:16px;
    margin-top:35px;
}

.socials i{
    width:50px;
    height:50px;
    border-radius:15px;
    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.08);
    display:flex;
    justify-content:center;
    align-items:center;
    color:#00bfff;
    transition:0.4s;
    cursor:pointer;
}

.socials i:hover{
    transform:translateY(-7px);
    background:#00bfff;
    color:white;
}

/* IMAGE */

.hero-right{
    display:flex;
    justify-content:center;
    animation:fadeRight 1s ease;
}

.image-card{
    width:340px;
    height:430px;
    border-radius:30px;
    overflow:hidden;
    background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.08);
    box-shadow:0 20px 50px rgba(0,0,0,0.5);
}

.image-card img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:0.5s;
}

.image-card:hover img{
    transform:scale(1.05);
}

/* STATS */

.stats{
    padding:20px 8% 80px;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:25px;
}

.stat-box{
    padding:35px;
    border-radius:25px;
    background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.08);
    text-align:center;
    transition:0.4s;
}

.stat-box:hover{
    transform:translateY(-10px);
    border-color:#00bfff;
}

.stat-box h2{
    color:#00bfff;
    font-size:48px;
}

.stat-box p{
    color:#bdbdbd;
}

/* SECTION */

.section{
    padding:90px 8%;
}

.section-title{
    text-align:center;
    font-size:52px;
    margin-bottom:60px;
    font-weight:800;
}

/* SERVICES */

.service-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
    gap:30px;
}

.service-card{
    padding:40px;
    border-radius:30px;
    background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.08);
    transition:0.4s;
}

.service-card:hover{
    transform:translateY(-10px);
    border-color:#00bfff;
}

.service-number{
    font-size:55px;
    color:rgba(255,255,255,0.08);
    font-weight:800;
}

.service-card h2{
    margin:15px 0;
    font-size:28px;
}

.service-card p{
    color:#bdbdbd;
    line-height:1.8;
}

/* SKILLS */

.skills-container{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:20px;
}

.skill{
    padding:15px 28px;
    border-radius:40px;
    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.08);
    color:#00bfff;
    font-weight:600;
    transition:0.4s;
}

.skill:hover{
    background:#00bfff;
    color:white;
    transform:translateY(-5px);
}

/* CONTACT */

.contact-box{
    max-width:850px;
    margin:auto;
    padding:60px;
    border-radius:30px;
    background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.08);
    text-align:center;
}

.contact-box h2{
    font-size:45px;
    margin-bottom:20px;
}

.contact-box p{
    color:#bdbdbd;
    margin-bottom:35px;
    line-height:1.8;
}

.back-btn{
    display:inline-block;
    padding:15px 35px;
    border-radius:16px;
    background:linear-gradient(135deg,#00bfff,#005eff);
    color:white;
    text-decoration:none;
    font-weight:600;
    transition:0.4s;
}

.back-btn:hover{
    transform:translateY(-6px);
}

/* ANIMATIONS */

@keyframes fadeLeft{
    from{
        opacity:0;
        transform:translateX(-70px);
    }
    to{
        opacity:1;
        transform:translateX(0);
    }
}

@keyframes fadeRight{
    from{
        opacity:0;
        transform:translateX(70px);
    }
    to{
        opacity:1;
        transform:translateX(0);
    }
}

/* RESPONSIVE */

@media(max-width:950px){

.hero{
    grid-template-columns:1fr;
    padding-top:120px;
}

.hero-left h1{
    font-size:55px;
}

.hero-left h2{
    font-size:24px;
}

.image-card{
    width:100%;
    max-width:340px;
}

.section-title{
    font-size:40px;
}

.contact-box{
    padding:40px 25px;
}

}

</style>

</head>

<body>

<?php if($member){ ?>

<div class="bg-blur blur1"></div>
<div class="bg-blur blur2"></div>

<!-- HERO -->

<section class="hero">

<div class="hero-left">

<div class="tag">
● Available For Projects
</div>

<h1>
<?php echo $member['name']; ?>
</h1>

<h2>
<?php echo $member['role']; ?>
</h2>

<p>
<?php echo $member['about']; ?>
</p>

<div class="buttons">

<a href="#" class="primary-btn">
Hire Me
</a>

<a href="#" class="secondary-btn">
View Work
</a>

</div>

<div class="socials">
<?php foreach($member['socials'] as $icon => $link){ ?>
    <a href="<?php echo $link; ?>" target="_blank">
        <i class="fab fa-<?php echo $icon; ?>"></i>
    </a>
<?php } ?>
</div>

</div>

<div class="hero-right">

<div class="image-card">
<img src="<?php echo $member['image']; ?>">
</div>

</div>

</section>

<!-- STATS -->

<section class="stats">

<div class="stat-box">
<h2>90+</h2>
<p>Projects Completed</p>
</div>

<div class="stat-box">
<h2>100+</h2>
<p>Happy Clients</p>
</div>

<div class="stat-box">
<h2>5+</h2>
<p>Years Experience</p>
</div>

<div class="stat-box">
<h2>15+</h2>
<p>Awards Won</p>
</div>

</section>

<!-- SERVICES -->

<section class="section">

<h1 class="section-title">
My Services
</h1>

<div class="service-grid">

<div class="service-card">
<div class="service-number">01</div>
<h2>Web Development</h2>
<p>
Modern responsive websites with smooth UI and interactive frontend design.
</p>
</div>

<div class="service-card">
<div class="service-number">02</div>
<h2>Creative Design</h2>
<p>
Clean UI/UX experiences with modern layouts and engaging user interaction.
</p>
</div>

<div class="service-card">
<div class="service-number">03</div>
<h2>Project Solutions</h2>
<p>
Professional solutions for frontend, backend and management systems.
</p>
</div>

</div>

</section>

<!-- SKILLS -->

<section class="section">

<h1 class="section-title">
My Skills
</h1>

<div class="skills-container">

<?php
foreach($member['skills'] as $skill){
echo "<div class='skill'>$skill</div>";
}
?>

</div>

</section>

<!-- CONTACT -->

<section class="section">

<div class="contact-box">

<h2>
Let's Work Together
</h2>

<p>
Available for freelance work, creative collaborations and modern website projects.
</p>

<a href="theme.php" class="back-btn">
← Back To Team
</a>

</div>

</section>

<?php } else { ?>

<h1 style="text-align:center;margin-top:100px;">
Member Not Found
</h1>

<?php } ?>

</body>
</html>