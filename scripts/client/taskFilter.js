document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".container");
    const tags = document.querySelectorAll(".tag");

    const activeFilters = {
        status: [], // Use an array to store active values
        category: [],
        date: ['desc'],
        price: []
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

        if (activeFilters.date.length > 0) {
            cards.forEach(card => {
                card.remove();
                // remove all cards
            })
            if (activeFilters.date[0] === "desc") {
                date_filtered = [].slice.call(cards).sort((a, b) => {
                    const aDate = new Date(a.querySelector("#created_at").getAttribute('value')).getTime();
                    const bDate = new Date(b.querySelector("#created_at").getAttribute('value')).getTime();
                    return aDate - bDate;
                });
            } else {
                date_filtered = [].slice.call(cards).sort((a, b) => {
                    const aDate = new Date(a.querySelector("#created_at").getAttribute('value')).getTime();
                    const bDate = new Date(b.querySelector("#created_at").getAttribute('value')).getTime();
                    return bDate - aDate;
                })
            }
            date_filtered.forEach(card => {
                    document.querySelector(".taskCard").appendChild(card);
                })
                // sort by date and append to taskCard
        }
        // Sort by price
        if (activeFilters.price.length > 0) {
            cards.forEach(card => {
                card.remove(); // Remove all cards
            });

            const priceSortOrder = activeFilters.price[0] === "asc" ? 1 : -1;
            const priceFiltered = [].slice.call(cards).sort((a, b) => {
                const aPrice = parseFloat(a.querySelector("#price").textContent);
                const bPrice = parseFloat(b.querySelector("#price").textContent);
                return (aPrice - bPrice) * priceSortOrder;
            });

            priceFiltered.forEach(card => {
                document.querySelector(".taskCard").appendChild(card);
            });
        }
    }

    function tagActive() {
        tags.forEach(tag => {
            tag.addEventListener("click", function() {
                const filterType = tag.getAttribute('data-filter-type');
                const filterValue = tag.getAttribute('data-filter-value');
                const oppositeFilterValue = filterValue === 'asc' ? 'desc' : 'asc';

                // Toggle the active class
                tag.classList.toggle("active");

                // Remove the active class for the opposite filter
                const oppositeFilterTag = document.querySelector(`[data-filter-type='${filterType}'][data-filter-value='${oppositeFilterValue}']`);

                if (oppositeFilterTag) {
                    oppositeFilterTag.classList.remove("active");
                }

                // Clear active date filters
                activeFilters.date = [];
                activeFilters.price = [];

                if (filterType === 'date') {
                    document.querySelectorAll(`[data-filter-type='price']`).forEach(tag => { tag.classList.remove("active") });

                    activeFilters.date.push(filterValue);
                } else if (filterType === 'price') {
                    document.querySelectorAll(`[data-filter-type='date']`).forEach(tag => { tag.classList.remove("active") });

                    activeFilters.price.push(filterValue);
                } else {
                    // Update the active filters based on the clicked tag
                    const filterIndex = activeFilters[filterType].indexOf(filterValue);
                    if (filterIndex === -1) {
                        activeFilters[filterType].push(filterValue);
                    } else {
                        activeFilters[filterType].splice(filterIndex, 1);
                    }
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