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
 
 $dataPoints = array( 
     array("y" => 3373.64, "label" => "Germany" ),
     array("y" => 2435.94, "label" => "France" ),
     array("y" => 1842.55, "label" => "China" ),
     array("y" => 1828.55, "label" => "Russia" ),
     array("y" => 1039.99, "label" => "Switzerland" ),
     array("y" => 765.215, "label" => "Japan" ),
     array("y" => 612.453, "label" => "Netherlands" )
 );
  
 ?>
 
 <script>
 window.onload = function() {
  
 var chart = new CanvasJS.Chart("chartContainer", {
     animationEnabled: true,
     theme: "light2",
     title:{
         text: "Gold Reserves"
     },
     axisY: {
         title: "Gold Reserves (in tonnes)"
     },
     data: [{
         type: "column",
         yValueFormatString: "#,##0.## tonnes",
         dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
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