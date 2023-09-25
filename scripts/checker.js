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

var boll_check_name;
var boll_check_email;

function checkName(str) { //elegxei an yparxei to onoma se database
    var check_name = 'This name already exists'; //ayto epistrefetai apo php an yparxei
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('errorname').innerHTML = xmlhttp.responseText;
            boll_check_name = xmlhttp.responseText == check_name;
            checker();
        }
    }
    xmlhttp.open("GET", "php/check-name.php?username=" + str, true);
    xmlhttp.send();
}

function checker() {
    submit = document.getElementById('submit')
    if (boll_check_email || boll_check_name) {
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



function checkEmail(str) { //elegxei an yparxei to email se database

    var check_name = 'This email already exists';
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //kane kati
            document.getElementById('erroremail').innerHTML = xmlhttp.responseText;
            boll_check_email = xmlhttp.responseText == check_name;
            checker();
        }
    }

    xmlhttp.open("GET", "php/check-email.php?email=" + str, true);
    xmlhttp.send();

}