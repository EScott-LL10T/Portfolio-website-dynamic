let form = document.getElementById('myForm');
let resetButton = form.querySelector('input[type="reset"]');
let postButton = document.getElementById('postButton');
let previewButton = document.getElementById('previewButton');
let defaultAction = form.action;

resetButton.addEventListener('click', function (e) {
    e.preventDefault(); 
    
    let confirmClear = confirm("Are you sure you want to clear the form?");
    if (confirmClear) {
        form.reset();
        titleInput.value = '';
        contentInput.value = '';
        titleInput.style.backgroundColor = 'white';
        contentInput.style.backgroundColor = 'white';
    }

    
});

let contentInput = form.querySelector('textarea[name="content"]');
let titleInput = form.querySelector('input[name="title"]');

function validateForm() {
    let title = titleInput.value.trim();
    let content = contentInput.value.trim();
    let submitForm = true;

    if (title.length === 0) { 
        titleInput.style.backgroundColor = 'red';
        submitForm = false;
        alert("Title cannot be empty.");
    }else {
        titleInput.style.backgroundColor = 'white';
    }

    if (content.length === 0 || content.length < 20) {
        contentInput.style.backgroundColor = 'red';
        alert("Content must be at least 20 characters long.");
        submitForm = false;
    }else {
        contentInput.style.backgroundColor = 'white';
    }

    return submitForm;
}

postButton.addEventListener('click', function (e) {
    e.preventDefault();
    form.action = defaultAction;
    if (validateForm()) {
        form.submit();
    }
});

contentInput.addEventListener('click', function () {
    contentInput.style.backgroundColor = 'white';
});

titleInput.addEventListener('click', function () {
    titleInput.style.backgroundColor = 'white';
});    


previewButton.addEventListener('click', function (e) {
    e.preventDefault();
    let previewAction = previewButton.getAttribute('formaction') || 'viewBlog.php';
    form.action = previewAction;
    if (validateForm()) {
        form.submit();
    }
    form.action = defaultAction;
});