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
            const value = parseFloat(card.querySelector("#price").textContent.split("€")[0].split(' ')[1]);

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
    console.log(min, max);
    minPriceSlider.setAttribute('min', min);
    minPriceSlider.setAttribute('max', max);
    maxPriceSlider.setAttribute('min', min);
    maxPriceSlider.setAttribute('max', max);


    maxPriceSlider.setAttribute('value', max);
    minPriceSlider.setAttribute('value', min);

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
        if (visiblePosts.includes(post)) {
            post.card.style.display = "block";
        } else {
            post.card.style.display = "none";
        }
    });
}

// Initial filtering
filterPosts();