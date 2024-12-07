let currentImageIndex = 0;
const images = [
    "img/Wohnung9/Build2.jpg",
    "img/Wohnung9/Build3.jpg",
    "img/Wohnung9/Build1.jpg"
];

function copyLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        showCustomModal();
    }).catch(err => {
        console.error('Failed to copy: ', err);
    });
}
function showCustomModal() {
    var modal = document.getElementById("customModal");
    modal.style.display = "block";
    setTimeout(() => {
        modal.style.display = "none";
    }, 3000); // Hide the modal after 3 seconds
}
function anotherAction() {
    // Add your JavaScript code for the second button action here
    alert('Another action triggered');
}

function printPage() {
    window.print();
}

// Modal functionality
function openModal(index) {
    currentImageIndex = index;
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("img01");
    modal.style.display = "block";
    console.log("Current Image Index:", currentImageIndex); // Log the current image index
    console.log("Image Source:", images[currentImageIndex]); // Log the image source
    modalImg.src = images[currentImageIndex];
}

function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}

function changeImage(direction) {
    currentImageIndex += direction;
    if (currentImageIndex >= images.length) {
        currentImageIndex = 0;
    } else if (currentImageIndex < 0) {
        currentImageIndex = images.length - 1;
    }
    var modalImg = document.getElementById("img01");
    console.log("Current Image Index:", currentImageIndex); // Log the current image index
    console.log("Image Source:", images[currentImageIndex]); // Log the image source
    modalImg.src = images[currentImageIndex];
}