
function toggleFavorite() {
    const favoriteIcon = document.querySelector('.favorite-icon');
    favoriteIcon.textContent = favoriteIcon.textContent === '♡' ? '❤️' : '♡';
}
