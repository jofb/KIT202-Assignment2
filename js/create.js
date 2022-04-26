const titlePreview = document.getElementById("title-preview");
const postPreview = document.getElementById("body-preview");
const datePreview = document.getElementById("date-preview");

const desiredTitle = document.getElementById("post-title");
const desiredPost = document.getElementById("post-body");

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
    let daySuffix = 'th';
    if (day.charAt(day.length - 1) == 3) {
        daySuffix = 'rd';
    }
    else if (day.charAt(day.length - 1) == 2) {
        daySuffix = 'nd';
    }
    else if (day.charAt(day.length - 1) == 1) {
        daySuffix = 'st';
    }

    let dateString = `${day}${daySuffix} ${month} ${year}`;
    datePreview.textContent = dateString;
}

updateDate();