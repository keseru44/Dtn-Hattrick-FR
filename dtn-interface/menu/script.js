document.addEventListener("DOMContentLoaded", function() {
    var dropdownToggle = document.getElementById('dropdown-toggle');
    var dropdownMenu = document.getElementById('dropdown-menu');

    dropdownToggle.addEventListener('mouseover', function() {
        dropdownMenu.style.display = 'block';
    });

    dropdownToggle.addEventListener('mouseout', function() {
        dropdownMenu.style.display = 'none';
    });

    dropdownMenu.addEventListener('mouseover', function() {
        dropdownMenu.style.display = 'block';
    });

    dropdownMenu.addEventListener('mouseout', function() {
        dropdownMenu.style.display = 'none';
    });
});
