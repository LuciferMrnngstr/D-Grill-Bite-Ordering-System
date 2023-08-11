const nameForm = document.querySelector('.login-reg .signup-name #name-form'),
    firstName = document.querySelector('.login-reg .signup-name form #first-name'),
    middleName = document.querySelector('.login-reg .signup-name form #middle-name'),
    lastName = document.querySelector('.login-reg .signup-name form #last-name');

nameForm.onsubmit = function (e) {
    if (validateInputsName()) { //if form condition satisfied, proceed
        return true;
    }
    e.preventDefault();
}

const validateInputsName = () => { //main validation function
    const firstNameValue = firstName.value.trim(),
        middleNameValue = middleName.value.trim(),
        lastNameValue = lastName.value.trim();

    validateFirstName(firstNameValue);
    validateMiddleName(middleNameValue);
    validateLastName(lastNameValue);

    if (validateFirstName(firstNameValue) && validateMiddleName(middleNameValue) && validateLastName(lastNameValue)) {
        return true;
    }
    return false;
}

const validateFirstName = (value) => {
    if (value === '') {
        setError(firstName.parentElement);
        return false;
    }
    setSuccess(firstName.parentElement);
    return true;
}

const validateMiddleName = (value) => {
    if (value.length == 0) {
        setSuccess(middleName.parentElement);
        return true;
    }
    else if (value.length > 2) {
        setSuccess(middleName.parentElement);
        return true;
    }
    setError(middleName.parentElement);
    return false;
}

const validateLastName = (value) => {
    if (value === '') {
        setError(lastName.parentElement);
        return false;
    }
    setSuccess(lastName.parentElement);
    return true;
}

const setError = (element) => {
    element.classList.add('error');
}

const setSuccess = (element) => {
    element.classList.add('success');
    element.classList.remove('error');
}

// FOR INFO-REG
const backBtn = document.querySelector('.signup-info .button .back-btn');

backBtn.onclick = () => {
    nameForm.parentElement.classList.add('active');
    backBtn.parentElement.parentElement.parentElement.classList.remove('active');
}

const infoForm = document.querySelector('.login-reg .signup-info #info-form'),
    email = document.querySelector('.login-reg .signup-info form #email'),
    contactNum = document.querySelector('.login-reg .signup-info form #contact-num'),
    password = document.querySelector('.login-reg .signup-info form #password'),
    confirmPass = document.querySelector('.login-reg .signup-info form #confirm-pass'),
    togglePass = document.querySelector('.login-reg .signup-info form .toggle');

infoForm.onsubmit = function (e) {
    if (validateInputsInfo()) {
        return true;
    }
    e.preventDefault();
}

const validateInputsInfo = () => {
    const emailValue = email.value.trim(),
        contactNumValue = contactNum.value.trim(),
        passwordValue = password.value.trim(),
        confirmPassValue = confirmPass.value.trim();

    validateEmail(emailValue);
    validateContact(contactNumValue);
    validatePass(passwordValue);
    validateConfirmPass(confirmPassValue, passwordValue);

    if (validateEmail(emailValue) && validateContact(contactNumValue) && validatePass(passwordValue) && validateConfirmPass(confirmPassValue, passwordValue)) {
        return true;
    }
    return false;
}

const validateEmail = (value) => {
    const validRegex = /^[a-zA-Z0-9.'_-]+@wmsu.edu.ph/;
    if (value.match(validRegex)) {
        setSuccess(email.parentElement);
        return true;
    }
    setError(email.parentElement);
    return false;
}

const validateContact = (value) => {
    const validRegex = /09+[0-9]/;
    if (value.match(validRegex) && value.length == 11) {
        setSuccess(contactNum.parentElement);
        return true;
    }
    setError(contactNum.parentElement);
    return false;
}

const validatePass = (value) => {
    if (value.length < 8) {
        setError(password.parentElement);
        togglePass.style.top = "55%";
        return false;
    }
    setSuccess(password.parentElement);
    togglePass.style.top = "70%";
    return true;
}

const validateConfirmPass = (value, passwordValue) => {
    if (value !== passwordValue || value === '') {
        setError(confirmPass.parentElement);
        return false;
    }
    setSuccess(confirmPass.parentElement);
    return true;
}