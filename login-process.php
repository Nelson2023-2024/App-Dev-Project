<?php
try{
    if($_SERVER['REQUEST_METHOD'] === "POST"){

        //connection to db
        require './mysqli_connect.php';
       // var_dump($_POST);
    
    
        //array
        $errors = [];
    
    
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    
        //email validation
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($errors, "Invalid email format");
        }
    
        if(empty($errors)){
            $select_email_stmt = mysqli_stmt_init($dbcon);
            $select_email_query = "SELECT * FROM users WHERE email=?";
            mysqli_stmt_prepare($select_email_stmt, $select_email_query);
            mysqli_stmt_bind_param($select_email_stmt,'s',$email);
            mysqli_stmt_execute($select_email_stmt);

            $result = mysqli_stmt_get_result($select_email_stmt);

            if($result){
                $row = mysqli_fetch_assoc($result);
                var_dump($row);
                //no result found
                if(empty($row)){
                    array_push($errors, "The email/password you entered did not match our records");

                }
                //result is found
                else{
                    //verify password match
                   $password_verify = password_verify($password, $row['password']);

                   if($password_verify){
                    header("Location: mysqli_connect.php");

                   }

                   else array_push($errors, "The email you entered did not match ou records");
                }

            }
            
    
        }
    
        
        foreach($errors as $error){
            echo'<div style="font-size:13px; min-height:20px; display:flex; align-items:center;" class="alert alert-danger" role="alert"> <strong>'.$error.'</strong></div>';
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