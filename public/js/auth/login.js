const login_btn = document.querySelector("#login-btn");
const register_btn = document.querySelector("#register-btn");
const container_login = document.querySelector(".container-login");

login_btn.addEventListener("click", () => {
  container_login.classList.add("register-mode");
});

register_btn.addEventListener("click", () => {
  container_login.classList.remove("register-mode");
});
 