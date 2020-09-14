<?php
include "./db.php";

if(createSession(getData('name',true), getData('info',true),getData('game_id',true))){
    echo('сессия создана');
}