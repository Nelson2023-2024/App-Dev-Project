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
                                        $res = mysqli_stmt_execute($insert_stmt);

                                        if ($res) {
                                            echo '<script>alert("Inserted succefully")</script>';
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