document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search');
    const pokecards = document.querySelectorAll('.pokecard');

    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();

        pokecards.forEach(card => {
            const cardTitle = card.querySelector('.card-title').textContent.toLowerCase();
            if (cardTitle.includes(searchTerm)) {
                card.style.display = 'block'; // afficher le <a>
            } else {
                card.style.display = 'none'; // cacher le <a>
            }
        });
    });
});