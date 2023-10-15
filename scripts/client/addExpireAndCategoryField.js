function generateExpirationDateSelector() {
    const container = document.createElement('div');
    if (document.querySelector('.card2'))

        container.classList.add('row', 'px-3', 'expiredate');
    else if (document.querySelector('.form-group'))
        container.classList.add('row', 'expiredate');

    const label = document.createElement('label');
    label.classList.add('mb-1');
    label.innerHTML = '<h6 class="mb-0 text">Expire Date</h6>';

    const daySelect = document.createElement('select');
    daySelect.classList.add('custom-select');
    daySelect.setAttribute('aria-label', 'Ημέρα');
    daySelect.setAttribute('name', 'day');
    daySelect.setAttribute('id', 'day');
    daySelect.setAttribute('title', 'Ημέρα');

    const monthSelect = document.createElement('select');
    monthSelect.classList.add('custom-select');
    monthSelect.setAttribute('aria-label', 'Μήνας');
    monthSelect.setAttribute('name', 'month');
    monthSelect.setAttribute('id', 'month');
    monthSelect.setAttribute('title', 'Μήνας');

    const yearSelect = document.createElement('select');
    yearSelect.classList.add('custom-select');
    yearSelect.setAttribute('aria-label', 'Έτος');
    yearSelect.setAttribute('name', 'year');
    yearSelect.setAttribute('id', 'year');
    yearSelect.setAttribute('title', 'Έτος');

    // Populate day options based on the selected month
    const updateDays = () => {
        const selectedMonth = parseInt(monthSelect.value);
        let maxDays = 31;

        if (selectedMonth === 2) {
            const selectedYear = parseInt(yearSelect.value);
            maxDays = (selectedYear % 4 === 0 && (selectedYear % 100 !== 0 || selectedYear % 400 === 0)) ? 29 : 28;
        } else if ([4, 6, 9, 11].includes(selectedMonth)) {
            maxDays = 30;
        }

        // Clear and update day options
        daySelect.innerHTML = '';
        for (let day = 1; day <= maxDays; day++) {
            const option = document.createElement('option');
            option.classList.add('option');
            option.value = day;
            option.textContent = day;
            daySelect.appendChild(option);
        }
    };

    // Populate month and year options
    for (let month = 1; month <= 12; month++) {
        const option = document.createElement('option');
        option.classList.add('option');
        option.value = month;
        option.textContent = month;
        monthSelect.appendChild(option);
    }

    const currentYear = new Date().getFullYear();
    for (let year = currentYear; year <= currentYear + 3; year++) {
        const option = document.createElement('option');
        option.classList.add('option');
        option.value = year;
        option.textContent = year;
        yearSelect.appendChild(option);
    }

    // Add event listeners to month and year selects
    monthSelect.addEventListener('change', updateDays);
    yearSelect.addEventListener('change', updateDays);

    // Initially, set the day options for the current month and year
    updateDays();

    container.appendChild(label);
    div = document.createElement('div')
    div.classList.add('date');
    div.appendChild(daySelect);
    div.appendChild(monthSelect);
    div.appendChild(yearSelect);
    container.appendChild(div);
    return container;
}
const categories = [
    "Καθαρισμός",
    "Χειροτεχνικές Εργασίες",
    "Μετακομίσεις & Συσκευασία",
    "Συναρμολόγηση Επίπλων",
    "Τοποθέτηση & Εγκατάσταση",
    "Εργασίες Στον Κήπο & Τον Χώρο",
    "Παράδοση & Αγορές",
    "Βάψιμο",
    "Οργάνωση",
    "Μικρές Επισκευές Στο Σπίτι",
    "Προσωπικός Βοηθός",
    "Φροντίδα Κατοικιδίων",
    "Τεχνική Υποστήριξη",
    "Σχεδιασμός & Διοργάνωση Εκδηλώσεων",
    "Ανακαίνιση Σπιτιού",
    "Συντήρηση Αυτοκινήτου",
    "Φωτογραφία & Βιντεογραφία",
    "Στήριξη & Εκπαίδευση",
    "Υγεία & Ευεξία",
    "Εικονική Βοήθεια"
];

// Function to populate the select input with categories
function populateCategories() {
    if (document.getElementById("categorySelect"))
        categorySelect = document.getElementById("categorySelect");
    else {
        categorySelect = document.getElementById("edit_category");
    }

    // Loop through categories and create option elements
    categories.forEach(category => {
        const option = document.createElement("option");
        option.value = category;
        option.textContent = category;
        categorySelect.appendChild(option);
    });
}


const expirationDateSelector = generateExpirationDateSelector();
if (document.querySelector('div.form-group.profileimages'))
    child = document.querySelector('div.form-group.profileimages')
else if (document.querySelector('.photo')) {
    child = document.querySelector('.photo')
}
if (document.querySelector('.card2'))
    document.querySelector('.card2').insertBefore(expirationDateSelector, child);
else {
    document.querySelector('.form-group').insertBefore(expirationDateSelector, child);
}


window.addEventListener("DOMContentLoaded", populateCategories);