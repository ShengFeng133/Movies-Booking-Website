
function validateForm() {
    'use strict';

    
    var phone = document.getElementById('phone').value.trim();
    var email = document.getElementById('email').value.trim();


    console.log(phone);
    console.log(email);


    if (!validatePhone(phone)) {
        alert('Please enter a valid 8 digits phone no., with the example format 1234 5678.');
        return false;
    }

    if (!validateEmail(email)) {
        alert('Please enter a valid email address with the example format abc@hotmail.com or abc@hotmail.uk.');
        return false;
    }

    return true;

    // if ((phone.length > 0) && (email.length > 0)) {
    //     return true;  // clear and reload
    // }
    // else {
    //     alert('Please complete the form!');
    //     return false;	// stay at same page
    // }

}

function validatePhone(phone) {
    var phonenum = /^[\d]{4}\s*[\d]{4}$/;
    // var phonenum = /^\s*\d{4}\s?\d{4}\s*$/;

    // /^[0-9]{8}$/;
    if (phonenum.test(phone)) {
        return true;
    }
    else {
        return false;
    }
}


function validateEmail(email) {
    var emailPattern1 = /^[\w.-]+@[\w]+\.[a-zA-Z]{2,3}$/
    var emailPattern2 = /^[\w.-]+@[\w]+\.[\w]+\.[a-zA-Z]{2,3}$/
    var emailPattern3 = /^[\w.-]+@[\w]+\.[\w]+\.[\w]+\.[a-zA-Z]{2,3}$/

    if (emailPattern3.test(email)) {
        return true;
    } else if (emailPattern2.test(email)) {
        return true;
    } else if (emailPattern1.test(email)) {
        return true;
    } else {
        return false;
    }

}


function init() {
    'use strict';

    if (document && document.getElementById) {
        var checkBooking = document.getElementById('checkbooking');
        checkBooking.onsubmit = function () {
            return validateForm() && validateServerSide(); 
        };
    }

} 

function validateServerSide() {
    // You can make an asynchronous request to the server here to perform additional validation.
    // For simplicity, this function always returns true. In a real application, you need to implement server-side validation.
    return true;
}

window.onload = init;