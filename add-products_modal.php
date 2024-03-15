<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
    + New Course
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class=" " style="max-width: 600px;" id="form" enctype="multipart/form-data"> 
                    <h1 class="text-center">Add New Course</h1>

                    <div class="row g-3 mb-2">
                        <div class="">
                            <input type="text" class="form-control" placeholder="Product Title" id="product-title" name="product-title">
                            <span id="product-title-error"></span>
                        </div>

                    </div>

                    <div class=" mb-2">
                        <input type="file" class="form-control" id="product-image" name="product-image">
                        <span id="product-image-error"></span>

                    </div>

                    <div class="row g-3 mb-2">
                        <div class="">
                            <input type="text" class="form-control" placeholder="Price" id="product-price" name="product-price">
                            <span id="product-price-error"></span>

                        </div>
                    </div>

                    <div class=" mb-3">
                        <textarea style="width: 100%;" class="form-control" name="product-description" id="product-description" cols="10" rows="5" placeholder=" Description"></textarea>
                        <span id="product-description-error"></span>

                    </div>

                    <button style="width: 100%; height: 40px;" class="btn btn-primary">Add New Product</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>