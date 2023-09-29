 function checkField(field, fieldName) {
     return new Promise((resolve, reject) => {
         var checkMessage = 'This ' + fieldName + ' already exists';
         var xmlhttp = new XMLHttpRequest();

         xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                 const fieldValue = field.value.trim();
                 const sessionValue = values[fieldName];

                 if (fieldValue !== sessionValue) {
                     const errorElement = document.getElementById('error' + fieldName);
                     errorElement.innerHTML = xmlhttp.responseText;
                     const validationPassed = xmlhttp.responseText === checkMessage;
                     resolve(validationPassed);
                 } else {
                     resolve(false);
                 }
             }
         };
         xmlhttp.open('GET', 'php/check-' + fieldName + '.php?' + fieldName + '=' + field.value, true);
         xmlhttp.send();
     });
 }

 function checker() {
     const nameField = document.getElementById('uname');
     const emailField = document.getElementById('email');
     const phoneField = document.getElementById('phone');
     const submitButton = document.getElementById('submit');
     Promise.all([
         checkField(nameField, 'name'),
         checkField(emailField, 'email'),
         checkField(phoneField, 'phone')
     ]).then(validationResults => {
         const validationFailed = validationResults.some(result => result);
         submitButton.disabled = validationFailed;
         submitButton.style.cursor = validationFailed ? 'default' : 'pointer';
         submitButton.style.backgroundColor = validationFailed ? 'rgba(0,0,0,0.1)' : '#1A237E';
     });
 }

 // Attach event listeners
 values = {
     name: document.getElementById('uname').value,
     email: document.getElementById('email').value,
     phone: document.getElementById('phone').value
 };

 document.getElementById('uname').addEventListener('keyup', checker);
 document.getElementById('email').addEventListener('keyup', checker);
 document.getElementById('phone').addEventListener('keyup', checker);