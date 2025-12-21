function validate() {
   
    let name = document.getElementById("fullName").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    let phone = document.getElementById("phone").value.trim();
    let profilePic = document.getElementById("profilePic")

    let nameError = document.getElementById("nameError");
    let emailError = document.getElementById("emailError");
    let passwordError = document.getElementById("passwordError");
    let confirmError = document.getElementById("confirmError");
    let phoneError = document.getElementById("phoneError");
    let profilePicError = document.getElementById("profilePicError")
    let successMsg = document.getElementById("success");

 
    nameError.innerHTML = "";
    emailError.innerHTML = "";
    passwordError.innerHTML = "";
    confirmError.innerHTML = "";
    phoneError.innerHTML = "";
    successMsg.innerHTML = "";

    if (name === "") {
        nameError.innerHTML = "Enter a Name";
        return false;
    } else if (!isNaN(name)) {
        nameError.innerHTML = "Name cannot be a number";
        return false;
    }

   
    if (email === "" || !email.includes("@") || !email.includes(".")) {
        emailError.innerHTML = "Enter a valid email (must contain @ and .)";
        return false;
    }

    if (phone === "" || isNaN(phone) || phone.length != 11) {
        phoneError.innerHTML = "Enter a valid 11-digit Phone Number";
        return false;
    }

  if (profilePic.files.length === 0) {
    profilePicError.innerHTML = "Please upload your profile picture";
    return false;
}


    if (password === "") {
        passwordError.innerHTML = "Enter a password";
        return false;
    }


    if (password !== confirmPassword) {
        confirmError.innerHTML = "Passwords must match";
        return false;
    }


    successMsg.innerHTML = "Registration Successful!";
    return true;
}
