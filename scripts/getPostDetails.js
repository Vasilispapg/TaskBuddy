// Fetch the post details from your database using AJAX or another method
// and populate the form fields with these details
// Example: Fetch post details using AJAX and populate the form
function runWhenClick(postID) {
    fetch('php/get_post_details.php?post_id=' + postID)
        .then(response => response.json())
        .then(data => {
            // Assuming you have form fields with IDs 'edit_title', 'edit_desc', 'edit_price', 'edit_category', 'edit_expireDate'
            document.getElementById('edit_title').value = data.title;
            document.getElementById('post_id').value = postID;
            document.getElementById('edit_desc').value = data.description;
            document.getElementById('edit_price').value = data.price;
            document.getElementById('edit_category').value = data.category;
            document.getElementById('edit_expireDate').value = data.end_time;

            // Display the edit form (you can toggle a modal or a hidden div)
            document.getElementById('myModalEdit').style.display = 'block';
        })
        .catch(error => {
            console.error('Error fetching post details: ' + error);
        });
}