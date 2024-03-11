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
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- titan -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Titan+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">

    <title>Edit</title>

    <style>
    form {
        max-width: 600px;
    }
    span{
        color: red;
        font-size: 13px;
    }
    </style>
</head>

<body>

    <div class="container">
    <?php include('./navbar.php')?>


        <a style="font-size: 2rem;" href="./admin-panel.php"><i class="bi bi-house"></i>
            home
        </a>

        <h3 class="text-center">Current details</h3>
        <table class="table table-striped mt-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>User Level</th>
                    <th>Registration Date</th>
                </tr>
            </thead>

            <?php
try{
    require("./mysqli_connect.php");

    if($_SERVER['REQUEST_METHOD'] === "GET"){
    
        $id = $_GET['id'];

        $select_user_stmt = mysqli_stmt_init($dbcon);
        $select_user_query = "SELECT * FROM users WHERE id = ?";
        mysqli_stmt_prepare($select_user_stmt, $select_user_query);
        mysqli_stmt_bind_param($select_user_stmt, 'i', $id );
        mysqli_stmt_execute($select_user_stmt);

        $result =  mysqli_stmt_get_result($select_user_stmt);

        if($result){
            $row = mysqli_fetch_assoc($result);

            echo "
            <tr>
            <td>$row[id]</td>
            <td>$row[first_name]</td>
            <td>$row[last_name]</td>
            <td>$row[email]</td>
            <td>$row[phone_number]</td>
            <td>$row[gender]</td>
            <td><strong>".($row['user_level'] === 0 ? "USER" : "ADMIN")."</strong></td>
            <td>$row[registration_date]</td>
            
            
            </tr>
            ";

            echo"</table>
            ";
            

        }

        
    
    }
    //POST METHOD
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $id = $_POST['id'];
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $phone_number = trim($_POST['phone_number']);
        $gender = trim($_POST['gender']);
        $user_level = trim($_POST['user_level']);

        var_dump($_POST);

        $update_user_stmt = mysqli_stmt_init($dbcon);
        $update_user_query = "UPDATE users SET first_name = ?, last_name = ?, email=?, phone_number=?, gender=?, user_level=? WHERE id=? ";
        mysqli_stmt_prepare($update_user_stmt, $update_user_query);
        // Bind parameters for the update query
        mysqli_stmt_bind_param($update_user_stmt, 'sssssii', $first_name, $last_name, $email, $phone_number, $gender, $user_level, $id);
        if(mysqli_stmt_execute($update_user_stmt)){
            if(mysqli_stmt_affected_rows($update_user_stmt) > 0) {
                echo "<script>alert('SUCCESSFULLY UPDATED'); window.location.href = 'admin-panel.php';</script>";
            } else {
                echo "No rows were affected by the update.";
            }
        }
        else {
            // Display error message if the update query fails
            echo "Error updating record: " . mysqli_error($dbcon);
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

            <h1 class="text-center mt-3">Update </h1>
            <form action="" id="form" method="post" class="mx-auto">

            <!-- hidden id field -->

            <input type="hidden" name="id" value="<?php echo $row['id']?>">

                <!-- names -->
                <div class="row mb-2">
                    <div class="col">
                        <input type="text" id="fname_input" class="form-control" placeholder="First name" name="first_name" value="<?php echo $row['first_name']; ?>" >
                        <span id="fname_error"></span>
                    </div>
                    <div class="col">
                        <input type="text" id="lname_input" class="form-control" placeholder="Last name" name="last_name" value="<?php echo $row['last_name']; ?>">
                        <span id="lname_error"></span>

                    </div>

                </div>

                <!-- Email -->
                <div class="row mb-2">
                <div class="col">
                        <input type="text" id="email_input" class="form-control" placeholder="Email" name="email" value="<?php echo $row['email']; ?>">
                        <span id="email_error"></span>

                    </div>
                </div>

                <!-- phone number -->
                <div class="row mb-2">
                <div class="col">
                        <input type="text"id="phone_input"  class="form-control" placeholder="Phone Number" name="phone_number" value="<?php echo $row['phone_number']; ?>">
                        <span id="phone_error"></span>

                    </div>
                </div>

                <!-- gender -->
                <div class="row mb-3">
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="male"
                        <?php if ($row['gender'] === 'male') echo 'checked'; ?>>
                        <label class="form-check-label" for="maleRadio">
                            Male
                        </label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="female" 
                        <?php if ($row['gender'] === 'female') echo 'checked'; ?>>
                        <label class="form-check-label" for="femaleRadio">
                            Female
                        </label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="otherRadio" value="other"
                        <?php if ($row['gender'] === 'other') echo 'checked'; ?>>
                        <label class="form-check-label" for="otherRadio">
                            others
                        </label>
                    </div>
                </div>
                <span id="gender_error"></span>
            </div>

            <!-- user level -->
            <div class="row mb-2">
                <div class="col">
                        <input type="number" id="user_level" class="form-control" placeholder="User level" name="user_level" 
                        value="<?php echo $row['user_level']; ?>">
                        <span id="userlevel_error"></span>
                        <p style="color: gray; font-size: 12px;">Note 0(USER) and 1(ADMIN)</p>

                </div>
            </div>

            <!-- submit button -->
            <div class="row mb-2">
                <div class="col">
                <button style="width: 100%;" type="submit" class="btn btn-success">update</button>
                </div>
            </div>


            </form>
    </div>

    <script src="./edit.js"></script>
</body>

</html>