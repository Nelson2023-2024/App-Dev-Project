const form = document.getElementById('form');
const firstNameInput = document.getElementById('fname_input');
const lastNameInput = document.getElementById('lname_input');
const emailInput = document.getElementById('email_input');
const phoneInput = document.getElementById('phone_input');
const maleRadio = document.getElementById('maleRadio');
const femaleRadio = document.getElementById('femaleRadio');
const otherRadio = document.getElementById('otherRadio');
const userLevel = document.getElementById('user_level');

//spanerrors
const fnameError = document.getElementById('fname_error');
const lnameError = document.getElementById('lname_error');
const emailError = document.getElementById('email_error');
const phoneError = document.getElementById('phone_error');
const genderError = document.getElementById('gender_error');
const userlevelError = document.getElementById('userlevel_error');

function clearErrors() {
    fnameError.innerHTML = "";
    lnameError.innerHTML = "";
    emailError.innerHTML = "";
    phoneError.innerHTML = "";
    genderError.innerHTML = "";
    userlevelError.innerHTML = "";
}

form.addEventListener('submit', e => {
    e.preventDefault();

    //clear existing error message
    clearErrors();

    //firstname validation
    if(firstNameInput.value === ""){
        fnameError.innerHTML = "Please enter your first name"
    }

    //lastname validation
    if(lastNameInput.value === ""){
        lnameError.innerHTML = "Please enter your last name"
    }

    //email validation
    if(emailInput.value === ""){
        emailError.innerHTML = "Please enter your email address";
    }

    //gender validation
    if(!maleRadio.checked && !femaleRadio.checked && !otherRadio.checked){
        genderError.innerHTML = "Please select a gender";
    }

    //userlevel validation
    if (userLevel.value !== "1" && userLevel.value !== "0") {
        userlevelError.innerHTML = "User level can only be 0(USER) or 1(ADMIN)";
    }
    


    //if everything is ok
    if (fnameError.innerHTML === "" && lnameError.innerHTML === "" && emailError.innerHTML === "" && genderError.innerHTML === "" && userlevelError.innerHTML === "") {
        form.submit();
    }
    


})