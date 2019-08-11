function toggleCheck(e) {
    let selectedLabel = e.target.parentNode;
    let selectedCheckbox = document.getElementsByName(selectedLabel.getAttribute("for"))[0];
    console.log(selectedCheckbox);
    if(selectedCheckbox.getAttribute('checked'))
        selectedCheckbox.removeAttribute('checked');
    else
        selectedCheckbox.setAttribute('checked', 'checked');
}
