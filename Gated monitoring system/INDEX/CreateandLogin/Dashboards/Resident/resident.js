
document.addEventListener('DOMContentLoaded', function() {
    const navOptions = document.querySelectorAll('.nav-option');
    const mainContainer = document.querySelector('.main-container');

    navOptions.forEach(option => {
        option.addEventListener('click', function() {
            const page = this.getAttribute('data-page');
            fetch(page + '.php')
                .then(response => response.text())
                .then(data => {
                    mainContainer.innerHTML = data;
                });
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const mainContent = document.querySelector('.main-container');
    
    function loadContent(page) {
        fetch(page + '.php')
            .then(response => response.text())
            .then(data => {
                mainContent.innerHTML = data;
            })
            .catch(error => {
                console.log('Error:', error);
                mainContent.innerHTML = '<div class="report-container"><h2>Error loading content</h2></div>';
            });
    }

    document.querySelectorAll('.nav-option').forEach(option => {
        option.addEventListener('click', function() {
            const page = this.getAttribute('data-page');
            loadContent(page);
            
            // Update active state
            document.querySelectorAll('.nav-option').forEach(opt => {
                opt.classList.remove('active');
            });
            this.classList.add('active');
        });
    });

    // Load dashboard by default
    loadContent('dashboard_home');
});


