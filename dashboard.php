<?php
session_start();
//var_dump($_SESSION);

if ($_SESSION["user_level"] !== 1 || !isset($_SESSION["user_level"])) {
    header("Location: login.php");
}
//if user level is found
else {
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">

    <title>Admin-panel</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            place-items: center;
            min-height: 100vh;
        }

        .total-box {
            max-width: 200px;
            min-height: 100px;
            background: linear-gradient(210deg, yellow, purple);
            padding: 20px;
            text-align: center;
            font-weight: bold;
            border-radius: 10px;

        }

        .username h1 {
            background: linear-gradient(red, blue);
            background-clip: text;
            color: transparent;
            text-align: center;
            font-size: 3rem;
            margin-top: 5rem;
        }
    </style>
</head>

<body>
    <div class="container">

        <?php include('./navbar.php') ?>

        <div class="username">
            <?php
            echo "<h1> Welcome $row[first_name] $row[last_name]</h1>";
            ?>
        </div>
        <?php

        $display_stmt = mysqli_stmt_init($dbcon);
        $display_query = "SELECT COUNT(*) AS total FROM users";
        mysqli_stmt_prepare($display_stmt, $display_query);
        mysqli_stmt_execute($display_stmt);

        $result = mysqli_stmt_get_result($display_stmt);

        $row = mysqli_fetch_array($result);
        var_dump($row);

        echo "<div class='total-box mb-3'><h3>Total registered User <br> <h2>$row[total]</h2></h3></div>";

        ?>

        <?php

        $users_data = array();

        // Total registered users
        $total_users_query = "SELECT COUNT(*) as total_users FROM users";
        $total_users_result = mysqli_query($dbcon, $total_users_query);
        $total_users_row = mysqli_fetch_assoc($total_users_result);
        $users_data[] = array("y" => $total_users_row['total_users'], "label" => "Total Users");

        // Male users
        $male_users_query = "SELECT COUNT(*) as male_users FROM users WHERE gender = 'male'";
        $male_users_result = mysqli_query($dbcon, $male_users_query);
        $male_users_row = mysqli_fetch_assoc($male_users_result);
        $users_data[] = array("y" => $male_users_row['male_users'], "label" => "Male Users");

        // Female users
        $female_users_query = "SELECT COUNT(*) as female_users FROM users WHERE gender = 'female'";
        $female_users_result = mysqli_query($dbcon, $female_users_query);
        $female_users_row = mysqli_fetch_assoc($female_users_result);
        $users_data[] = array("y" => $female_users_row['female_users'], "label" => "Female Users");

        //other users
        $other_users_query = "SELECT COUNT(*) as other_users FROM users WHERE gender = 'other'";
        $other_users_result = mysqli_query($dbcon, $other_users_query);
        $other_users_row = mysqli_fetch_assoc($other_users_result);
        array_push($users_data, array("y" => $other_users_row['other_users'], "label" => "Other users"));

        // Admin users
        $admin_users_query = "SELECT COUNT(*) as admin_users FROM users WHERE user_level = 1";
        $admin_users_result = mysqli_query($dbcon, $admin_users_query);
        $admin_users_row = mysqli_fetch_assoc($admin_users_result);
        $users_data[] = array("y" => $admin_users_row['admin_users'], "label" => "Admin Users");

        

        // Fetching data for categories chart
        $categories_data = array();

        // Total available products
        $total_products_query = "SELECT COUNT(*) as total_products FROM categories";
        $total_products_result = mysqli_query($dbcon, $total_products_query);
        $total_products_row = mysqli_fetch_assoc($total_products_result);
        $categories_data[] = array("y" => $total_products_row['total_products'], "label" => "Total Products");

        ?>

        <script>
            window.onload = function() {
                var usersChart = new CanvasJS.Chart("usersChartContainer", {
                    animationEnabled: true,
                    theme: "light2",
                    title: {
                        text: "User Statistics"
                    },
                    axisY: {
                        title: "Number of Users"
                    },
                    data: [{
                        type: "column",
                        yValueFormatString: "#,##0 Users",
                        dataPoints: <?php echo json_encode($users_data, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                usersChart.render();

                var categoriesChart = new CanvasJS.Chart("categoriesChartContainer", {
                    animationEnabled: true,
                    theme: "light2",
                    title: {
                        text: "Categories Statistics"
                    },
                    axisY: {
                        title: "Number of Products"
                    },
                    data: [{
                        type: "column",
                        yValueFormatString: "#,##0 Products",
                        dataPoints: <?php echo json_encode($categories_data, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                categoriesChart.render();
            }
        </script>
        </head>

        <body>
            <div id="usersChartContainer" style="height: 370px; width: 50%; float: left;"></div>
            <div id="categoriesChartContainer" style="height: 370px; width: 50%; float: left;"></div>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        </body>

</html>



=