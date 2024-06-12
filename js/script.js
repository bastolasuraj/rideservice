document.addEventListener("DOMContentLoaded", () => {
    const currentDate = new Date().toLocaleDateString();
    document.getElementById("currentDate").textContent = currentDate;

    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    const rideForm = document.getElementById("rideForm");
    const rideTable = document.getElementById("rideTable");

    const loginBtn = document.getElementById("loginBtn");
    const logoutBtn = document.getElementById("logoutBtn");
    const registerBtn = document.getElementById("registerBtn");

    loginForm.style.display = "none";
    registerForm.style.display = "none";
    rideForm.style.display = "none";
    rideTable.style.display = "none";

    loginBtn.addEventListener("click", () => {
        loginForm.style.display = "block";
        registerForm.style.display = "none";
        rideForm.style.display = "none";
        rideTable.style.display = "none";
    });

    registerBtn.addEventListener("click", () => {
        registerForm.style.display = "block";
        loginForm.style.display = "none";
        rideForm.style.display = "none";
        rideTable.style.display = "none";
    });

    logoutBtn.addEventListener("click", () => {
        // Implement logout functionality here
        alert("Logged out");
        loginForm.style.display = "none";
        registerForm.style.display = "none";
        rideForm.style.display = "none";
        rideTable.style.display = "none";
    });

    // Mock login event for demonstration
    document.getElementById("login").addEventListener("submit", (event) => {
        event.preventDefault();
        loginForm.style.display = "none";
        registerForm.style.display = "none";
        rideForm.style.display = "block";
        rideTable.style.display = "block";
    });

    document.getElementById("register").addEventListener("submit", (event) => {
        event.preventDefault();
        // Implement registration functionality here
        alert("Registered successfully");
        loginForm.style.display = "none";
        registerForm.style.display = "none";
        rideForm.style.display = "block";
        rideTable.style.display = "block";
    });

    document.getElementById("ride").addEventListener("submit", (event) => {
        event.preventDefault();
        const date = event.target.date.value;
        const name = event.target.name.value;
        const amount = event.target.amount.value;

        const row = document.createElement("tr");
        row.innerHTML = `<td>${date}</td><td>${name}</td><td>${amount}</td>`;
        document.getElementById("rideList").appendChild(row);

        event.target.reset();
    });
});
