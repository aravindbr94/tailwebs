const passwordField = document.getElementById("password");
const togglePassword = document.querySelector(".password-toggle-icon");

togglePassword.addEventListener("click", function () {
  if (passwordField.type === "password") {
    passwordField.type = "text";
    togglePassword.classList.remove("lnr-eye");
    togglePassword.classList.add("lnr-lock");
  } else {
    passwordField.type = "password";
    togglePassword.classList.remove("lnr-lock");
    togglePassword.classList.add("lnr-eye");
  }
});
		