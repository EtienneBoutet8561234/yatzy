<?php
// Démarrer la session pour conserver l'état du jeu entre les requêtes
session_start();

// Initialiser le jeu ou réinitialiser si demandé
if (!isset($_SESSION['gameBoard']) || isset($_POST['reset'])) {
    $_SESSION['gameBoard'] = array_fill(0, 9, '');
    $_SESSION['currentPlayer'] = 'X';
    $_SESSION['gameActive'] = true;
    $_SESSION['winner'] = null;
}
// Initialiser ou réinitialiser le compteur de victoires
if (!isset($_SESSION['wins'])) {
    $_SESSION['wins'] = ['X' => 0, 'O' => 0];
}
// Réinitialiser les scores si demandé
if (isset($_POST['resetScores'])) {
    $_SESSION['wins'] = ['X' => 0, 'O' => 0];
}

// Gérer le clic sur une cellule
// Ajouter cette fonction à votre script PHP pour vérifier la victoire
function checkWin() {
    $winConditions = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8], // Lignes
        [0, 3, 6], [1, 4, 7], [2, 5, 8], // Colonnes
        [0, 4, 8], [2, 4, 6]             // Diagonales
    ];

    foreach ($winConditions as $condition) {
        if ($_SESSION['gameBoard'][$condition[0]] !== '' &&
            $_SESSION['gameBoard'][$condition[0]] === $_SESSION['gameBoard'][$condition[1]] &&
            $_SESSION['gameBoard'][$condition[1]] === $_SESSION['gameBoard'][$condition[2]]) {
            return true;
        }
    }

    return false;
}

// Modifier la section de votre code qui gère le clic sur une cellule
if (isset($_POST['cell'])) {
    $index = $_POST['cell'];
    if ($_SESSION['gameBoard'][$index] === '' && $_SESSION['gameActive']) {
        $_SESSION['gameBoard'][$index] = $_SESSION['currentPlayer'];

        // Vérifier la victoire ou la fin du jeu ici
        if (checkWin()) {
            $_SESSION['gameActive'] = false;
            $_SESSION['winner'] = $_SESSION['currentPlayer'];
            // Incrémenter le compteur de victoires pour le joueur gagnant
            $_SESSION['wins'][$_SESSION['currentPlayer']]++;
        } else {
            // Passer au joueur suivant
            $_SESSION['currentPlayer'] = ($_SESSION['currentPlayer'] === 'X') ? 'O' : 'X';
        }

        // Vérifier si le plateau est plein sans gagnant pour un match nul
        if (!in_array('', $_SESSION['gameBoard']) && !$_SESSION['winner']) {
            $_SESSION['gameActive'] = false; // Fin du jeu
            $_SESSION['winner'] = 'None'; // Pas de gagnant
        }
    }
}


// Fonction simplifiée pour afficher le plateau de jeu
function displayBoard() {
    echo '<div class="board">';
    for ($i = 0; $i < 9; $i++) {
        // Check if the cell is empty or not
        $cellValue = $_SESSION['gameBoard'][$i] !== '' ? $_SESSION['gameBoard'][$i] : '&nbsp;';
        // Output a button for the cell
        echo '<button type="submit" name="cell" value="' . $i . '" class="cell">' . $cellValue . '</button>';
        // Add a line break after every third cell to create a new row
    }
    echo '</div>';
}


// Fonction pour afficher le message du résultat
// Function to display the message of the result
function displayResult() {
    if ($_SESSION['winner']) {
        if ($_SESSION['winner'] === 'None') {
            echo "It's a tie!";
        } else {
            echo "Player " . $_SESSION['winner'] . " wins!";
        }
    } else {
        echo "Player " . $_SESSION['currentPlayer'] . "'s turn";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tic Tac Toe</title>
</head>
<body>
    <div class="game-container">
        <h1>Tic Tac Toe</h1>
        <form method="post">
            <div id="board" class="board">
                <?php displayBoard(); ?>
            </div>
            <div id="result" class="result">
                <?php displayResult(); ?>
            </div>
            <button class="reset-btn" type="submit" name="reset">Reset Game</button>
            <div class="scoreboard-container">
            <div class="scoreboard">
                <p>Player X wins: <?php echo $_SESSION['wins']['X']; ?></p>
                <p>Player O wins: <?php echo $_SESSION['wins']['O']; ?></p>
            </div>
            <button class="reset-scores-btn" type="submit" name="resetScores">Reset Scores</button>
            </div>
        </form>
    </div>
</body>
</html>
