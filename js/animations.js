AOS.init();

// script.js
const titleSpan = document.getElementById('smp');


// Function to play the animation
function playAnimation() {
    anime.timeline({ loop: false })
        .add({
            targets: '.title',
            opacity: [0, 1],
            translateY: [30, 0],
            easing: 'easeOutExpo',
            duration: 1500,
            delay: anime.stagger(100) // Add a stagger delay for each letter
        })
        .add({
            targets: '.title',
            opacity: [1, 0],
            translateY: [0, -30],
            easing: 'easeInExpo',
            duration: 1500,
            delay: anime.stagger(100)
        });
}

// Attach the playAnimation function to the hover events
titleSpan.addEventListener('mouseenter', function() {
    setTimeout(playAnimation, 300); // Delay the animation by 300 milliseconds
});

titleSpan.addEventListener('mouseleave', function() {
    // You can add any additional logic here for when the mouse leaves if needed
});

