/************************DELETE ALERT*********************************** */

// Select all elements with the class 'delete-alert'
const deleteAlerts = document.querySelectorAll('.delete-alert');

// Attach event listeners to each delete link
deleteAlerts.forEach(deleteAlert => {
    deleteAlert.addEventListener('click', event => {
        // Prevent the default behavior of the link
        event.preventDefault();
        
        // Show the confirmation dialog
        const result = confirm('ARE YOU SURE YOU WANT TO DELETE THIS USER ?');

        // Redirect only if the user clicks "OK"
        if (result) {
            // Extract the delete URL from the delete link's href attribute
            const deleteURL = deleteAlert.querySelector('a').getAttribute('href');
            // Redirect to the delete URL
            window.location.href = deleteURL;
        }
    });
});
