 // Get references to sidebar buttons and content sections
 const dashboard = document.getElementById("Dashboard");
 const dashboardButton = document.getElementById("dashboardButton");

 const inbox = document.getElementById("inbox");
 const inboxButton = document.getElementById("inboxButton");

 const header = document.querySelector('#header')

 const headerTitle = document.querySelector('.app-content-headerText')

 const jobs = document.getElementById("jobs");
 const jobsButton = document.getElementById("jobsButton");

 const notification = document.getElementById("notification");
 const notificationButton = document.getElementById("notifButton");

 const appContainer = document.querySelector('.tableView')
 const appContainerWidth = appContainer.style.width

 if (document.getElementById("message") !== null) {
     dashboard.style.display = "none";
     header.style.display = "none";
     jobs.style.display = "none";
     inbox.style.display = "flex";

     dashboardButton.classList.remove("active");
     jobsButton.classList.remove("active");
     inboxButton.classList.add("active");
 }

 dashboardButton.addEventListener("click", () => {
     // Hide all content sections
     dashboard.style.display = "block";
     inbox.style.display = "none";
     jobs.style.display = "none";
     notification.style.display = "none";
     header.style.display = "flex";

     inboxButton.classList.remove("active");
     jobsButton.classList.remove("active");
     notificationButton.classList.remove("active");
     dashboardButton.classList.add("active");
     headerTitle.textContent = "Dashboard"

 });

 jobsButton.addEventListener("click", () => {
     // Hide all content sections
     dashboard.style.display = "none";
     inbox.style.display = "none";
     header.style.display = "none";

     jobs.style.display = "block";

     inboxButton.classList.remove("active");
     dashboardButton.classList.remove("active");

     notificationButton.classList.remove("active");
     notification.style.display = "none";

     jobsButton.classList.add("active");
     headerTitle.textContent = "Jobs"
 });

 inboxButton.addEventListener("click", () => {
     // Hide all content sections
     dashboard.style.display = "none";
     header.style.display = "none";
     jobs.style.display = "none";

     inbox.style.display = "flex";

     notification.style.display = "none";
     notificationButton.classList.remove("active");

     dashboardButton.classList.remove("active");
     jobsButton.classList.remove("active");

     inboxButton.classList.add("active");
     headerTitle.textContent = "Inbox"
     appContainer.style.width = appContainerWidth
 });

 notificationButton.addEventListener("click", () => {
     // Hide all content sections
     dashboard.style.display = "none";
     header.style.display = "none";
     jobs.style.display = "none";
     inbox.style.display = "none";

     appContainer.style.width = '50em'

     notification.style.display = "block";

     inboxButton.classList.remove("active");
     dashboardButton.classList.remove("active");
     jobsButton.classList.remove("active");

     notificationButton.classList.add("active");
     headerTitle.textContent = "Notifications"
 })