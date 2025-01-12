document.addEventListener('DOMContentLoaded', () => {
    // Fetch data from the PHP script
    fetch('get_honours_inspirers.php')
        .then((response) => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then((data) => {
            // Handle honours
            const honoursContainer = document.querySelector('.honours-content');
            data.honours.forEach((honour) => {
                const card = document.createElement('div');
                card.className = 'honours-card polaroid';
                card.innerHTML = `
                    <img src="${honour.hon_img}" alt="${honour.hon_name}" class="polaroid-img">
                    <p class="name">${honour.hon_name}</p>
                `;
                honoursContainer.appendChild(card);
            });

            // Handle inspirers
            const inspirersContainer = document.querySelector('.inspirers-content');
            data.inspirers.forEach((inspirer) => {
                const card = document.createElement('div');
                card.className = 'inspirer-card polaroid';
                card.innerHTML = `
                    <img src="${inspirer.inspirer_img}" alt="${inspirer.inspirer_name}" class="polaroid-img">
                    <p class="name">${inspirer.inspirer_name}</p>
                `;
                inspirersContainer.appendChild(card);
            });
        })
        .catch((error) => {
            console.error('Error fetching data:', error);
        });
});
