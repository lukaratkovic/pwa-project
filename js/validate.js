let submitButton = document.getElementById('submit');
let titleError = document.getElementById('title_error_message');
let summaryError = document.getElementById('summary_error_message');
let contentError = document.getElementById('content_error_message');
let imageError = document.getElementById('file_error_message');
let imageBorder = document.getElementById('image_input');
let categoryError = document.getElementById('category_error_message');

submitButton.onclick = (event) => {
    let valid = true;
    let title = document.getElementById('title');
    let summary = document.getElementById('summary');
    let content = document.getElementById('content');
    let image = document.getElementById('image');
    let category = document.getElementById('category');

    // Title validation
    if(title.value.length < 5 || title.value.length > 30) {
        titleError.style.display = 'block';
        title.style.borderColor = 'red';
        valid = false;
    } else {
        titleError.style.display = 'none';
        title.style.border = '#858585 1px solid';
    }

    // Summary validation
    if(summary.value.length < 10 || summary.value.length > 100){
        summaryError.style.display = 'block';
        summary.style.borderColor = 'red';
        valid = false;
    } else {
        summaryError.style.display = 'none';
        summary.style.border = '#858585 1px solid';
    }

    // Content validation
    if(!content.value) {
        contentError.style.display = 'block';
        content.style.borderColor = 'red';
        valid = false;
    } else {
        contentError.style.display = 'none';
        content.style.border = '#858585 1px solid';
    }

    // Image upload validation
    if(!image.files.length){
        imageError.style.display = 'block';
        imageBorder.style.border = '1px solid red';
        valid = false;
    } else {
        imageError.style.display = 'none';
        imageBorder.style.border = 'none';
    }

    // Category validation
    if(category.value == 'default') {
        categoryError.style.display = 'block';
        category.style.borderColor = 'red';
        valid = false;
    } else {
        categoryError.style.display = 'none';
        category.style.border = '#858585 1px solid';
    }

    if(!valid) event.preventDefault();
}