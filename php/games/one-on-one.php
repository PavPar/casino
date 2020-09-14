<?php
include __DIR__ . "/gameInterface.php";

/*

Игра 50/50 для двух игроков
Победитель забирает деньги проигравшего

$userData
user_id - bet

 */
class random implements game
{
    //Точка входа в игру
    public function run($userData)
    {
        $players = array_keys($userData);
        $winnerID = $this->gamelogic($players);

        $gameResults = $this->payday($userData, $winnerID);

        return $gameResults;
    }

    //Логика игры
    private function gamelogic($players)
    {
        $winnerID = $players[rand(0, 1)];
        return $winnerID;
    }

    //Выплата игрокам
    private function payday($playersData, $winnerID)
    {
        $losersData = $playersData;
        unset($losersData[$winnerID]);

        $loserID = array_keys($losersData)[0];

        $playersData[$winnerID] = $playersData[$loserID];
        $playersData[$loserID] = -$playersData[$loserID];

        return $playersData;
    }
}
