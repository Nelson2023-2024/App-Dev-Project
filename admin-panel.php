<?php
session_start();
//var_dump($_SESSION);

if($_SESSION["user_level"] !== 1 || !isset($_SESSION["user_level"]) ){
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-panel</title>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            display: flex;
            place-items: center;
            min-height: 100vh;
        }
        .total-box {
            max-width: 200px;
            min-height: 100px;
            background:linear-gradient(210deg,yellow, purple);
            padding: 20px;
            text-align: center;
            font-weight: bold;
            border-radius: 10px;
            
        }
       
    </style>
</head>
<body>
    <div class="container">

    <?php include('./navbar.php')?>
        
        <?php
        require('./mysqli_connect.php');

        $display_stmt = mysqli_stmt_init($dbcon);
        $display_query = "SELECT COUNT(*) AS total FROM users";
        mysqli_stmt_prepare($display_stmt, $display_query);
        mysqli_stmt_execute($display_stmt);

        $result = mysqli_stmt_get_result($display_stmt);

        $row = mysqli_fetch_array($result);
        var_dump($row);

        echo"<div class='total-box mb-3'><h3>Total registered User <br> <h2>$row[total]</h2></h3></div>";

        
       

        
        ?>
        <a href="./registration-admin.php" class="btn btn-primary mb-3">+ New Client</a>
        <h1 class="text-center">Manage Users</h1>
        <table class="table">
            <thead class="bg-dark text-light text-center">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Gender</th>
                    <th scope="col">User level</th>
                    <th scope="col">Registration Date</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php

                // Number of users per page
                $users_per_page = 4;

                // Get the current page number from the URL parameter
                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                // Calculate the starting limit for SQL query
                $starting_limit = ($page - 1) * $users_per_page;

                // Query to fetch users with pagination
                $select_query = "SELECT * FROM users LIMIT $starting_limit, $users_per_page";
                $result = mysqli_query($dbcon, $select_query);

                while($row = mysqli_fetch_assoc($result)){
                    echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['first_name']}</td>
                        <td>{$row['last_name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone_number']}</td>
                        <td>{$row['gender']}</td>
                        <td><strong>".($row['user_level'] === '0' ? 'USER' : 'ADMIN')."</strong></td>
                        <td>{$row['registration_date']}</td>
                        <td><a href='edit.php?id={$row['id']}'>Edit</a></td>
                        <!-- Update the delete link to use a class -->
<td class='delete-alert'><a href='delete.php?id={$row['id']}'>Delete</a></td>

                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination buttons -->
        <div class="text-center">
            <?php
            // Count total number of pages
            $total_users_query = "SELECT COUNT(*) AS total FROM users";
            $total_users_result = mysqli_query($dbcon, $total_users_query);
            $total_users = mysqli_fetch_assoc($total_users_result)['total'];
            $total_pages = ceil($total_users / $users_per_page);

            // Output pagination buttons
            for ($btn = 1; $btn <= $total_pages; $btn++) {
                echo "<a class='btn btn-dark text-light mx-2 mb-3' href='admin-panel.php?page=$btn'>$btn</a>";
            }
            ?>
        </div>
    </div>

    <script src="./delete.js"></script>
</body>
</html>
