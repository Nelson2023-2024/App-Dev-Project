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

    <style>
        body{
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        span{
            color: red;
            font-size: 13px;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <form action="" class="mx-auto border  py-5 px-2" style="width: 600px;" id="form">
            <h1 class="text-center">Add New Product FrontEnd</h1>

            <div class="row g-3 mb-2">
                <div class="">
                    <input type="text" class="form-control" placeholder="Product Title" id="product-title">
                    <span id="product-title-error"></span>
                </div>

            </div>

            <div class=" mb-2" >
                <input type="file" class="form-control" id="product-image" >
                <span id="product-image-error"></span>
                
            </div>

            <div class="row g-3 mb-2">
                <div class="">
                    <input type="text" class="form-control" placeholder="Price" id="product-price" >
                    <span id="product-price-error"></span>

                </div>
            </div>

            <div class=" mb-3">
                <textarea style="width: 100%;" class="form-control" name="" id="product-description" cols="10" rows="5" placeholder=" Description"></textarea>
                <span id="product-description-error"></span>

            </div>

            <button style="width: 100%; height: 40px;" class="btn btn-primary">Add New Product</button>

        </form>
    </div>


    <script src="add-product.js"></script>
</body>

</html>