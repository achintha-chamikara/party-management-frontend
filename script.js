
const body = document.querySelector("body"); 
const nav = document.querySelector("nav");  
const modToggle = document.querySelector(".dark-light"); 
const searchToggle = document.querySelector(".searchBox");
const moonIcon = document.querySelector(".bx-moon");
const sunIcon = document.querySelector(".bx-sun");


if (localStorage.getItem("dark-mode") === "enabled") {
    body.classList.add("dark-mode");
    sunIcon.style.display = "block";
    moonIcon.style.display = "none";
} else {
    sunIcon.style.display = "none";
    moonIcon.style.display = "block";
}


modToggle.addEventListener("click", () => {
    body.classList.toggle("dark-mode");

    if (body.classList.contains("dark-mode")) {
        localStorage.setItem("dark-mode", "enabled");
        sunIcon.style.display = "block"; 
        moonIcon.style.display = "none";
    } else {
        localStorage.setItem("dark-mode", "disabled");
        sunIcon.style.display = "none";
        moonIcon.style.display = "block";
    }
});


modToggle.addEventListener("click", () => {
    modToggle.classList.toggle("active"); 
});


searchToggle.addEventListener("click", () => {
    searchToggle.classList.toggle("active"); 
});
// Function to open the login modal
function openLoginModal() {
    document.getElementById("login-modal").style.display = "flex";
}

// Function to close the login modal
function closeLoginModal() {
    document.getElementById("login-modal").style.display = "none";
}

// Handle the form submission (You can replace this with actual logic)
document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault();
    
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    
    console.log("Username: " + username);
    console.log("Password: " + password);
    
    // Here, you would typically make an API call to verify the credentials.
    alert("Logged in successfully!");
    
    // Close the modal after successful login
    closeLoginModal();
});

