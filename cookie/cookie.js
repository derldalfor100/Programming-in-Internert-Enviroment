const futureDate = new Date(2193, 5, 5, 15, 55, 5);
const expiredDateString = 'expires=Thu, 01 Jan 1970 00:00:01 GMT';
function createCookie(e) {
    e.preventDefault();
    let msg = document.getElementById('msg');
    let counter = document.getElementById('counter');
    let name = document.getElementById('username').value;
    if (!validate(name)) {
        msg.innerText = 'Only allows 1 word which consisted from solely english letters! Please enter your name again.';
        counter.innerText = '';
        return;
    }
    if(getCookie().length === 0) {
        console.log('no cookie');
        document.cookie = 'username=' + name + ';expires=' + futureDate.toString();
        document.cookie = 'count=1;expires=' + futureDate.toString();
        msg.innerText = 'Welcome ' + name;
        counter.innerText = '';
    } else if (!getCookie()[0].includes('username')) {
        console.log('da', getCookie()[0]);
        document.cookie = 'username=' + name + ';expires=' + futureDate.toString();
        document.cookie = 'count=1;expires=' + futureDate.toString();
        msg.innerText = 'Welcome ' + name;
        counter.innerText = '';
    } else if (getCookie()[1] === name) {
        msg.innerText = 'Welcome ' + name;
        updateCookie();
    } else {
        msg.innerText = 'Not the name you first entered';
        counter.innerText = '';
    }
}

function validate(name) {
    let i = 0;
    for (i; i < name.length; i++) {
        let charCode = name.charCodeAt(i);
        if (charCode < 65 || (charCode > 90 && charCode < 97) || charCode > 122)
            break;
    }
    return i === name.length && i !== 0;
}

function updateCookie() {
    console.log('entered');
    let counter = document.getElementById('counter');
    let newCount = Number(getCookie(1)[1]) + 1;
    deleteACookie(1);
    counter.innerHTML = "You've been here " + newCount + " times.";
    document.cookie = 'count=' + newCount + ';expires=' + futureDate.toString();
}

function deleteACookie(i) {
    if (getCookie().length > 0) {
        let [storedKey, storedValue] = getCookie(i);
        console.log(storedKey);
        document.cookie = storedKey + '=' + storedValue + ';' + expiredDateString;
    }
}

// function deleteCookies() {
//     let i = 0;
//     while (document.cookie.length !== 0) {
//         if (getCookie().length > 0) {
//             let [storedKey, storedValue] = getCookie();
//             document.cookie = storedKey + '=' + storedValue + ';' + expiredDateString + ';';
//             i++;
//         }
//     }
// }

function getCookie(i = 0) {// return undefined!
    let dataArr = [];
    let tempArr = document.cookie.split(';');
    if (tempArr.length === 2) {
        let tempArr = document.cookie.split(';');
        dataArr.push(tempArr[i].split('=')[0]);
        dataArr.push(tempArr[i].split('=')[1]);
    } else if (tempArr.length > 2) {
        let j;
        let tofind = i === 0 ? 'username':'count';
        tempArr.find((value, index) => {
            if (value.includes(tofind)) {
                j = index;
                return value.includes(tofind);
            }
        });
        dataArr.push(tempArr[j].split('=')[0]);// problem!
        dataArr.push(tempArr[j].split('=')[1]);
    }
    return dataArr;
}