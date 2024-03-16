<?php
session_start();
//var_dump($_SESSION);

if ($_SESSION["user_level"] !== 1 || !isset($_SESSION["user_level"])) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

        span {
            color: red;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php include('./navbar.php') ?>


        <a style="font-size: 2rem;" href="./admin-panel.php"><i class="bi bi-house"></i>
            home
        </a>

        <h3 class="text-center">Current details</h3>


        <?php
        try {
            require("./mysqli_connect.php");

            $id = $_GET['id'];

            if ($_SERVER['REQUEST_METHOD'] === "GET") {


                $select_user_stmt = mysqli_stmt_init($dbcon);
                $select_user_query = "SELECT * FROM categories WHERE id = ?";
                mysqli_stmt_prepare($select_user_stmt, $select_user_query);
                mysqli_stmt_bind_param($select_user_stmt, 'i', $id);
                mysqli_stmt_execute($select_user_stmt);

                $result =  mysqli_stmt_get_result($select_user_stmt);

                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    //var_dump($row);
                }
            }
            //POST METHOD
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                
               var_dump($_POST);
               $product_title = $_POST['product-title'];
               $product_price = $_POST['product-price'];
               $product_description = $_POST['product-description'];

            //    If all the input firlds are filled
               if(!empty( $product_title) && !empty($product_price) && !empty($product_description)){
                $update_stmt = mysqli_stmt_init($dbcon);
                $update_query = "UPDATE categories SET product_title = ?, product_price = ?, product_description = ? WHERE id = ?";
                mysqli_stmt_prepare($update_stmt, $update_query);
                mysqli_stmt_bind_param($update_stmt,'sssi',$product_title, $product_price, $product_description, $id);
                $res = mysqli_stmt_execute($update_stmt);
                if($res){
                    if(mysqli_stmt_affected_rows($update_stmt) > 0){
                        echo "<script> alert('Updated Succefully')
                        window.location.href = 'add-products.php';
                        
                        
                        </script>";
                    }
                    //No affected row
                    else{
                        echo "<script> alert('No affected rows')</script>";
    
                    }
                }
                else{
                    echo "<script> alert('Failed to execute the Update query')</script>";

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

        <h1 class="text-center mt-3">Update </h1>
        <form action="" id="form" method="post" class="mx-auto">

            <!-- hidden id field -->

            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

            <div class="row g-3 mb-2">
                <div class="">
                    <input type="text" class="form-control" placeholder="Product Title" id="product-title" name="product-title" value="<?= isset($row['product_title']) ? $row['product_title'] : ''?>">
                    <span id="product-title-error"></span>
                </div>

            </div>

            <!-- <div class=" mb-2">
                <input type="file" class="form-control" id="product-image" name="product-image" value="<?= isset($row['product_image']) ? $row['product_image'] : ''?>">
                <span id="product-image-error"></span>

            </div> -->

            <div class="row g-3 mb-2">
                <div class="">
                    <input type="text" class="form-control" placeholder="Price" id="product-price" name="product-price" value="<?= isset($row['product_price']) ? $row['product_price'] : ''?>">
                    <span id="product-price-error"></span>

                </div>
            </div>

            <div class=" mb-3">
                <textarea style="width: 100%;" class="form-control" name="product-description" id="product-description" cols="10" rows="5" placeholder=" Description" ><?= isset($row['product_description']) ? $row['product_description'] : ''?></textarea>
                <span id="product-description-error"></span>

            </div>


            <!-- submit button -->
            <div class="row mb-2">
                <div class="col">
                    <button style="width: 100%;" type="submit" class="btn btn-success">update</button>
                </div>
            </div>


        </form>
    </div>

    
    <script src="./edit-products.js"></script>
</body>

</html>