const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

const form = document.getElementById("registration-form");

form.addEventListener("submit", (event) => {
    event.preventDefault();

    const selectBox = document.getElementById("account-type");
    const selectedValue = selectBox.value;

    if (selectedValue === "pembeli") {
        window.location.href = "pembeli/index.html";
    } else if (selectedValue === "penjual") {
        window.location.href = "penjual/index.html";
    } else if (selectedValue === "admin") {
        window.location.href = "admin/index.html";
    }
});