 // Get references to sidebar buttons and content sections
 const dashboard = document.getElementById("Dashboard");
 const dashboardButton = document.getElementById("dashboardButton");
 const inbox = document.getElementById("inbox");
 const inboxButton = document.getElementById("inboxButton");
 const header = document.querySelector('#header')


 if (document.getElementById("message") !== null) {
     dashboard.style.display = "none";
     header.style.display = "none";
     inbox.style.display = "flex";

     dashboardButton.classList.remove("active");
     inboxButton.classList.add("active");
 }

 dashboardButton.addEventListener("click", () => {
     // Hide all content sections
     dashboard.style.display = "block";
     inbox.style.display = "none";
     header.style.display = "flex";

     inboxButton.classList.remove("active");
     dashboardButton.classList.add("active");
 });

 inboxButton.addEventListener("click", () => {
     // Hide all content sections
     dashboard.style.display = "none";
     header.style.display = "none";
     inbox.style.display = "flex";

     dashboardButton.classList.remove("active");
     inboxButton.classList.add("active");
 });