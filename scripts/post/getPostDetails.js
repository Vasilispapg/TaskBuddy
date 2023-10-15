// Fetch the post details from your database using AJAX or another method
// and populate the form fields with these details
// Example: Fetch post details using AJAX and populate the form
function runWhenClick(postID) {
    fetch('php/post/get_post_details.php?post_id=' + postID)
        .then(response => response.json())
        .then(data => {

            document.getElementById('edit_title').value = data.title;
            console.log(postID)
            document.getElementById('post_id').value = postID;
            document.getElementById('edit_desc').innerText = data.description;
            document.getElementById('edit_price').value = data.price;

            document.querySelector('#edit_category option[value="' + data.category + '"]').selected = true;

            dateValues = document.querySelector('.date').childNodes;
            dataAttr = data.end_time.split(' ')[0].split('-').reverse();

            document.querySelector('.date select:nth-child(1) option[value="' + parseInt(dataAttr[0]) + '"]').selected = true
            document.querySelector('.date select:nth-child(2) option[value="' + parseInt(dataAttr[1]) + '"]').selected = true
            document.querySelector('.date select:nth-child(3) option[value="' + parseInt(dataAttr[2]) + '"]').selected = true

            // Display the edit form (you can toggle a modal or a hidden div)
            document.getElementById('myModalEdit').style.display = 'block';
        })
        .catch(error => {
            console.error('Error fetching post details: ' + error);
        });
}