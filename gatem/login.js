function createAccount() {
    // Implement your account creation logic here
    const username = document.getElementById('new-username').value;
    const password = document.getElementById('new-password').value;

    // Example: Simple validation (this should also be done on the server)
    if (username && password) {
        alert("Account created successfully!");
        // Redirect to the login page or automatically log the user in
        window.location.href = 'index.html'; // Change this to your actual login page URL
    } else {
        alert("Please fill in all fields.");
    }
}