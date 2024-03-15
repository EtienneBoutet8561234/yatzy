<?php
namespace TikTacToe;

class Game
{
    public $currentPlayer;
    public $gameBoard;
    public $gameActive;
    public $numXwins;
    public $numOwins;

    public function __construct($numXwins = null, $numOwins = null,)
    {

        $this->currentPlayer = 'X';
        $this->gameBoard = ['', '', '', '', '', '', '', '', ''];
        $this->gameActive = true;
        $this->numXwins = $numXwins ?? 0;
        $this->numOwins = $numOwins ?? 0;
        
        
    }

    public function resetGame(){
        $this->currentPlayer = 'X';
        $this->gameBoard = ['', '', '', '', '', '', '', '', ''];
        $this->gameActive = true;
    }

    public function resetScore(){
        error_log("reset triggers in game.php");
        $this->currentPlayer = 'X';
        $this->gameBoard = ['', '', '', '', '', '', '', '', ''];
        $this->gameActive = true;
        $this->numXwins=0;
        $this->numOwins=0;
    }


    public static function fromJson($json)
    {
        $g = new Game();
        foreach (json_decode($json, true) as $key => $value) {
            $g->{$key} = $value;
        }
        return $g;
    }

    public function toJson()
    {
        return json_encode($this);
    }

}