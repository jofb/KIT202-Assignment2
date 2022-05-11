const form = document.forms['register-login-form'];
const registerBtn = form.registerButton;

if(form) {
    form.onsubmit = validateLogin;
}

//For error handling
function errorMessage(msg) {
    document.querySelector(".error-message").textContent = msg;
}

//Change login form to register form
registerBtn.addEventListener('click', event => {
    errorMessage('');
    
    //Update form contents to register form
    document.querySelector(".form-title").innerHTML = "Register"; 
    document.title = "Register";


    document.querySelector(".password-policy").hidden = false;
    form.email.hidden = false;
    form.confirmPassword.hidden = false;

    form.username.value = '';
    form.password.value = '';

    registerBtn.hidden = true;
    form.submit.value = 'Register';

    //Change validation to registration
    form.onsubmit = validateRegister;
});

//Login Validation
//Returns true only if both a password and username are entered
//Upon validation returns to home page
function validateLogin(e) {
    //e.preventDefault();
    console.log('login validation');
    if(!form.username.value) {
        errorMessage('Please enter your username');
    }
    else if (!form.password.value) {
        errorMessage('Please enter your password');
    }
    else {
        errorMessage('');
        console.log('successful validation');
        //location.href="index.php";
        return true;
    }
    return false;
}

//Register validation
//Returns true only if everything is entered, and email and password are valid by 
//the following regex:
//Password regex: ^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~]).{8,}$
//Email regex: ^(\w+@.+[A-Za-z]+\.[A-Za-z]+)$

// special characters allowed : 
// !"#$%&'()*+,-.:;<=>?@[\]^_`{|}~
// https://owasp.org/www-community/password-special-characters

//Upon validation, returns to home page

function validateRegister(e) {
    e.preventDefault();
    console.log(form.email.value);

    const emailRegex = /^(\w+@.+[A-Za-z]+\.[A-Za-z]+)$/;
    const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~]).{8,}$/;

    if(form.email.value.length == 0) {
        errorMessage('Please enter an email');
    }
    else if(form.email.value.search(emailRegex) != 0) {
        errorMessage('Please enter a valid email');
    }
    else if(!form.username.value) {
        errorMessage('Please enter your username');
    }
    else if (!form.password.value || !form.confirmPassword.value) {
        errorMessage('Please enter your password');
    }
    else if(form.password.value != form.confirmPassword.value) {
        errorMessage('Passwords don\'t match');
    }
    else if(form.password.value.search(passwordRegex) != 0) {
        // errorMessage('Please enter a valid password (Refer to About Page)');
        document.querySelector(".error-message").innerHTML = 'Please enter a valid password';
    }
    else {
        errorMessage('');
        console.log('successful validation');
        //location.href="index.php";
        return true;
    }
    return false;
}


