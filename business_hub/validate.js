function validateSignup() {
    let username = document.forms["signupForm"]["username"].value;
    let email = document.forms["signupForm"]["email"].value;
    let password = document.forms["signupForm"]["password"].value;

    if (username.length < 3) {
        alert("Username must be at least 3 characters");
        return false;
    }

    if (!email.includes("@")) {
        alert("Enter a valid email");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters");
        return false;
    }

    return true;
}

function validateLogin() {
    let email = document.forms["loginForm"]["email"].value;
    let password = document.forms["loginForm"]["password"].value;

    if (email === "" || password === "") {
        alert("All fields are required");
        return false;
    }

    return true;
}