<?php
session_start();
var_dump($_SESSION);

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
    <title>Live Search</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Edit</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            padding-inline: 4rem;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .table {
            background-color: #fff;
            border-radius: 8px;
        }
        th, td {
            text-align: center;
            vertical-align: middle !important;
        }
        #searchInput {
            border-radius: 8px;
            width: 310px;
            height: 40px;
        }
    </style>
</head>
<body>
    <div  class="container-fluid mx-auto">
    <?php include('./navbar.php')?>

    </div>
    <div class="container-fluid mt-4">
        
        <h1 class="text-center mb-4">Live Search</h1>
        <div class="input-group mb-4">
            <div class="form-outline">
                <input type="text" id="searchInput" onkeyup="searchFunction()" class="form-control" placeholder="Search (first name, last name, or email)">
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Gender</th>
                    <th scope="col">User Level</th>
                    <th scope="col">Registration Date</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody id="showData">
                <?php
                require('./mysqli_connect.php');

                // Fetch all users initially
                $sql = "SELECT * FROM users";
                $query = mysqli_query($dbcon, $sql);

                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['first_name']}</td>";
                    echo "<td>{$row['last_name']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['phone_number']}</td>";
                    echo "<td>{$row['gender']}</td>";
                    echo "<td><strong>".($row['user_level'] === '0' ? 'USER' : 'ADMIN')."</strong></td>";
                    echo "<td>{$row['registration_date']}</td>";
                    echo "<td><a href='edit.php?id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a></td>";
                    echo "<td><a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z5G7bYlF2K/mRrVJyLgic6L+8c4j3g0G1f0woM" crossorigin="anonymous"></script>

    <script>
    function searchFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("showData");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            let found = false;
            for (let j = 1; j < td.length - 2; j++) { // Start from 1 to exclude id column and end 2 before to exclude edit and delete columns
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            if (found) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
    </script>
</body>
</html>
