const toggleButton = document.getElementById("toggle-btn");
const sidebar = document.getElementById("sidebar");

function toggleBtn() {
    toggleButton.classList.toggle("rotate");
    sidebar.classList.toggle("close");
}