const titlePreview = document.getElementById("title-preview");
const postPreview = document.getElementById("body-preview");
const datePreview = document.getElementById("date-preview");
const imagePreview = document.getElementById("image-preview");

const desiredTitle = document.getElementById("post-title");
const desiredPost = document.getElementById("post-body");
const desiredImage = document.getElementById("post-image");

// These two 'update' functions are called by the onchange event from their respective form elements.
// Only for the purpose of previewing a post before it is submitted
function updateTitle() {
    titlePreview.innerText = desiredTitle.value;
}

function updatePostBody() {
    postPreview.innerText = desiredPost.value;
}

function updateDate() {
    const d = new Date();
    const monthArray = 
    ["January","February","March","April","May","June",
    "July","August","September","October","November","December"];

    let day = String(d.getDate());
    let month = monthArray[d.getMonth()];
    let year = d.getFullYear();

    let dateString = `${day} ${month} ${year}`;
    datePreview.textContent = dateString;
}

function updateImage() {
    imagePreview.src=desiredImage.value;
}

updateDate();

function updateAll() {
    updateTitle();
    updatePostBody();
    updateDate();
    updateImage();
}