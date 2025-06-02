document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search');
    const pokecards = document.querySelectorAll('.pokecard');
    const noResultsDiv = document.getElementById('no-results');

    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        let matches = 0;

        pokecards.forEach(card => {
            const cardTitle = card.querySelector('.card-title').textContent.toLowerCase();
            if (cardTitle.includes(searchTerm)) {
                card.style.display = 'block'; // afficher le <a>
                matches++;
            } else {
                card.style.display = 'none'; // cacher le <a>
            }
        });

        if (matches === 0) {
            noResultsDiv.style.display = 'block';
        } else {
            noResultsDiv.style.display = 'none';
        }
    });
});
