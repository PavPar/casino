<?php
include __DIR__ . "/gameInterface.php";

/*

Игра 50/50 для двух игроков
Победитель забирает деньги проигравшего

$userData
user_id - bet

 */
class russian implements game
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
        $winnerID = $players[rand(0, count($players) - 1)];
        return $winnerID;
    }

    //Выплата игрокам
    private function payday($playersData, $winnerID)
    {
        $losersData = $playersData;
        unset($losersData[$winnerID]);

        $losers = array_keys($losersData);
        $sum = 0
        foreach ($losers as $loser) {
          $playersData[$loser] = -$playersData[$loser]; 
          $sum += $playersData[$loser]
        }
        $playersData[$winnerID] = $sum;

        return $playersData;
    }
}
