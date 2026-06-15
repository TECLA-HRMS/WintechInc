// Industries 3-Card Display with Active Card Image
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.overlap-card');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    
    if (cards.length === 0) return;
    
    let currentIndex = 2; // Start with 3rd card as center (index 2)
    const totalCards = cards.length;
    
    function updateCards() {
        // Remove all position classes and active state
        cards.forEach(card => {
            card.classList.remove('left', 'center', 'right', 'active');
        });
        
        // Calculate indices for 3 visible cards
        const leftIndex = (currentIndex - 1 + totalCards) % totalCards;
        const centerIndex = currentIndex;
        const rightIndex = (currentIndex + 1) % totalCards;
        
        // Apply positions to 3 cards
        cards[leftIndex].classList.add('left');
        cards[centerIndex].classList.add('center', 'active');
        cards[rightIndex].classList.add('right');
    }
    
    // Next button - Move to next card
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            currentIndex = (currentIndex + 1) % totalCards;
            updateCards();
        });
    }
    
    // Previous button - Move to previous card
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            currentIndex = (currentIndex - 1 + totalCards) % totalCards;
            updateCards();
        });
    }
    
    // Click on any visible card to make it center
    cards.forEach((card, index) => {
        card.addEventListener('click', function() {
            if (!card.classList.contains('center')) {
                currentIndex = index;
                updateCards();
            }
        });
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            currentIndex = (currentIndex - 1 + totalCards) % totalCards;
            updateCards();
        } else if (e.key === 'ArrowRight') {
            currentIndex = (currentIndex + 1) % totalCards;
            updateCards();
        }
    });
    
    // Auto-rotate every 4 seconds
    let autoRotate = setInterval(() => {
        currentIndex = (currentIndex + 1) % totalCards;
        updateCards();
    }, 4000);
    
    // Pause auto-rotate on hover
    const container = document.querySelector('.cards-overlap-wrapper');
    if (container) {
        container.addEventListener('mouseenter', () => {
            clearInterval(autoRotate);
        });
        
        container.addEventListener('mouseleave', () => {
            autoRotate = setInterval(() => {
                currentIndex = (currentIndex + 1) % totalCards;
                updateCards();
            }, 4000);
        });
    }
    
    // Initialize - Show first 3 cards
    updateCards();
});
