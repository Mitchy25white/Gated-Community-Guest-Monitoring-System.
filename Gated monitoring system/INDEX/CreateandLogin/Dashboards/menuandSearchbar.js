document.getElementById('menuicn').addEventListener('click', function() {
    // Toggle the class 'active' on the 'nav' element to show or hide the navigation menu
    const nav = document.querySelector('.nav');
    nav.classList.toggle('active');
});

// Add a click event listener to the searchbar
const searchbar = document.querySelector('.searchbar');
searchbar.addEventListener('click', () => {
    // Add the 'active' class to the searchbar
    searchbar.classList.add('active');
});