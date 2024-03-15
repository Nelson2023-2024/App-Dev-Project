<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">

    <!-- titan -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <style>
        body {
            height: 100vh;

        }

        span {
            color: red;
            font-size: 13px;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <?php include("./navbar.php") ?>

    </div>
    <div class="container" style="">


        <?php
        require('./mysqli_connect.php');
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $errors = [];

            $product_title = $_POST['product-title'];
            $product_image = $_FILES['product-image']['name'];
            $product_price = $_POST['product-price'];
            $product_description = $_POST['product-description'];

            //new filename
            $unique_id = uniqid();

            $new_filename = $unique_id . $product_image;

            move_uploaded_file($_FILES['product-image']['tmp_name'], './Uploads/' . $new_filename);

            // echo $new_filename . "<br>";

            // var_dump($_POST);
            // echo "<pre>";
            // var_dump($_FILES);
            // echo "</pre>";


            if (!empty($product_title) || !empty($product_image) || !empty($product_price) || !empty($product_description)) {

                $insert_stmt = mysqli_stmt_init($dbcon);
                $insert_query = "INSERT INTO categories (product_title, product_image, product_price, product_description) VALUES(?,?,?,?)";
                mysqli_stmt_prepare($insert_stmt, $insert_query);
                mysqli_stmt_bind_param($insert_stmt, 'ssss', $product_title, $new_filename, $product_price, $product_description);

                $result = mysqli_stmt_execute($insert_stmt);
            } else {
                array_push($errors, "All fields are required");
            }
        } else {
            // echo "GET";
        }


        ?>
        <!-- Content -->

        <?php include('./add-products_modal.php') ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product Title</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Price</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td><a href="">Edit</a></td>
                    <td><a href="">Delete</a></td>
                </tr>
                
            </tbody>
        </table>

    </div>


    <script src="add-product.js"></script>
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>

</html>