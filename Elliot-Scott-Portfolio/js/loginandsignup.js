let form = document.getElementById('myForm');
let resetButton = form.querySelector('button[type="reset"]');

resetButton.addEventListener('click', function (e) {
    e.preventDefault(); 
    let confirmClear = confirm("Are you sure you want to clear the form?");
    if (confirmClear) {
        form.reset();
    }
});