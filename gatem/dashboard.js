
    document.getElementById('guest-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const guestName = document.getElementById('guest-name').value.trim();
    const arrivalTime = document.getElementById('arrival-time').value.trim();

    if (guestName && arrivalTime) {
        // Add guest info to the guest activity list
        const guestActivity = document.getElementById('guest-activity');
        const newGuestItem = document.createElement('li');
        newGuestItem.textContent = `Guest ${guestName} arrived at ${arrivalTime}`;
        guestActivity.appendChild(newGuestItem);

        // Reset the form
        this.reset();
    } else {
        console.error('Please fill in both guest name and arrival time.');
    }
});
document.querySelector('.nav-option.option4').addEventListener('click', function() {
    const guestFormSection = document.getElementById('guest-form');
    // Toggle the display of the guest form
    if (guestFormSection.style.display === 'none' || guestFormSection.style.display === '') {
        guestFormSection.style.display = 'block';
    } else {
        guestFormSection.style.display = 'none';
    }
});

document.getElementById('new-guest-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get form values
    const guestName = document.getElementById('guest-name').value;
    const guestContact = document.getElementById('guest-contact').value;
    const guestTime = document.getElementById('guest-time').value;

    // Here you can handle the data (e.g., send it to a server or display it)
    console.log(`Guest Added: ${guestName}, Contact: ${guestContact}, Time: ${guestTime}`);

    // Optionally, you can reset the form after submission
    this.reset();
});
