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

        span {
            color: red;
            font-size: 13.5px;
        }

        p {
            font-size: 12.5px;
            margin-bottom: 2px;
            font-weight: bold;
        }

        div .col {
            position: relative;
        }

        i {
            position: absolute;
            right: 5px;
            top: 6px;
            cursor: pointer;
            font-size: 18px;

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

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            + New Client
        </button>
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
                $users_per_page = 5;

                // Get the current page number from the URL parameter
                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                // Calculate the starting limit for SQL query
                $starting_limit = ($page - 1) * $users_per_page;

                // Query to fetch users with pagination
                $select_query = "SELECT * FROM users LIMIT $starting_limit, $users_per_page";
                $result = mysqli_query($dbcon, $select_query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['first_name']}</td>
                        <td>{$row['last_name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone_number']}</td>
                        <td>{$row['gender']}</td>
                        <td><strong>" . ($row['user_level'] === '0' ? 'USER' : 'ADMIN') . "</strong></td>
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
                echo "<a class='btn btn-dark text-light mx-2 mb-3' href='manageusers.php?page=$btn'>$btn</a>";
            }
            ?>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="form" class="mx-auto" method="post">
                            <?php
                            try {

                                //connection
                                //error array
                                $errors = [];
                                if ($_SERVER['REQUEST_METHOD'] === "POST") {
                                    //var_dump($_POST);
                                    $first_name = trim($_POST['fname']);
                                    $last_name = trim($_POST['lname']);
                                    $email =  trim($_POST['email']);
                                    $phone_no = trim($_POST['phoneNo']);
                                    $gender = trim($_POST['gender']);
                                    $user_level = trim($_POST['user_level']);
                                    $password1 = trim($_POST['pass1']);
                                    $password2 = trim($_POST['pass2']);

                                    //first name validation
                                    if (empty($first_name)) array_push($errors, "Please enter the users first name");

                                    //last name validation
                                    if (empty($last_name)) array_push($errors, "Please enter the users last name");

                                    //email validation
                                    if (empty($email)) array_push($errors, "Please enter the users email");

                                    //email format validation
                                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                        array_push($errors, "Invalid email format");
                                    }

                                    //duplicate email validation
                                    $select_stmt = mysqli_stmt_init($dbcon);
                                    $select_query = "SELECT email FROM users WHERE email = ?";
                                    mysqli_stmt_prepare($select_stmt, $select_query);
                                    mysqli_stmt_bind_param($select_stmt, 's', $email);
                                    mysqli_stmt_execute($select_stmt);
                                    $result = mysqli_stmt_get_result($select_stmt);

                                    $row = mysqli_fetch_assoc($result);

                                    //result is found
                                    if ($row) {
                                        array_push($errors, "Email arleady exists");
                                    }

                                    //gender name validation
                                    if (empty($gender)) array_push($errors, "Please enter the users gender");



                                    //user level validation
                                    if ((int)$user_level !== 0 && (int)$user_level !== 1) {
                                        array_push($errors, "User level can only be 0(USER) or 1(ADMIN)");
                                    }

                                    //if password1 is  not empty
                                    if (!empty($password1)) {
                                        if (strlen($password1) < 8) {
                                            array_push($errors, "Password must be at least 8 characters long");
                                        }
                                        //if both passwords are not equal
                                        if ($password1 !== $password2) {
                                            array_push($errors, "The two passwords did not match");
                                        }
                                    }
                                    //if password1 is empty
                                    else {
                                        array_push($errors, "Please enter the users password");
                                    }


                                    //traverse the array to output errors
                                    foreach ($errors as $error) {
                                        echo '<div style="height:40px; display: flex; align-items:center; justify-content:center;" class="alert alert-danger text-center " role="alert"><strong>' . $error . '</strong></div>';
                                    }

                                    //if everything is ok
                                    if (empty($errors)) {

                                        //hash password
                                        $password_hash = password_hash($password1, PASSWORD_DEFAULT);

                                        $insert_stmt = mysqli_stmt_init($dbcon);
                                        $insert_query = "INSERT INTO users (first_name, last_name, email, phone_number, gender, password, user_level) VALUES(?,?,?,?,?,?,?)";

                                        mysqli_stmt_prepare($insert_stmt, $insert_query);
                                        mysqli_stmt_bind_param($insert_stmt, 'ssssssi', $first_name, $last_name, $email, $phone_no, $gender, $password_hash, $user_level);
                                        mysqli_stmt_execute($insert_stmt);

                                        if (mysqli_stmt_affected_rows($insert_stmt) == 1) {
                                            echo '<div class="alert alert-success text-center" role="alert"><strong>Registered User sucefully</strong></div>';
                                        } else {
                                            echo "Failed to register user";
                                        }
                                    }
                                }
                            }
                            //database exception
                            catch (mysqli_sql_exception $e) {
                                echo "Database Exception" . $e->getMessage();
                            }
                            //general exception
                            catch (Exception $e) {
                                echo "General Exception" . $e->getMessage();
                            }


                            ?>

                            <div class="row g-3 mb-3">
                                <!-- first name -->
                                <div class="col">
                                    <input id="first_name" name="fname" type="text" class="form-control" placeholder="First name" aria-label="First name" value="<?= isset($first_name) ? $first_name : "" ?>">
                                    <span id="first_error"></span>
                                </div>

                                <!-- last name -->
                                <div class="col">
                                    <input id="last_name" name="lname" type="text" class="form-control" placeholder="Last name" aria-label="Last name" value="<?= isset($last_name) ? $last_name : "" ?>">
                                    <span id="last_error"></span>

                                </div>
                            </div>

                            <!-- email -->
                            <div class="col mb-3">
                                <input id="email" name="email" type="text" class="form-control" placeholder="Email" aria-label="Email" value="<?= isset($email) ? $email : "" ?>">
                                <span id="email_error"></span>

                            </div>

                            <!-- phone number -->
                            <div class="col mb-3">
                                <input id="phone" name="phoneNo" type="text" class="form-control" placeholder="Phone number" aria-label="Phone number" value="<?= isset($phone_no) ? $phone_no : "" ?>">
                                <span id="phone_error"></span>

                            </div>

                            <!-- gender -->
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="male" <?= isset($gender) && $gender === "male" ? "checked" : "" ?>>
                                        <label class="form-check-label" for="maleRadio">
                                            Male
                                        </label>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="female" <?= isset($gender) && $gender === "female" ? "checked" : "" ?>>
                                        <label class="form-check-label" for="femaleRadio">
                                            Female
                                        </label>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="otherRadio" value="other" <?= isset($gender) && $gender === "other" ? "checked" : "" ?>>
                                        <label class="form-check-label" for="otherRadio">
                                            Others
                                        </label>
                                    </div>
                                </div>
                                <span id="gender_error"></span>
                            </div>


                            <!-- user level -->
                            <div class="col mb-3">
                                <input id="userlevel" name="user_level" type="number" class="form-control" placeholder="User level" aria-label="Phone number" value="<?= isset($user_level) ? $user_level : "" ?>">
                                <span id="userlevel_error"></span>
                                <p>Note: 0(USER) and 1(ADMIN)</p>

                            </div>
                            <!-- password1 -->
                            <div class="col mb-3">
                                <input id="password1" name="pass1" type="password" class="form-control" placeholder="Password" aria-label="Phone number" value="<?= isset($password1) ? $password1 : "" ?>">
                                <p>Enter a minimum of 8 characters</p>
                                <span id="password1_error"></span>
                                <i class="open bi bi-eye-fill" data-target="password1"></i>

                            </div>

                            <!-- password2 -->
                            <div class="col mb-3">
                                <input id="confirm_password" name="pass2" type="password" class="form-control" placeholder="Confirm Password" aria-label="Phone number" value="<?= isset($password2) ? $password2 : "" ?>">
                                <span id="password2_error"></span>
                                <i class="open bi bi-eye-fill" data-target="confirm_password"></i>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <script src="./delete.js"></script>

    <script src="./registration-admin.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>