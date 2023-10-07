document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".container");
    const tags = document.querySelectorAll(".tag");

    const activeFilters = {
        status: [], // Use an array to store active values
        category: [],
        // Add more filter types here if needed
    };

    function applyFilters() {
        cards.forEach(card => {
            const cardStatus = card.querySelector("#status").getAttribute('value');
            const cardCategory = card.querySelector("#category").textContent;

            const statusFilter = activeFilters.status.length === 0 || activeFilters.status.includes(cardStatus);
            const categoryFilter = activeFilters.category.length === 0 || activeFilters.category.includes(cardCategory);

            if (statusFilter && categoryFilter) {
                card.classList.remove('filter');
            } else {
                card.classList.add('filter');
            }
        });
    }

    function tagActive() {
        tags.forEach(tag => {
            tag.addEventListener("click", function() {
                const filterType = tag.getAttribute('data-filter-type');
                const filterValue = tag.getAttribute('data-filter-value');

                // Toggle the active class
                tag.classList.toggle("active");

                // Update the active filters based on the clicked tag
                const filterIndex = activeFilters[filterType].indexOf(filterValue);
                if (filterIndex === -1) {
                    activeFilters[filterType].push(filterValue);
                } else {
                    activeFilters[filterType].splice(filterIndex, 1);
                }

                // Apply the filters
                applyFilters();

            });
        });
    }

    // Initialize the filter tags as active
    tagActive();

    // Apply filters initially
    applyFilters();
});