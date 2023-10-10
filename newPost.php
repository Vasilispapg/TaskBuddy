<?php
session_name('user');
session_start();
if (isset($_COOKIE["user"]) && !empty($_SESSION["id"])) {
    // Look up the user by the identifier stored in the session
    $user_id = $_COOKIE["user"];
}
else{
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskBuddy</title>
    <link rel="stylesheet" href="web_stuff/css/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css" />
    
    
</head>
<?php include 'components/header.php';?>


<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto" >
        <div class="card card0 border-0">
            <div class="row d-flex">
                <form id='postform' action='php/createPost.php' enctype="multipart/form-data" method="post" class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5">

                        <div class="row px-3 title">
                            <label class="mb-1"><h6 class="mb-0 text">Τίτλος</h6></label>
                            <input class="mb-4" type="text" name="title" required placeholder="Enter a title">
                        </div>
                        <div class="row px-3 Description">
                            <label class="mb-1"><h6 class="mb-0 text">Περιγραφή</h6></label>
                            <input class="mb-4" type="text" id='desc' name="desc" placeholder="Enter your Description">
                        </div>
                        <div class="row px-3 category">
                        <label class="mb-1"><h6 class="mb-0 text">Κατηγορία</h6></label>
                            <select id="categorySelect" name="category" class="custom-select"></select>
                        </div>

                        <div class="row px-3 price">
                            <label class="mb-1"><h6 class="mb-0 text">Τιμή</h6></label>
                            <input class="mb-4" type="price" id='price' required name="price" placeholder="Enter a Price">
                        </div>
                        <div class="form-group profileimages">
                            <label class="mb-1" for='image'><h6 class="mb-0 text">Πρόσθεσε μια φωτογραφία του προβλήματος</h6></label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <div class="row mb-3 px-3">
                            <button type="submit" id='submit' class="btn btn-blue text-center">Create a Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include 'components/footer.php';?>
</body>
</html>

<script>
    function generateExpirationDateSelector() {
        const container = document.createElement('div');
        container.classList.add('row', 'px-3', 'expiredate');

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
        div=document.createElement('div')
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
        const categorySelect = document.getElementById("categorySelect");

        // Loop through categories and create option elements
        categories.forEach(category => {
            const option = document.createElement("option");
            option.value = category;
            option.textContent = category;
            categorySelect.appendChild(option);
        });
    }


const expirationDateSelector = generateExpirationDateSelector();
child=document.querySelector('div.form-group.profileimages')
console.log(child.parentNode)
document.querySelector('.card2').insertBefore(expirationDateSelector,child);


window.addEventListener("DOMContentLoaded", populateCategories);
</script>