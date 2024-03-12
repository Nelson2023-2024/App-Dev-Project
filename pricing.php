<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
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
                    grid-template-columns: 1fr ;
                    gap: 2rem .9rem;
                    justify-content: center;
                }
            }
            
            @media (max-width: 528px) {
                .content {
                    width: 400px;
                    margin-inline: auto;
                    display: grid;
                    grid-template-columns: 1fr ;
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
    $select_stmt = mysqli_stmt_init($dbcon);
    $select_query = "SELECT * FROM categories";
    mysqli_stmt_prepare($select_stmt, $select_query);
    mysqli_stmt_execute($select_stmt);
    $result = mysqli_stmt_get_result($select_stmt);



    ?>
    <h1 class="text-center">Courses</h1>

    <div class="contain">
        <div class="content">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                //var_dump($row);

                echo '
             
             <div class="product1">
            <h5 class="text-center">' . $row['product_title'] . '</h5>
            <img class="text-center" src="./Uploads//' . $row['product_image'] . '" alt="">
            <p>' . $row['product_description'] . '</p>
            <button style="height: 40px; align-self: flex-end;" class= "btn btn-primary">' . $row['product_price'] . '</button>
        </div>
             
             ';
            }


            ?>
        </div>

        <button style="height: 40px; align-self: flex-end;"></button>

    </div>
</body>

</html>