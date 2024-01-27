<?php
try{
    require("./mysqli_connect.php");
    if($_SERVER['REQUEST_METHOD'] === "GET"){
    
        $id = $_GET['id'];
    
        echo $id;

        $delete_user_stmt = mysqli_stmt_init($dbcon);
        $delete_user_query = "DELETE FROM users WHERE id=?";
        mysqli_stmt_prepare($delete_user_stmt, $delete_user_query);
        mysqli_stmt_bind_param($delete_user_stmt,'i', $id);
        if(mysqli_stmt_execute($delete_user_stmt)){
            echo "<script>alert('RECORD DELETED'); window.location.href='admin-panel.php';</script>";
        }
        else{
            echo "Error executing delete query". mysqli_error($dbcon);
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