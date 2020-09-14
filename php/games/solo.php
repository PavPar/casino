<?php
include __DIR__ . "/gameInterface.php";

/*

Игра против казино
Победить, разумеется, нельзя

$userData
user_id - bet

 */

class solo implements game
{
    //Точка входа в игру
    public function run($userData)
    {
        $playerId = array_keys($userData)[0];
        $gameResults = $this->makeMoneyDisappear($playerId, $userData[$playerId]);

        return $gameResults;
    }
    private function makeMoneyDisappear($id, $bet)
    {
        return [$id => -$bet];
    }
}