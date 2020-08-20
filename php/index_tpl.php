<?php
include "db.php";

require getcwd() . '\php\template.php';


function getTpl()
{
    $parse = new parse_class;
    
    if (isUserLogged()) {
        $parse->get_tpl(getcwd() . '\templates\index\index-user.tpl');
        // switch ($i) {
        //     case 0:
        //         echo "i equals 0";
        //         break;
        //     case 1:
        //         echo "i equals 1";
        //         break;
        //     case 2:
        //         echo "i equals 2";
        //         break;
        // }
    } else {
        $parse->get_tpl(getcwd() . '\templates\index\index-hollow.tpl');
    }
    $parse->tpl_parse();
    echo $parse->template;
}
