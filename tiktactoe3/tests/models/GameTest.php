<?php
namespace Test\Pacman;

use Pacman\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testFromJson()
    {
        $json = json_encode(["n" => 10]);
        $game = Game::fromJson($json);
        $this->assertEquals(10, $game->n);
    }

    public function testToJson()
    {
        $game = new Game(10);

        $expected = [
            "n" => 10,
            "level" => 1,
            "board" => [".", ".", ".", ".", "", ".", ".", "@", ".", "."],
            "score" => 0,
            "pacman" => 4,
            "ghost" => 8,
            "fruit" => 7
        ];
        $this->assertEquals($expected, json_decode($game->toJson(), true));
    }

    public function testMoveLeft()
    {
        $game = new Game(10);
        $game->pacman = 0;
        $game->moveLeft();
        $this->assertEquals(9, $game->pacman);

        $game->pacman = 5;
        $game->moveLeft();
        $this->assertEquals(4, $game->pacman);
    }

    public function testMoveRight()
    {
        $game = new Game(10);
        $game->pacman = 9;
        $game->moveRight();
        $this->assertEquals(0, $game->pacman);

        $game->pacman = 5;
        $game->moveRight();
        $this->assertEquals(6, $game->pacman);
    }
}
