function redirectToCreateAccount() {
    // Redirect to the create account page
    window.location.href = 'createaccount.html'; // Change this to your actual create account URL
}

function login() {
    // Implement your login logic here
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Example: Validate the user (this should be done on the server)
    if (username === "admin" && password === "password") {
        alert("Login successful!");
        // Redirect to the dashboard or home page
        window.location.href = 'dashboard.html'; // Change this to your actual dashboard URL
    } else {
        alert("Invalid username or password.");
    }
}