let currentPlayer = 'X';
let gameBoard = ['', '', '', '', '', '', '', '', ''];
let gameActive = true;

document.addEventListener('DOMContentLoaded', createBoard);

function createBoard() {
    const boardElement = document.getElementById('board');

    for (let i = 0; i < 9; i++) {
        const cell = document.createElement('div');
        cell.classList.add('cell');
        cell.setAttribute('data-index', i);
        cell.addEventListener('click', handleCellClick);
        boardElement.appendChild(cell);
    }

    updatePlayerTurn();
}

function handleCellClick(event) {
    const clickedCell = event.target;
    const cellIndex = clickedCell.getAttribute('data-index');

    if (gameBoard[cellIndex] === '' && gameActive) {
        gameBoard[cellIndex] = currentPlayer;
        clickedCell.textContent = currentPlayer;
        checkWin();
        switchPlayer();
        updatePlayerTurn();
    }
}

function switchPlayer() {
    currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
}

function updatePlayerTurn() {
    const resultElement = document.getElementById('result');
    if (gameActive) {
        resultElement.textContent = `Player ${currentPlayer}'s turn`;
    } else {
        if (checkTie()) {
            resultElement.textContent = "It's a tie!";
        } else {
            switchPlayer();
            resultElement.textContent = `Player ${currentPlayer} wins!`;
        }
    }
}

function checkWin() {
    const winPatterns = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8], // Rows
        [0, 3, 6], [1, 4, 7], [2, 5, 8], // Columns
        [0, 4, 8], [2, 4, 6]             // Diagonals
    ];

    for (const pattern of winPatterns) {
        const [a, b, c] = pattern;
        if (gameBoard[a] && gameBoard[a] === gameBoard[b] && gameBoard[a] === gameBoard[c]) {
            gameActive = false;
            return;
        }
    }

    if (!gameBoard.includes('')) {
        gameActive = false;
    }
}

function checkTie() {
    return !gameBoard.includes('') && !checkWin();
}

function resetGame() {
    currentPlayer = 'X';
    gameBoard = ['', '', '', '', '', '', '', '', ''];
    gameActive = true;

    const resultElement = document.getElementById('result');
    resultElement.textContent = '';

    const cells = document.querySelectorAll('.cell');
    cells.forEach(cell => {
        cell.textContent = '';
    });

    updatePlayerTurn();
}
