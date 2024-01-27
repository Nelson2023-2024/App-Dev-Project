<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Admin-panel</title>

    <style>
        body{
            display: flex;
            place-items: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container">
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
                require('./mysqli_connect.php');

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
                        <td><a href='delete.php?id={$row['id']}'>Delete</a></td>
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
</body>
</html>