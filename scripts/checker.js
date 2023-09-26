var boll_check_name;
var boll_check_email;
var boll_check_phone;

function changeName() {
    var uname = document.getElementById('uname');
    uname.addEventListener('keyup', function() {
        checkName(uname.value);
    });

}

function changeEmail() {
    var email = document.getElementById('email');
    email.addEventListener('keyup', function() {
        checkEmail(email.value);
    });
}

function changePhone() {
    var phone = document.getElementById('phone');
    phone.addEventListener('keyup', function() {
        checkPhone(phone.value);
    });
}

function checkName(str) { //elegxei an yparxei to onoma se database
    var check_name = 'This name already exists'; //ayto epistrefetai apo php an yparxei
    xmlhttp = new XMLHttpRequest();
    console.log(str)
    let username = "<?php echo $_SESSION['fullname']; ?>"
    console.log(username)
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (username != str) {
                document.getElementById('errorname').innerHTML = xmlhttp.responseText;
                boll_check_name = xmlhttp.responseText == check_name;
                checker();
            }
        }
        xmlhttp.open("GET", "php/check-name.php?username=" + str, true);
        xmlhttp.send();
    }
}

function checkPhone(str) { //elegxei an yparxei to onoma se database
    var check_phone = 'This phone already exists'; //ayto epistrefetai apo php an yparxei
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var phone = "<?php echo $_SESSION['phone']; ?>";
            if (phone != str) {
                document.getElementById('errorphone').innerHTML = xmlhttp.responseText;
                boll_check_phone = xmlhttp.responseText == check_phone;
                checker();
            }
        }
    }
    xmlhttp.open("GET", "php/check-phone.php?phone=" + str, true);
    xmlhttp.send();
}

function checkEmail(str) { //elegxei an yparxei to email se database
    var check_name = 'This email already exists';
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //kane kati
            var email = "<?php echo $_SESSION['email']; ?>";
            if (email != str) {
                document.getElementById('erroremail').innerHTML = xmlhttp.responseText;
                boll_check_email = xmlhttp.responseText == check_name;
                checker();
            }
        }
    }
    xmlhttp.open("GET", "php/check-email.php?email=" + str, true);
    xmlhttp.send();

}

function checker() {
    submit = document.getElementById('submit')
    if (boll_check_email || boll_check_name || boll_check_phone) {
        submit.disabled = true;
        submit.style.cursor = 'default'
        submit.style.backgroundColor = "rgba(0,0,0,0.1)";
    } else {
        submit.disabled = false;
        submit.style.cursor = 'pointer'
        submit.style.opacity = 100;
        submit.style.backgroundColor = '#1A237E';

    }

}