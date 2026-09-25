document.addEventListener('DOMContentLoaded', function () {
    const deleteForms = document.querySelectorAll('.admin-delete-form');

    deleteForms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            const confirmDelete = confirm('Are you sure you want to delete this item?');
            if (!confirmDelete) {
                event.preventDefault();
            }
        });
    });
});