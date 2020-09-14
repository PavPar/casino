<?php
include "../../php/db.php";

require "../../php/template.php";

function addRow($table,$row_data)
{

    if($table == 'user'){
        $field_name = 'id';
    }
    
    if($table == 'session'){
        $field_name = 'session_id';
    }
    
    if($table == 'role'){
        $field_name = 'role_id';
    }


  

    $parse = new parse_class;
    $div_string = "";
    $parse->get_tpl(getcwd() . '..\..\..\templates\admin\session-info.tpl');

    $parse->set_tpl('{FIELD}', $field_name );

    foreach ($row_data as $key => $val) {
        if ($val == '') {
            $val = 'null';
        }
        $div_string = $div_string . '<div style="text-align:center;border: 1px black solid;">[' . $key . ']<br> ' . $val . '</div>';
        $parse->set_tpl('{KEY}', $row_data[$field_name]);
    }

    $parse->set_tpl('{DATA}', $div_string);
    $parse->set_tpl('{TABLE}', $table);


  



    $parse->tpl_parse();
    return $parse->template;
}

function adminGetTableVals($table_name)
{
    $result = getAllFromTable($table_name);

    $res = '';
    while ($row = $result->fetch_assoc()) {
        $res = $res . addRow($table_name,$row);

    }

    return $res;
}

function addOption($row,$field_id,$field_name){
    return ' <option value="'.$row[$field_id].'">'.$row[$field_name].'</option>';
}

function getListOptions($table_name,$field_id,$field_name){
    $result = getAllFromTable($table_name);

    $res = '';
    while ($row = $result->fetch_assoc()) {
        $res = $res . addOption($row,$field_id,$field_name);
    }

    return $res;
}


function getValTPL($table_name){

    $parse = new parse_class;
    


    if($table_name == 'user'){
        $parse->get_tpl(getcwd() . '..\..\..\templates\admin\forms\user.tpl');
        $parse->set_tpl('{OPTIONS}', getListOptions('game','game_id','game_name'));
    }

    if($table_name == 'session'){
        $parse->get_tpl(getcwd() . '..\..\..\templates\admin\forms\session.tpl');
        $parse->set_tpl('{OPTIONS}', getListOptions('game','game_id','game_name'));
    }

    if($table_name == 'role'){
        $parse->get_tpl(getcwd() . '..\..\..\templates\admin\forms\role.tpl');
        $parse->set_tpl('{OPTIONS}', getListOptions('game','game_id','game_name'));
    }
    
    $parse->tpl_parse();
    return $parse->template;
}