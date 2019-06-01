function validate(e) {
    let numInput = document.getElementById('guessnumber');
    let errElem = document.getElementById('err');
    console.log('entered');
    errElem.innerText = "";
    if(numInput.value === "" || isNaN(numInput.value)) {
        console.log('entered to IF');
        errElem.innerText = "error u didn't enter a number!";
        e.preventDefault();
    } else if(Number(numInput.value) > 10 || Number(numInput.value) < 1) {
        errElem.innerText = "You should enter a number between 1-10!";
        e.preventDefault();
    } 
    // else {
    //     // console.log(window.location);
    //     window.location = e.target.form.action;
    // }
}