document.addEventListener('DOMContentLoaded', () => {
    // Helper function to get query parameters from the URL
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Dynamically fetch `type_id` from the query parameter
    const typeId = getQueryParam('type_id');
	console.log(typeId);

    if (!typeId) {
        console.error('Type ID is missing in the URL query parameters');
        return;
    }

    // Fetch data from the server using the dynamic `type_id`
    fetch(`get_projects.php?type_id=${typeId}`)
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Network response was not ok: ${response.statusText}`);
            }
            return response.json();
        })
        .then((data) => {
            // Get the container where project data will be rendered
            const contentContainer = document.querySelector('.content');
            contentContainer.innerHTML = ''; // Clear any static content

            // Iterate through the data and create HTML for each project
            data.forEach((project) => {
                const projectDiv = document.createElement('div');
                projectDiv.className = 'project';

                projectDiv.innerHTML = `
                    <h2>${project.project_name}</h2>
                    <div class="project-content">
                        <img src="${project.project_image}" alt="${project.project_name}">
                        <p>${project.project_desc}</p>
                    </div>
                `;

                contentContainer.appendChild(projectDiv);
            });
        })
        .catch((error) => {
            console.error('Error fetching project data:', error);
        });
});
