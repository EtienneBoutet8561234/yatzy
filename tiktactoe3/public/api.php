<?php
require_once('_config.php');

use TikTacToe\Game;

function game() {
  if ($json = $_SESSION['game'] ?? null) {
    return Game::fromJson($json);
  } else {
    return new Game();
  }
}

function persistGame($g) {
    $reply = $g->toJson();
    $_SESSION['game'] = $reply;
    return $reply;
}

$fullPath = $_GET["path"] ?? "/version";
$path = explode("/", $fullPath);

switch ($fullPath) {
case "/version":
    $reply = json_encode(["version" => "0.9"]);
    break;

case "/game/new":
      $reply = persistGame(new Game());
      break;

case "/game/resetGame":
    // Ensure $game is the current instance of your game with the latest win counts
    $game = game(); // Assume this function retrieves the current game instance

    // Pass the current win counts to the new Game instance
    $game ->resetGame($game->numXwins, $game->numOwins);
    $reply = persistGame($game);
    break;

case "/game/resetScore":
  error_log("reset scored api trigerred");
  $game = game();
  $game -> resetScore();
  $reply = persistGame($game);
  break;


case "/game":
    $g = game();
    $reply = persistGame($g);
    break;
}

header("Content-Type: application/json");
echo $reply;
