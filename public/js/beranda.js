document.getElementById('leftBtn').addEventListener('click', function() {
    var scrollableDiv = document.querySelector('.horizontal-scrollable');
    scrollableDiv.scrollLeft -= 500; // Adjust scroll amount as needed
});

document.getElementById('rightBtn').addEventListener('click', function() {
    var scrollableDiv = document.querySelector('.horizontal-scrollable');
    scrollableDiv.scrollLeft += 500; // Adjust scroll amount as needed
});