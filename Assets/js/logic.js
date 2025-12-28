function validate() {
    let email = document.querySelector('input[name="email"]').value;
    let password = document.querySelector('input[name="password"]').value;
    if (email === "" || password === "") {
        alert("All fields are required!");
        return false;
    }
    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailPattern)) {
        alert("Invalid email address!");
        return false;
    }
    if (password.length < 4) {
        alert("Password must be at least 4 characters!");
        return false;
    }
    return true;
}
