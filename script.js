// script.js

// Get references to the theme toggle button and body
const themeToggleButton = document.querySelector('.theme-toggle');
const bodyElement = document.body;

// Check the current theme in local storage and set it
const currentTheme = localStorage.getItem('theme');

// If a theme is set in localStorage, apply it
if (currentTheme) {
    bodyElement.setAttribute('data-theme', currentTheme);
}

// Add a click event listener on the theme toggle button
themeToggleButton.addEventListener('click', () => {
    // Check the current theme
    const currentTheme = bodyElement.getAttribute('data-theme');

    // Toggle the theme
    if (currentTheme === 'dark') {
        bodyElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light'); // Save the theme in localStorage
    } else {
        bodyElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark'); // Save the theme in localStorage
    }
});
