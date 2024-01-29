<?php
try{
    session_start();
    var_dump($_SESSION);
    
    if($_SESSION["user_level"] !== 0 || !isset($_SESSION["user_level"]) ){
        header("Location: login.php");
    
    }
    //if user level is found
    else{
        require("./mysqli_connect.php");
        $id = $_SESSION['id'];

        $select_stmt = mysqli_stmt_init($dbcon);
        $select_query = "SELECT * FROM users WHERE id = ?";
        mysqli_stmt_prepare($select_stmt, $select_query);
        mysqli_stmt_bind_param($select_stmt, 'i', $id);
        mysqli_stmt_execute($select_stmt);

        $result = mysqli_stmt_get_result($select_stmt);

        $row = mysqli_fetch_assoc($result);
    }
    
    

}
//database exception
catch (mysqli_sql_exception $e){
    echo "Database Exception".$e->getMessage();

}
//general exception
catch (Exception $e){
    echo "General Exception".$e->getMessage();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home </title>
    <link rel="shortcut icon" href="./Webicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="./Styles/common.css">
    <link rel="stylesheet" href="./Styles/navbar.css">
    <link rel="stylesheet" href="./Styles/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <section class="home-main">

        <nav class="navbar">
            <div class="brand">
                <img src="./Webicon.png" alt="Webicon">
                <a href="/">WebDX</a>
            </div>

            <div class="menu-container">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <ul id="nav-links-container">

                <i class="fa fa-times" aria-hidden="true"></i>
                <li><a href="./index.html">Home</a></li>
                <li><a href="./pricing.html">Pricing</a></li>
                <li><a href="./contact.html">Contact</a></li>
                <li><a href="./logout.php">Logout</a></li>


            </ul>
        </nav>
        <?php 
        echo"<h1 style='color:red; text-align:center;'>Welcome $row[first_name] $row[last_name]</h1>";
        ?>
        <div class="main-content">
            <div class="text">
                <h1>Coding is <span style="color: #fff724;" class="auto-type">easy</span>
                </h1>
                <p>Welcome to webDX, your one-stop destination for learning HTML, CSS, JavaScript, and PHP. Whether
                    you're a beginner looking to start your coding journey or an experienced developer seeking to
                    enhance your skills, we've got you covered. Our comprehensive courses and tutorials will empower you
                    with the knowledge and tools you need to succeed in the world of web development.</p>
                <a href="" class="gradient-btn">Buy now</a>
            </div>
            <img class="imj" src="./Webicon.png" alt="">
        </div>

    </section>
    <section class="about">
        <h1>About</h1>
        <div class="about-sub">
            <img src="./Images/images/Image_post_.svg" alt="" class="about__img-1" loading="lazy">
            <div class="sub-sub-about">
                <h2>Why we Teach</h2>
                <p>At <b>WebDX</b>, our mission is to empower individuals from all walks of
                    life to discover the
                    incredible world of coding and web development. We believe that coding is not just a technical
                    skill; it's a gateway to creativity, problem-solving, and limitless possibilities.
                <p>Join us in shaping the future, one line of code at a time.</p>
                </p>
                <button class="btn">More info</button>
            </div>
        </div>

        <div class="about-sub">
            <div class="sub-sub-about">
                <h2>Content Overview</h2>
                <p>At <b>WebDX</b>, we offer a comprehensive range of coding courses and tutorials designed to cater to
                    learners of all levels, from beginners to advanced programmers. Our platform is your one-stop
                    destination for mastering the fundamental web development technologies: HTML/CSS, JavaScript, and
                    PHP.</p>
                <button class="btn">Register Now</button>
            </div>
            <img src="./Images/images/going_up.svg" alt="" class="about__img-2" loading="lazy">
        </div>
        </div>

        <div class="about-companies">
            <h1>Proudly used by begginers and Proffesional Developers</h1>
            <div class="company-logos">
                <i class="fa fa-google"></i>
                <i class="fa fa-facebook"></i>
                <i class="fa fa-github"></i>
                <i class="fa fa-reddit"></i>
                <i class="fa fa-twitter"></i>
                <i class="fa fa-instagram"></i>
            </div>
    </section>

    <div class="subscribe">
        <h2>Stay up to date with WebDX offers and news</h2>
        <form action="" class="subscribe-box">
            <input type="text" name="email" placeholder="Enter your email adress" required />
            <button>Submit</button>
        </form>
    </div>

    <div class="copyright">
        &copy; All rights reserved by Nelson 2023 <br>
        Made with <span>&hearts;</span> by Nelson
    </div>
    <script src="./Scripts/common.js"></script>



    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>

    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>

</body>

</html>