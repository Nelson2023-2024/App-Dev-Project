const form = document.getElementById('form');
const firstName = document.getElementById('first_name');
const lastName = document.getElementById('last_name');
const email = document.getElementById('email');
const phoneNumber = document.getElementById('phone');
const maleRadio = document.getElementById('maleRadio')
const femaleRadio = document.getElementById('femaleRadio')
const otherRadio = document.getElementById('otherRadio');

const password1 = document.getElementById('password1');
const passwordConfirm = document.getElementById('confirm_password');


const firstError = document.getElementById('first_error');
const lastError = document.getElementById('last_error');
const emailError = document.getElementById('email_error');
const phoneError = document.getElementById('phone_error');
const genderError = document.getElementById('gender_error');
const password1Error = document.getElementById('password1_error');
const password2Error = document.getElementById('password2_error');




form.addEventListener('submit', (e) => {
      e.preventDefault();

      clearErrors();

    //last name validation
if(lastName.value.trim() === ""){
    lastError.innerHTML = "Please fill in your last name"
}
else lastError.innerHTML = ""


//first name validation
if(firstName.value.trim() === ""){
    firstError.innerHTML = "Please fill in your first name"
}
else firstError.innerHTML = ""


// email validation
if(email.value.trim() === ""){
    emailError.innerHTML = "Please fill in your email"
}
else emailError.innerHTML = ""


//phone validation
if(phoneNumber.value.trim() === ""){
    phoneError.innerHTML = "please fill in your phone number"
}
else phoneError.innerHTML = ""

//gender validation
if(!maleRadio.checked && !femaleRadio.checked && !otherRadio.checked){
    genderError.innerHTML = "Please enter your gender"
}
else genderError.innerHTML = ""


//password validation

if(password1.value.trim() !=="" ){
    password1Error.innerHTML = ""
    if (password1.value.trim().length < 8) {
        password1Error.innerHTML = "Password must be at least 8 characters long";
    }
    if(password1.value !== passwordConfirm.value){
        password2Error.innerHTML = "Your passwords did not match"
    }
    else password2Error.innerHTML = ""

}
else password1Error.innerHTML = "Please enter your password"

if (lastName.value !== "" &&
    firstName.value !== "" &&
    email.value !== "" &&
    phoneNumber.value !== "" &&
    (maleRadio.checked || femaleRadio.checked || otherRadio.checked) &&
    password1.value !== "" &&
    password1.value.trim().length >= 8 &&
    password1.value === passwordConfirm.value
) {
    // All fields are filled, allow form submission
    form.submit();
}


})

function clearErrors() {
    lastError.innerHTML = "";
    firstError.innerHTML = "";
    emailError.innerHTML = "";
    phoneError.innerHTML = "";
    password1Error.innerHTML = "";
    password2Error.innerHTML = "";
    genderError.innerHTML = "";
}








