
function validateForm() {
    'use strict';

    var email = document.getElementById('email').value.trim();
    var password = document.getElementById('password').value.trim();

    var sessionEmail = '<?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : ""; ?>';
    var sessionPassword = '<?php echo isset($_SESSION["password"]) ? $_SESSION["password"] : ""; ?>';


    if (email !== sessionEmail || password !== sessionPassword) {
        alert('There is no such email or password.');
        return false;
    }
    else {
        return true;
    }
}

function init() {
    'use strict';

    if (document && document.getElementById) {
        var loginForm = document.getElementById('myFormlogin');
        loginForm.onsubmit = validateForm;
    }

} 


window.onload = init;