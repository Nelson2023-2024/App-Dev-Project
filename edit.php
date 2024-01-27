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
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $phone_number = trim($_POST['phone_number']);
        $gender = trim($_POST['gender']);
        $user_level = trim($_POST['user_level']);

        $update_user_stmt = mysqli_stmt_init($dbcon);
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


                <!-- names -->
                <div class="row mb-2">
                    <div class="col">
                        <input type="text" id="fname_input" class="form-control" placeholder="First name" name="first_name" >
                        <span id="fname_error"></span>
                    </div>
                    <div class="col">
                        <input type="text" id="lname_input" class="form-control" placeholder="Last name" name="last_name">
                        <span id="lname_error"></span>

                    </div>

                </div>

                <!-- Email -->
                <div class="row mb-2">
                <div class="col">
                        <input type="text" id="email_input" class="form-control" placeholder="Email" name="email">
                        <span id="email_error"></span>

                    </div>
                </div>

                <!-- phone number -->
                <div class="row mb-2">
                <div class="col">
                        <input type="text"id="phone_input"  class="form-control" placeholder="Phone Number" name="phone_number">
                        <span id="phone_error"></span>

                    </div>
                </div>

                <!-- gender -->
                <div class="row mb-3">
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="male">
                        <label class="form-check-label" for="maleRadio">
                            Male
                        </label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="female">
                        <label class="form-check-label" for="femaleRadio">
                            Female
                        </label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="otherRadio" value="other">
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
                        <input type="number" id="user_level" class="form-control" placeholder="User level" name="user_level">
                        <span id="userlevel_error"></span>
                        <p style="color: gray; font-size: 12px;">Note 0(USER) and 1(ADMIN)</p>

                </div>
            </div>

            <!-- submit button -->
            <div class="row mb-2">
                <div class="col">
                <button style="width: 100%;" type="sumbit" class="btn btn-success">update</button>
                </div>
            </div>


            </form>
    </div>

    <script src="./edit.js"></script>
</body>

</html>