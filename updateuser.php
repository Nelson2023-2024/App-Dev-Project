<?php
try{
    session_start();
    var_dump($_SESSION);
    
    if($_SESSION['user_level'] !==0 || !isset($_SESSION['user_level'])){
        header("Location: location.php");
        exit();
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
            display: flex;
            place-items: center;
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
    <div class="container">
        <form action="" class="mx-auto">
            <h1 class="text-center">Update Your Profile</h1>
            <!-- Name -->
            <div class="row mb-3">
                <div class="col">
                    <input name="fname" type="text" class="form-control" placeholder="First name">
                </div>
                <div class="col">
                    <input name="lname" type="text" class="form-control" placeholder="Last name">
                </div>
            </div>

            <!-- Email -->
            <div class="row mb-3">
                <div class="col">
                    <input name="email" type="text" class="form-control" placeholder="Email">
                </div>
            </div>

            <!-- Phone Number -->
            <div class="row mb-3">
                <div class="col">
                    <input name="phone_number" type="text" class="form-control" placeholder="Phone Number">
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

            <div class="row ">
            <button class="btn btn-success col-11 mx-auto">Update</button>

            </div>
</form> 
    </div>
</body>

</html>