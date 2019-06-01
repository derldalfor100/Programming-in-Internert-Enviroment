var animation, isFrameOpened, autoArr;

function placeHolder() {
    let searchElem = document.querySelector("#searchInput");
    let wikiEngine = document.querySelector("#wiki");
    let ccEngine = document.querySelector("#ccsearch");
    let archiveEngine = document.querySelector("#internetArchive");
    if (wikiEngine.checked) {
        searchElem.placeholder = wikiEngine.value;
    } else if (ccEngine.checked) {
        searchElem.placeholder = ccEngine.value;
    } else {
        searchElem.placeholder = archiveEngine.value;
    }
}

function initialize() {
    animation = new TimelineLite();
    isFrameOpened = false;
    autoArr = [];
}

function newAutoComplete(e) {
    let autoElem = document.querySelector("#auto");
    let inputStr = e.target.value;
    let showArr = [];
    if (inputStr !== "" && autoArr.some(str => str.indexOf(inputStr) === 0)) {
        autoArr.forEach(str => {
            if (str.indexOf(inputStr) === 0) {
                showArr.push(str);
            }
        });
        animation.to(autoElem, 0.1, { display: "none", opacity: "0" });
        autoElem.innerHTML = "";
        for (i = 0; i < showArr.length - 1; i++) {
            autoElem.innerHTML += `${showArr[i]}<hr />`;
        }
        autoElem.innerHTML += `${showArr[i]}`;

        animation.to(autoElem, 0.5, { display: "block", opacity: "1" });
    } else {
        animation.to(autoElem, 0.3, { display: "none", opacity: "0" });
    }
}

function addToAutoComp(str) {
    if (!autoArr.includes(str)) {
        autoArr.push(str);
    }
}

function searchIframe(e) {
    e.preventDefault();
    let frame = document.querySelector("#frameRow");
    let searchInput = document.getElementById('searchInput');
    if (isFrameOpened) {
        animation.to(frame, 0.1, { className: "-=dissapear" })
            .to(frame, 0.6, { className: "+=dissapear" }).to(frame, 0.8, { className: "-=dissapear" });
    } else {
        animation.to(frame, 1, { className: "-=dissapear" });
    }
    console.log('You may need to wait several seconds to see the new iframe!');
    isFrameOpened = true;
    addToAutoComp(searchInput.value);
    triggerSearch(searchInput.value);
}

function triggerSearch(str) {
    let frameElem = document.querySelector("#engineFrame");
    let wikiEngine = document.querySelector("#wiki");
    let ccEngine = document.querySelector("#ccsearch");
    if (wikiEngine.checked) {
        frameElem.src = `http://www.wiki.com/results1.htm?cx=009420061493499222400%3Ae8sof1xaq-u&q=${str}&btnG=Wiki+Search&cof=GIMP%3A009900%3BT%3A000000%3BALC%3AFF9900%3BGFNT%3AB0B0B0%3BLC%3A003F7D%3BBGC%3AFFFFFF%3BVLC%3A666666%3BGALT%3A36A200%3BFORID%3A9%3B&as_q=on`;
    } else if (ccEngine.checked) {
        frameElem.src = `https://search.creativecommons.org/search?q=${str}`;
    } else {
        frameElem.src = `https://archive.org/search.php?query=${str}`;
    }
}