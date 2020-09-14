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

function setCardTPL($name, $info, $currplayers, $maxplayers, $session_id, $state)
{
    global $dir;
    $parse = new parse_class;
    $pcount = countPlayers($session_id);
    $maxcount = maxPlayers($session_id);

    $parse->get_tpl($dir . 'session.tpl');
    $parse->set_tpl('{NAME}', $name);
    $parse->set_tpl('{INFO}', $info);
    $parse->set_tpl('{CURRPLAYERS}', $pcount);
    $parse->set_tpl('{MAXPLAYERS}', $maxcount);
    $parse->set_tpl('{SESSION_ID}', $session_id);
    $parse->set_tpl('{STATE}', $state);
    $parse->set_tpl('{HIDDEN}', isUserLogged() && ($pcount != $maxcount) ? '' : 'hidden');
    $parse->tpl_parse();
    echo $parse->template;
}

function setGameDescTPL($name, $info, $game_name, $rules, $slug) 
{
    global $dir;
    $parse = new parse_class;
    $parse->get_tpl($dir . 'game-desc.tpl');
    $parse->set_tpl('{NAME}', $name);
    $parse->set_tpl('{INFO}', $info);
    $parse->set_tpl('{GAME_NAME}',  $game_name);
    $parse->set_tpl('{RULES}', $rules);
    $parse->set_tpl('{SLUG}', $slug);
    $parse->tpl_parse();
    echo $parse->template;
}
