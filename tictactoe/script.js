function Game() {
    let winRows = [[0, 0, 0], [0, 0, 0], [0, 0, 0]];
    let winCols = [[0, 0, 0], [0, 0, 0], [0, 0, 0]];
    let winDiagonals = [[0, 0, 0], [0, 0, 0]];
    let message = document.querySelector("header > p");
    let start = document.querySelector("#start");
    let winner = null;
    let turns = 0;
    let buttons = document.querySelectorAll(".col > button");

    message.style = 'display: none;';
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].innerHTML = "";
        buttons[i].disabled = false;
        buttons[i].classList = "";
        buttons[i].onclick = (event) => {
            let element = event.target;
            console.log(element);
            console.log(winRows);
            let won = false;
            addImage(element);
            element.classList += "btn btn-info";
            element.disabled = true;
            updateArrays(element);
            turns++;
            console.log(turns);
            if (turns >= 5) {
                won = checkWin(winRows, winCols, winDiagonals);
                if(won || turns === 9){
                    disableAll();
                    if(turns === 9 && !won){
                        message.innerText = "Draw! Try again!";
                        message.style = 'display: flex;';
                    }
                }
            }
        }
    }

    function addImage(elem) {
        let img = document.createElement("img");
        img.src = (turns % 2 === 0) ? "x.jpg" : "o.jpg";
        elem.appendChild(img);
    }

    function updateArrays(elem) {
        let id = parseInt(elem.id);
        let afterDivision = Math.floor((id - 1) / 3);
        let afterModulo = (id - 1) % 3;
        let value = (turns % 2 === 0) ? 1 : 2;
        winRows[afterDivision][afterModulo] = value;
        winCols[afterModulo][afterDivision] = value;
        if (id === 1 || id === 5 || id === 9)
            winDiagonals[0][(id - 1) % 3] = value;
        if (id === 3 || id === 5 || id === 7)
            winDiagonals[1][(id - 3) / 2] = value;
    }

    function checkWin(matrix1, matrix2, matrix3) {
        let check;
        check = matrix1.some(arr => checkOnesTwos(arr)) || matrix2.some(arr => checkOnesTwos(arr)) || matrix3.some(arr => checkOnesTwos(arr));
        if (check) {
            message.innerText = "Player" + winner + " you're the winner!";
            message.style = 'display: flex;';
            return true;
        }
        return false;
    }

    function checkOnesTwos(arr) {
        if (arr[0] !== 0 && arr[0] === arr[1] && arr[1] === arr[2]) {
            if (arr[0] === 1) {
                winner = "X";
                return true;
            }
            winner = "O";
            return true;
        }
        return false;
    }

    function disableAll() {
        for (let i = 0; i < buttons.length; i++) {
            buttons[i].disabled = true;
        }
    }
}