<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- titan -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
         nav{
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: royalblue;
            height: 70px;
        }
        nav ul{
            display: flex;
            gap: 2rem;
            list-style: none;
        }
        nav .navbar-brand{
            font-family: "Titan One", sans-serif;
            font-style: italic;
            font-size: 2rem;
            background: linear-gradient(red, purple);
            color: transparent;
            background-clip: text;
            padding-inline: 2rem;
        }
        nav ul{
            padding-right: 1rem;
        }
        nav ul a{
            color: #fff;
            text-decoration: none;
            transition: .3s ease-in-out;
        }
        nav ul a:hover{
            color:orangered;
            
        }
        ul li a{
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>
<nav>
        <!-- navbrnad -->
        <a class="navbar-brand" href="./admin-panel.php">Adminpanel</a>

        <!-- navlinks -->
        <ul>
            <li><a href="./admin-panel.php"><i class="bi bi-pen-fill"></i> Manage users</a></li>
            <li><a href="./admin-panel.php"><i class="bi bi-search"></i> Seach users</a></li>
            <li><a href="./admin-panel.php"><i class="bi bi-plus-circle"></i>Add New users</a></li>
            <li><a href=""><i class="bi bi-box-arrow-left"></i>Log Out</a></li>
        </ul>
        </nav>
</body>
</html>