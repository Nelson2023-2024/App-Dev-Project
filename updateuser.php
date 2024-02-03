<?php
try{
    //connection
    require('./mysqli_connect.php');

    session_start();
    var_dump($_SESSION);
    
    if($_SESSION['user_level'] !== 0 || !isset($_SESSION['user_level'])){
        header("Location: location.php");
        exit();
    }
    //if user level is == 0
    else{
        $errors = [];
        $id = $_SESSION['id'];



        var_dump($_POST);

        $first_name = isset($_POST['fname']) ? $_POST['fname'] : '';
        $last_name = isset($_POST['lname']) ? $_POST['lname'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        

        // if(empty($first_name)){
        //     array_push($errors, "Please enter your first name");
        // }

        // if(empty($last_name)){
        //     array_push($errors, "Please enter your last name");
        // }

        // if(empty($email)){
        //     array_push($errors, "Please enter your Email");
        // }

        // if(empty($phone_number)){
        //     array_push($errors, "Please enter your Phone Number");
        // }

        // if(empty($gender)){
        //     array_push($errors, "Please enter your Gender");
        // }

        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";

        //select query

        
        $select_stmt = mysqli_stmt_init($dbcon);
        $select_query = "SELECT * FROM users WHERE id = ?";
        mysqli_stmt_prepare($select_stmt, $select_query);
        mysqli_stmt_bind_param($select_stmt, 'i', $id);
        mysqli_stmt_execute($select_stmt);

        $result = mysqli_stmt_get_result($select_stmt);

        $row = mysqli_fetch_assoc($result);
        var_dump($row);


        // Update Query
if (empty($errors)) {
    $update_stmt = mysqli_stmt_init($dbcon);
    $update_query = "UPDATE users SET first_name = ?, last_name = ?, email = ?, phone_number = ?, gender = ? WHERE id = ?";
    
    mysqli_stmt_prepare($update_stmt, $update_query);
    mysqli_stmt_bind_param($update_stmt, 'sssssi', $first_name, $last_name, $email, $phone_number, $gender, $id);
    
    if (mysqli_stmt_execute($update_stmt)) {
        // Successful update
        echo "Profile updated successfully!";
        // Redirect to a success page or refresh the current page
         header("Location: memberspage.php");
        // exit();
    } else {
        // Error in updating
        echo "Error updating profile: " . mysqli_error($dbcon);
    }

    mysqli_stmt_close($update_stmt);
}



    }
}
//database exception
catch (mysqli_sql_exception $e){
    echo "Database Exception".$e->getMessage();

}
//general exception
catch (Exception $e){
    echo "General Exception".$e->getMessage();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Update-Profile</title>

    <style>
         body{  
            height: 100vh;
        }
        form{
            max-width: 550px;
            padding-block: 1rem;
            padding-inline: .6rem;
            box-shadow: 0px 0px 20px black;
            border-radius: 10px;
        }
        span{
            color:red;
            font-size:13.5px;
        }
        p{
            font-size: 13.5px;
            margin-bottom: 2px;
            font-weight: bold;
        }

    </style>
</head>

<body>

<div class="container mb-5">
    <h1 class="text-center">Current Details</h1>

    <table class='table table-striped'>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Gender</th>
        </tr>
<?php
    echo "
    
    <tr>
    <th>$row[first_name]</th>
    <th>$row[last_name]</th>
    <th>$row[email]</th>
    <th>$row[phone_number]</th>
    <th>$row[gender]</th>
</tr>
    ";
    
    
    ?>
        </table>

</div>
    <div class="container">

    

    
        
        <form action="" class="mx-auto" method="POST">
            <?php
            foreach($errors as $error){
                echo "<div class='alert alert-danger'>$error</div>";
            }
            ?>
            <h1 class="text-center">Update Your Profile</h1>
            <!-- Name -->
            <div class="row mb-3">
                <div class="col">
                    <input  name="fname" type="text" class="form-control" placeholder="First name" value="<?php echo "$row[first_name]" ?>">
                </div>
                <div class="col">
                    <input name="lname" type="text" class="form-control" placeholder="Last name" value="<?php echo "$row[last_name]" ?>">
                </div>
            </div>

            <!-- Email -->
            <div class="row mb-3">
                <div class="col">
                    <input name="email" type="text" class="form-control" placeholder="Email" value="<?php echo "$row[email]" ?>">
                </div>
            </div>

            <!-- Phone Number -->
            <div class="row mb-3">
                <div class="col">
                    <input name="phone_number" type="text" class="form-control" placeholder="Phone Number" value="<?php echo "$row[phone_number]" ?>">
                </div>
            </div>

            <!-- gender -->
            <div class="row mb-3">
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="male" required>
                        <label class="form-check-label" for="maleRadio">
                            Male
                        </label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="female" required>
                        <label class="form-check-label" for="femaleRadio">
                            Female
                        </label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="otherRadio" value="other" required>
                        <label class="form-check-label" for="otherRadio">
                            others
                        </label>
                    </div>
                </div>
                <span id="gender_error"></span>
            </div>

            <div class="row ">
            <button class="btn btn-success col-11 mx-auto">Update</button>

            </div>
</form> 
    </div>
</body>

</html>