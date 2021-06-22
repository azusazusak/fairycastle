const Validator = function (element) {
    const validator = this;
    validator.form = document.querySelector(element);
    validator.requiredFields = validator.form.querySelectorAll(".required");
    validator.password = document.getElementById("password");
    validator.confirmPassword = document.getElementById("confirmPassword");


    validator.validateForm = function () {
        validator.requiredFields.forEach(function (fieldSet) {

            let textField = fieldSet.querySelector("input[type='text'], input[type = 'email'], input[type = 'password'], input[type='number'], input[type='date'], input[type='time'], input[type='url'], select, textarea");
            //collect required fields except radio button fields

            let radioFields = fieldSet.querySelectorAll("input[type='radio']");
            //collect required radio button fields

            if (textField) {
                validator.checkTextField(fieldSet, textField);
            } else if (radioFields) {
                validator.checkRadioFields(fieldSet, radioFields);
            } 
            //If required fields are found, activate each checking function.
        })
    }

    validator.checkTextField = function (fieldSet, textField) {
        //If required fields (except radio) are blank, add class name "error", else remove "error"
        if (textField.value == "") {
            fieldSet.classList.add("error");
            console.log("added error");
        } else {
            fieldSet.classList.remove("error");
            console.log("removed error");
        }
    }

    validator.checkRadioFields = function (fieldSet, radioFields) {
        //If a required radio button is not checked, add class name "error", else remove it
        let oneChecked = false;
        fieldSet.classList.remove("error");

        radioFields.forEach(function (oneRadioField) {
            if (oneRadioField.checked) {
                oneChecked = true;
            }
        })

        if (!oneChecked) {
            fieldSet.classList.add("error");
        }
    }
    
    if (validator.confirmPassword){
        //If there is a confirm password field, start check
        validator.confirmPassword.addEventListener("keyup", function (e) {
            // compare the password and the confirm password.
            // if the passwords are unmatched, add class name "unmatched", else remove it
            let password = validator.password.value;
            let confirmPassword = validator.confirmPassword.value;

            if ((password != confirmPassword) || (password == "")) {
                validator.password.classList.add("unmatched");
                validator.confirmPassword.classList.add("unmatched");

            } else {
                validator.password.classList.remove("unmatched");
                validator.confirmPassword.classList.remove("unmatched");
            }
        })
    }

    validator.form.addEventListener("submit", function (e) {
        //when the submit button is clicked, the validation starts
        validator.validateForm();

        let isError = validator.form.querySelector(".error");
        let isUnmatched = validator.form.querySelector(".unmatched");

        if (isError || isUnmatched) {
            e.preventDefault();
        } 
    })
}

new Validator("form");






