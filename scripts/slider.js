const minPriceSlider = document.getElementById("min-price");
const maxPriceSlider = document.getElementById("max-price");
const minPriceValue = document.getElementById("min-price-value");
const maxPriceValue = document.getElementById("max-price-value");
const postContainer = document.getElementById("post-container"); // Change to the actual container ID

let post_prices = [];
let visiblePosts = [];

// Initialize sliders
minPriceSlider.addEventListener("input", updateSliders);
maxPriceSlider.addEventListener("input", updateSliders);

function updateSliders() {
    // Ensure that the min value doesn't exceed the max value
    if (parseFloat(minPriceSlider.value) > parseFloat(maxPriceSlider.value)) {
        minPriceSlider.value = maxPriceSlider.value;
    }

    // Ensure that the max value doesn't go below the min value
    if (parseFloat(maxPriceSlider.value) < parseFloat(minPriceSlider.value)) {
        maxPriceSlider.value = minPriceSlider.value;
    }

    minPriceValue.textContent = `$${minPriceSlider.value}`;
    maxPriceValue.textContent = `$${maxPriceSlider.value}`;
    filterPosts();
}

document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".container");

    let max = -1;
    let min = 10 ** 7;

    cards.forEach(card => {
        if (card.querySelector("#price") != null) {
            const value = parseFloat(card.querySelector("#price").textContent);

            if (value > max) {
                max = parseInt(value + 1);
            }
            if (value < min) {
                min = parseInt(value);
            }
            post_prices.push({ 'value': value, 'card': card });
        }
    });

    minPriceSlider.value = min;
    maxPriceSlider.value = max + 1;

    minPriceSlider.setAttribute('min', min);
    minPriceSlider.setAttribute('max', max);
    minPriceSlider.setAttribute('value', min);

    maxPriceSlider.setAttribute('min', min);
    maxPriceSlider.setAttribute('max', max);
    maxPriceSlider.setAttribute('value', max);

    updateSliders();
});

function filterPosts() {
    const minPrice = parseFloat(minPriceSlider.value);
    const maxPrice = parseFloat(maxPriceSlider.value);

    visiblePosts = post_prices.filter(post => post.value >= minPrice && post.value <= maxPrice);

    updateDisplay();
}

function updateDisplay() {
    post_prices.forEach(post => {

        if (!post.card.className.includes("filter")) {
            if (visiblePosts.includes(post)) {
                post.card.style.display = "block";
            } else {
                post.card.style.display = "none";
            }
        }
    });
}


// Initial filtering
filterPosts();