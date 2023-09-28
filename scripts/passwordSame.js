document.addEventListener("DOMContentLoaded", function() {
    const passwordField = document.getElementById("password");
    const confirmPasswordField = document.getElementById("confirmPassword");
    const passwordError = document.getElementById("passwordError");
    const registerButton = document.getElementById("registerButton");

    confirmPasswordField.addEventListener("input", () => {
        const password = passwordField.value;
        const confirmPassword = confirmPasswordField.value;

        if (password === confirmPassword) {
            passwordError.textContent = "";
            registerButton.disabled = false;
        } else {
            passwordError.textContent = "Passwords do not match.";
            registerButton.disabled = true;
        }
    });
});