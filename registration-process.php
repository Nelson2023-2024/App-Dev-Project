<?php
try{
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //conection
    require './mysqli_connect.php';
    var_dump($_POST);
    //array
    $errors=array();

    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $phone_no = $_POST['phoneNo'];
    $gender = $_POST['gender'];
    $password = $_POST['pass1'];

    //email validation
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors,"Invalid email format");
    }

    
    //duplicate email validation

    $duplicate_email_stmt = mysqli_stmt_init($dbcon);
    $duplicate_email_query = "SELECT email FROM users WHERE email=?";
    mysqli_stmt_prepare($duplicate_email_stmt, $duplicate_email_query);
    mysqli_stmt_bind_param($duplicate_email_stmt, 's', $email);
    if(mysqli_stmt_execute($duplicate_email_stmt)){
        $result = mysqli_stmt_get_result($duplicate_email_stmt);
        $row = mysqli_fetch_assoc($result);

        if($row){
            array_push($errors, "Email Already Exists");
        }
    }

    foreach($errors as $error){
        echo '<div class="alert alert-danger text-center" role="alert"><strong>'.$error.'</strong></div>';
    }
    //hashpassword
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    //if everything is ok and there are no errors
    if(empty($errors)){
        $insert_stmt = mysqli_stmt_init($dbcon);
        $insert_query = "INSERT INTO users (first_name, last_name, email, phone_number, gender, password) VALUES(?,?,?,?,?,?)";
        if(mysqli_stmt_prepare($insert_stmt, $insert_query)){
            mysqli_stmt_bind_param($insert_stmt, 'ssssss', $first_name, $last_name, $email, $phone_no, $gender, $password_hash);
            if(mysqli_stmt_execute($insert_stmt)){
                echo '
                <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Registred Succefully</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
            }
        }
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