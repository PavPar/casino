<?php
include "./db.php";

$time = floor(time() / 60) * 60 + getData('time',true);

// createSession($session_name, $session_info, $game_slug, $time)

if(createSession(getData('name',true), getData('info',true), getGameSlug(getData('game_id',true)), $time)){
    echo('сессия создана');
}