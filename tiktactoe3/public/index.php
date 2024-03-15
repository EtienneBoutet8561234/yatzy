<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="assets/game.js"></script>
    <link type="text/css" rel="stylesheet" href="assets/styles.css">
    <script type="text/javascript" src="assets/jquery-3.7.1.min.js"></script>
    <title>Tic Tac Toe</title>
</head>
  <body>
  <body>
    <div class="game-container">
        <h1>Tic Tac Toe</h1>
        <div id="board" class="board"></div>
        <div id="result" class="result"></div>
        <button id="resetBtn" class="reset-btn">Reset Game</button>
        <div class="scoreboard-container">
                <div class="scoreboard" id="scoreboard"></div>
                <button id="reset-scores-btn" class="reset-btn">Reset Scores</button>
        </div>
        
    </div>
    <script>
      window.onload = function() {
        TikTacToeApi.newGame();
      }
    </script>
  </body>
</html>
