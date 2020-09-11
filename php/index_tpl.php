<?php
include "db.php";
require __DIR__ . '\template.php';
$dir = __DIR__ .'\..\templates\index\\';

function getTpl()
{
    $parse = new parse_class;

    if (isUserLogged()) {
        if(isUserAdmin($_SESSION["user"]['id'])){
            $parse->get_tpl(getcwd() . '\templates\index\index-user.tpl');
            $parse->set_tpl('{LOGIN}', $_SESSION["user"]["username"]);
        }else{
            $parse->get_tpl(getcwd() . '\templates\index\index-admin.tpl');
            $parse->set_tpl('{LOGIN}', $_SESSION["user"]["username"]);
        }
        
    } else {
        $parse->get_tpl(getcwd() . '\templates\index\index-hollow.tpl');
    }
    $parse->tpl_parse();
    echo $parse->template;
}

function setCardTPL($name, $info, $currplayers, $maxplayers, $session_id)
{
    global $dir;
    $parse = new parse_class;

    if (isUserLogged()) {
        $parse->get_tpl($dir . 'session.tpl');
        $parse->set_tpl('{NAME}', $name);
        $parse->set_tpl('{INFO}', $info);
        $parse->set_tpl('{CURRPLAYERS}', countPlayers($session_id));
        $parse->set_tpl('{MAXPLAYERS}', maxPlayers($session_id));
        $parse->set_tpl('{SESSION_ID}', $session_id);
    } else {
        $parse->get_tpl($dir . 'session-hollow.tpl');
        $parse->set_tpl('{NAME}', $name);
        $parse->set_tpl('{INFO}', $info);
        $parse->set_tpl('{CURRPLAYERS}', countPlayers($session_id));
        $parse->set_tpl('{MAXPLAYERS}', maxPlayers($session_id));
    }
    $parse->tpl_parse();
    echo $parse->template;
}

function setGameDescTPL($name, $info, $game_name, $rules) 
{
    global $dir;
    $parse = new parse_class;
    $parse->get_tpl($dir . 'game-desc.tpl');
    $parse->set_tpl('{NAME}', $name);
    $parse->set_tpl('{INFO}', $info);
    $parse->set_tpl('{GAME_NAME}',  $game_name);
    $parse->set_tpl('{RULES}', $rules);
    $parse->tpl_parse();
    echo $parse->template;
}
