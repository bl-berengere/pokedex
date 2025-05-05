console.log('favorite');
function toggleFavorite(element){
    const pokemonId = element.dataset.id;
    const icon = element.querySelector('i');
    const isFavorite = icon.classList.contains('fa-solid');

    const url = isFavorite
        ? `/favorite/remove/${pokemonId}`
        : `/favorite/add/${pokemonId}`;

    fetch(url, {method: 'POST'})
    .then(response => response.json())
    .then(data => {
        icon.classList.toggle('fa-solid');
        icon.classList.toggle('fa-regular');

        // Si on est sur la page /favorite → retirer la carte
        if (window.location.pathname === '/favorite' && isFavorite) {
            const card = element.closest('.pokecard');
            card?.remove();
        }
    })
}