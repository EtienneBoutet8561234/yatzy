let TikTacToeApi = {
  newGame: function() {
    $.ajax({
      type: "GET",
      url: "api.php?path=/game/new",
      success: function(game) {
        createRenderer(game)
      }
    });
  },
  resetGame: function(render) {
    $.ajax({
      type: "GET",
      url: "api.php?path=/game/resetGame",
      success: function(game) {
        render.refreshAndReset(game);
      }
    });
  },
  resetScore: function(render) {
    $.ajax({
      type: "GET",
      url: "api.php?path=/game/resetScore",
      success: function(game) {
        render.refreshScore(game);
      }
    });
  },
}


function createRenderer(game) {

  function drawBoard(render, game) {
    const boardElement = document.getElementById('board');
    boardElement.innerHTML = '';

    for (let i = 0; i < 9; i++) {
        const cell = document.createElement('div');
        cell.classList.add('cell');
        cell.setAttribute('data-index', i);
        cell.addEventListener('click', handleCellClick);
        boardElement.appendChild(cell);
    }
    
  }

  function drawScore(render, game) {
    const scoreBoardElement = document.getElementById('scoreboard');
    // Check if the scoreBoardElement already exists to avoid null reference errors
    if (scoreBoardElement) {
        // Update the innerHTML of the scoreBoardElement directly
        scoreBoardElement.innerHTML = `
            <div class="score">
            <br>
                Player X Wins: <label id="xScore">${game.numXwins} </label><br>
                Player O Wins: <label id="oScore">${game.numOwins}</label>
            </div>`;
    } else {
        console.error('Score board element not found.');
    }
    console.log(render); // Log render object to the console for debugging
}


  function handleCellClick(event) {
    console.log("handle click triggered");
    console.log(game)
    const clickedCell = event.target;
    const cellIndex = clickedCell.getAttribute('data-index');

    if (game.gameBoard[cellIndex] === '' && game.gameActive) {
        game.gameBoard[cellIndex] = game.currentPlayer;
        clickedCell.textContent = game.currentPlayer;
        checkWin();
        switchPlayer();
        updatePlayerTurn();
    }
  }

  function switchPlayer() {
    game.currentPlayer = game.currentPlayer === 'X' ? 'O' : 'X';
}

function updatePlayerTurn() {
    const resultElement = document.getElementById('result');
    if (game.gameActive) {
        resultElement.textContent = `Player ${game.currentPlayer}'s turn`;
    } else {
        if (checkTie()) {
            resultElement.textContent = "It's a tie!";
        } else {
            switchPlayer();
            resultElement.textContent = `Player ${game.currentPlayer} wins!`;
            console.log("trigger win");
            
            if (game.currentPlayer=='X'){
                game.numXwins++;
                const xScoreElement = document.getElementById('xScore');
                xScoreElement.textContent = ` ${game.numXwins}`;
            }else{
                game.numOwins++;
                const oScoreElement = document.getElementById('oScore');
                oScoreElement.textContent = ` ${game.numOwins}`;
            }
        }
    }
}

function checkWin() {
  console.log("check win trigger")
    const winPatterns = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8], // Rows
        [0, 3, 6], [1, 4, 7], [2, 5, 8], // Columns
        [0, 4, 8], [2, 4, 6]             // Diagonals
    ];

    for (const pattern of winPatterns) {
        const [a, b, c] = pattern;
        if (game.gameBoard[a] && game.gameBoard[a] === game.gameBoard[b] && game.gameBoard[a] === game.gameBoard[c]) {
           console.log("end game trigger")
           game.gameActive = false;
            return;
        }
    }

    if (!game.gameBoard.includes('')) {
        game.gameActive = false;
    }
}

function checkTie() {
    console.log(game)
    return !game.gameBoard.includes('') && !checkWin();
}

function resetGame() {
    console.log("resetGame done!")
    game.currentPlayer = 'X';
    game.gameBoard = ['', '', '', '', '', '', '', '', ''];
    game.gameActive = true;

    const resultElement = document.getElementById('result');
    resultElement.textContent = '';

    const cells = document.querySelectorAll('.cell');
    cells.forEach(cell => {
        cell.textContent = '';
    });

    //updatePlayerTurn();
    
  }
  function resetScore(){
    game.numOwins=0;
    game.numXwins=0;
  }
 

  let render = {
    board_container: document.getElementById("boardContainer"),
    score_container: document.getElementById("scoreContainer"),
  }

  render.refresh = function(game) {
    drawBoard(this, game);
    drawScore(this, game);
  }

  render.refreshAndReset = function(game){
    drawBoard(this, game);
    resetGame();
  }

  render.refreshScore = function(game) {
    drawScore(this, game);
    resetScore();
  }

  render.registerButtons = function() {
    let render = this;
    document.getElementById("resetBtn").onclick = function(e) {
      TikTacToeApi.resetGame(render);
    }
    
    document.getElementById("reset-scores-btn").onclick = function(e) {
      TikTacToeApi.resetScore(render);
    }
  }

  render.refresh(game);
  render.registerButtons()

  return render;
}