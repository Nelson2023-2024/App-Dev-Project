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

        $users_data = [];

        //Total registered users
        $total_users_query = "SELECT COUNT(*) as total_users FROM users";
        $total_users_result = mysqli_query($dbcon, $total_users_query);
        $total_users_row = mysqli_fetch_assoc($total_users_result);
        //var_dump($total_users_row);
        array_push($users_data, array("y" => $total_users_row['total_users'], "label" => "Total Users"));

        //Total males
        $total_males_query = "SELECT COUNT(*) as male_users FROM users WHERE gender = 'male'";
        $total_males_result = mysqli_query($dbcon, $total_males_query);
        $total_male_row = mysqli_fetch_assoc($total_males_result);
        array_push($users_data, array("y" => $total_male_row['male_users'], "label" => "Male Users"));

        //Total female
        $total_female_query = "SELECT COUNT(*) as female_users FROM users WHERE gender = 'female'";
        $total_female_result = mysqli_query($dbcon, $total_female_query);
        $total_female_row = mysqli_fetch_assoc($total_female_result);
        array_push($users_data, array("y" => $total_female_row['female_users'], "label" => "Female Users"));

        //other gender
        $total_other_query = "SELECT COUNT(*) as other_users FROM users WHERE gender = 'other'";
        $total_other_result = mysqli_query($dbcon, $total_other_query);
        $total_other_rows = mysqli_fetch_assoc($total_other_result);
        array_push($users_data, array("y" => $total_other_rows['other_users'], "label" => "Other users"));

        //admin
        $total_admin_query = "SELECT COUNT(*) as total_admin FROM users WHERE user_level = '1' ";
        $total_admin_result = mysqli_query($dbcon, $total_admin_query);
        $total_admin_rows =    mysqli_fetch_assoc($total_admin_result);
        array_push($users_data, array("y" => $total_admin_rows['total_admin'], "label" => "Total Admins"));


        ?>

        <script>
            window.onload = function() {

                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "light2",
                    title: {
                        text: "User Statistics"
                    },
                    axisY: {
                        title: "Number of Users "
                    },
                    data: [{
                        type: "column",
                        yValueFormatString: "#,##0.## Users",
                        dataPoints: <?php echo json_encode($users_data, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart.render();

            }
        </script>
        </head>

        <body>
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
        </body>

</html>



</div>

<script src="./delete.js"></script>
</body>

</html>