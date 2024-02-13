# Tic Tac Toe Game Documentation

## Overview

This documentation guides you through the implementation of a Tic Tac Toe game using HTML, CSS, and JavaScript. It facilitates a two-player gaming experience where players alternate marking the cells in a 3x3 grid with 'X' or 'O'.

## HTML Structure

The `index.html` file defines the layout of the game. It includes:

- A `<div>` with the `game-container` class that centers the game on the page.
- A dynamic 3x3 grid representing the game board within a `<div>` with the `board` id.

![Tic Tac Toe Grid](assets\grid.png)

- A `<div>` with the `result` id to display game status messages.
- A `<button>` with the `reset-btn` id to reset the game.

## CSS Styling

The `style.css` file contains styles for:

- The body of the document, which uses the Arial font and centers the content.
- The `.game-container` class that aligns the text to the center.
- The `.board` class that styles the Tic Tac Toe grid.
- The `.cell` class that styles each cell in the grid.
- The `.result` class that displays the game result message.
- The `.reset-btn` class that styles the reset button.

### Primary Color

Used for the reset button background:

![Primary Color](assets/primary-color.png)

### Border Color

Used for the grid cell borders:

![Border Color](assets/border-color.png)

### Text Color

Used for the cell 'X' and 'O' text:

![Text Color](assets/text-color.png)


## JavaScript Logic

The `script.js` file controls the game's logic:

- Initializes the game board array and player turn.
- Dynamically creates the 3x3 grid of cells.
- Handles cell clicks, player turns, win conditions, and game reset.

## Game Initialization

Upon loading the DOM content, the `createBoard` function is called to create the grid cells and set up the initial state of the game.

## Cell Interaction

The `handleCellClick` function manages player actions on each cell, updating the game board and UI accordingly.

## Player Turns

The `switchPlayer` function toggles the active player between 'X' and 'O'.

## Game Status Update

The `updatePlayerTurn` function updates the `result` div with the current player's turn or the game result.

## Win Condition Check

The `checkWin` function evaluates the board state against possible winning combinations.

## Tie Condition Check

The `checkTie` function determines if a tie has occurred, meaning the board is full without a winner.

## Game Reset

The `resetGame` function resets the game to its initial state, clearing the board and resetting player turns.

## Usage

To use this Tic Tac Toe game in your project:

1. Include the `index.html`, `style.css`, and `script.js` files in your project directory.
2. Ensure the styles in `style.css` are linked within the `<head>` section of your `index.html` file.
3. Ensure `script.js` is linked before the closing `<body>` tag of your `index.html` file.
4. Open `index.html` in a web browser to start the game.

## Customization

Customize the game by modifying the CSS styles to fit your design needs or by enhancing the JavaScript logic for additional features.
