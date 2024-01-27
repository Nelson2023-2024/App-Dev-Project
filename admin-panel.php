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

    
<?php
try{
    // include connection
    require('./mysqli_connect.php');

    // $select_user_stmt = mysqli_stmt_init($dbcon);
    // $select_user_query = "SELECT * FROM users";
    // mysqli_stmt_prepare($select_user_stmt, $select_user_query);
    // if(mysqli_stmt_execute($select_user_stmt)){
    //     $result = mysqli_stmt_get_result($select_user_stmt);


    //     echo"<h1 class='text-center'>Registered users</h1>";
    //     echo '
        
    //     <table class="table table-striped">
    //     <tr>
    //     <th>ID</th>
    //     <th>First Name</th>
    //     <th>Last Name</th>
    //     <th>Email</th>
    //     <th>Phone Number</th>
    //     <th>Gender</th>
    //     <th>Registration Date</th>
    //     <th>User Level</th>
    //     <th>Edit</th>
    //     <th>Delete</th>
        
    //     </tr>
        
        
        
    //     ';

    //     while($row = mysqli_fetch_assoc($result)){
    //     echo "
    //     <tr>
    //     <td>$row[id]</td>
    //     <td>$row[first_name]</td>
    //     <td>$row[last_name]</td>
    //     <td>$row[email]</td>
    //     <td>$row[phone_number]</td>
    //     <td>$row[gender]</td>
    //     <td>$row[registration_date]</td>
    //     <td>$row[user_level]</td>
    //     <td><a href='edit.php?id=".$row['id']."'>Edit</a></td>
    //     <td><a href='delete.php?id=".$row['id']."'>Delete</a></td>
        
        
        
    //     </tr>
            
    //         ";

    //     }

    //     echo "</table>";
    // }

    




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
    $select_user_stmt = mysqli_stmt_init($dbcon);
    $select_user_query = "SELECT * FROM users";
    mysqli_stmt_prepare($select_user_stmt, $select_user_query);
    if(mysqli_stmt_execute($select_user_stmt)){
        $result = mysqli_stmt_get_result($select_user_stmt);
        while($row = mysqli_fetch_assoc($result)){
                echo "
                <tr>
                <td>$row[id]</td>
                <td>$row[first_name]</td>
                <td>$row[last_name]</td>
                <td>$row[email]</td>
                <td>$row[phone_number]</td>
                <td>$row[gender]</td>
                <td> <strong>".($row['user_level'] === 0 ? "USER" :"ADMIN" )."</strong></td>
                <td>$row[registration_date]</td>
                <td><a href='edit.php?id=".$row['id']."'>Edit</a></td>
                <td><a href='delete.php?id=".$row['id']."'>Delete</a></td>
                
                
                
                </tr>";
    }
}
    ?>
    
  </tbody>
</table>
</div>
</body>
</html>