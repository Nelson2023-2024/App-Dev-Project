let form = document.getElementById('form')
let ProductTitle = document.getElementById('product-title');
let ProductPrice = document.getElementById('product-price');
let ProductDescription = document.getElementById('product-description');

// errors
let ProductTitleError = document.getElementById('product-title-error');
let ProductPriceError = document.getElementById('product-price-error');
let ProductDescriptionError = document.getElementById('product-description-error');

form.addEventListener('submit', (e) => {

    e.preventDefault();
    clearErrors();

    if(ProductTitle.value.trim() === ''){
        ProductTitleError.innerHTML = "Please enter the product title"
    }

    

    if(ProductPrice.value.trim() === ''){
        ProductPriceError.innerHTML = "Please enter a price"
    }

    if(ProductDescription.value.trim() === ''){
        ProductDescriptionError.innerHTML = "Please enter the description "
    }

    if(ProductTitle.value.trim() !== '' &&
       ProductPrice.value.trim() !== '' &&
       ProductDescription.value.trim() !==''
       ){
    
        form.submit();
    }

    function clearErrors(){
        ProductTitleError.innerHTML = ''
        ProductPriceError.innerHTML = ''
        ProductDescriptionError.innerHTML = ''
    }
})



