function check(e) {
    let checkElem = document.querySelector('#remember');
    let name = document.querySelector('#username');
    let password = document.querySelector('#pass');
    if ((getCookie("username") === "" || getCookie("password") === "") && !checkElem.checked) { // !checkElem.checked
        e.preventDefault();
        window.location = "https://www.aac.ac.il/";
    }
    // else go to cookie.php
}

function getCookie(cookieName) {
    let name = cookieName + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let cookieParts = decodedCookie.split(';');
    for (var i = 0; i < cookieParts.length; i++) {
        let c = cookieParts[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length); // return the value
        }
    }
    return "";
}

function checkName() {
    let name = document.querySelector('#username');
    let password = document.querySelector('#pass');
    let selectedCookie = getCookie("username");
    if(selectedCookie !== "" && name.value.length === 1 && selectedCookie[0] === name.value[0]) {
        name.value = selectedCookie;
        password.value = getCookie("password");
    }
}