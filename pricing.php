<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./Styles/navbar.css">
    <link rel="stylesheet" href="./Styles/common.css">

    
    <title>Pricing</title>
    <style>
        body {
            background: #eee;
        }

        .content {
            width: 980px;
            margin-inline: auto;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 2rem .9rem;
            justify-content: center;
        }

        @media (max-width: 1050px) {
            .content {
                width: 800px;
                margin-inline: auto;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 2rem .9rem;
                justify-content: center;
            }

            @media (max-width: 867px) {
                .content {
                    width: 500px;
                    margin-inline: auto;
                    display: grid;
                    grid-template-columns: 1fr;
                    gap: 2rem .9rem;
                    justify-content: center;
                }
            }

            @media (max-width: 528px) {
                .content {
                    width: 400px;
                    margin-inline: auto;
                    display: grid;
                    grid-template-columns: 1fr;
                    gap: 2rem .9rem;
                    justify-content: center;
                }
            }


        }

        .product1 {
            display: grid;
            justify-self: center;
            box-shadow: 0px 0px 10px;
        }

        img {
            max-width: 100px;
            justify-self: center;
        }

        p {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    require('./mysqli_connect.php');

    // Pagination settings
    $items_per_page = 6;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $starting_limit = ($page - 1) * $items_per_page;

    $select_stmt = mysqli_stmt_init($dbcon);
    $select_query = "SELECT * FROM categories LIMIT $starting_limit, $items_per_page";
    mysqli_stmt_prepare($select_stmt, $select_query);
    mysqli_stmt_execute($select_stmt);
    $result = mysqli_stmt_get_result($select_stmt);
    ?>

    <nav class="navbar" style="background: gray;">
        <div class="brand">
            <img src="./Webicon.png" alt="Webicon">
            <a href="">WebDX</a>
        </div>

        <div class="menu-container">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <ul id="nav-links-container" style="align-items: center;">

            <i class="fa fa-times" aria-hidden="true"></i>
            <li><a href="./memberspage.php">Home</a></li>
            <li><a href="./pricing.php">Courses</a></li>
            <li><a href="#">Contact</a></li>
            <li style="background: red; padding:1rem ; border-radius:10px;"><a href="./logout.php">Logout</a></li>
        </ul>

        <!-- <div style="margin-right: 4rem;" class="profile">
                <a href="./updateuser.php"><i class="fa-solid fa-user"></i></a>
            </div> -->
    </nav>
    <h1 class="text-center">Courses</h1>

    <div class="contain">
        <div class="content">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                <div class="product1">
                    <h5 class="text-center">' . $row['product_title'] . '</h5>
                    <img class="text-center" src="./Uploads//' . $row['product_image'] . '" alt="">
                    <p>' . $row['product_description'] . '</p>
                    <button style="height: 40px; align-self: flex-end;" class="btn btn-primary">' . $row['product_price'] . '</button>
                </div>
                ';
            }
            ?>
        </div>

        <!-- Pagination buttons -->
        <div class="text-center">
            <?php
            // Count total number of pages
            $total_items_query = "SELECT COUNT(*) AS total FROM categories";
            $total_items_result = mysqli_query($dbcon, $total_items_query);
            $total_items = mysqli_fetch_assoc($total_items_result)['total'];
            $total_pages = ceil($total_items / $items_per_page);

            // Output pagination buttons
            for ($btn = 1; $btn <= $total_pages; $btn++) {
                echo "<a class='btn btn-dark text-light mx-2 mb-3 mt-4' href='pricing.php?page=$btn'>$btn</a>";
            }
            ?>
        </div>
    </div>

    <script src="./delete.js"></script>
    <script src="./registration-admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>