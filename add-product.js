let form = document.getElementById('form')
let ProductTitle = document.getElementById('product-title');
let ProductImage = document.getElementById('product-image');
let ProductPrice = document.getElementById('product-price');
let ProductDescription = document.getElementById('product-description');

// errors
let ProductTitleError = document.getElementById('product-title-error');
let ProductImageError = document.getElementById('product-image-error');
let ProductPriceError = document.getElementById('product-price-error');
let ProductDescriptionError = document.getElementById('product-description-error');

form.addEventListener('submit', (e) => {

    e.preventDefault();
    clearErrors();

    if(ProductTitle.value.trim() === ''){
        ProductTitleError.innerHTML = "Please enter the product title"
    }

    if(ProductImage.value.trim() ===''){
        ProductImageError.innerHTML = 'Please select an image from you machine'
    }

    if(ProductPrice.value.trim() === ''){
        ProductPriceError.innerHTML = "Please enter a price"
    }

    if(ProductDescription.value.trim() === ''){
        ProductDescriptionError.innerHTML = "Please enter the description "
    }

    if(ProductTitle.value.trim() !== '' &&
       ProductImage.value.trim() !== '' &&
       ProductPrice.value.trim() !== '' &&
       ProductDescription.value.trim() !==''
       ){
    
        form.submit();
    }

    function clearErrors(){
        ProductTitleError.innerHTML = ''
        ProductImageError.innerHTML = ''
        ProductPriceError.innerHTML = ''
        ProductDescriptionError.innerHTML = ''
    }
})



