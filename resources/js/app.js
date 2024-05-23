
const imageData = JSON.parse(document.currentScript.getAttribute('data-image-array'));
function submitForm() {
    document.getElementById("myForm").submit();
}
let currentImageIndex = 0;
const itemImage = document.getElementById('item-image');
const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');

// Function to update the item image
function updateImage() {
    itemImage.src = "{{ asset('storage/') }}/" + imageData[currentImageIndex]['path'];
}

// Event listener for previous button
prevBtn.addEventListener('click', () => {
    currentImageIndex = (currentImageIndex === 0) ? imageData.length - 1 : currentImageIndex - 1;
    updateImage();
});

// Event listener for next button
nextBtn.addEventListener('click', () => {
    currentImageIndex = (currentImageIndex === imageData.length - 1) ? 0 : currentImageIndex + 1;
    updateImage();
});
// Initial image update
updateImage();
console.log(imageData[currentImageIndex]['path'])
