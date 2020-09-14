<?php
include 'db.php';

deleteValueFromTable(getData('table', true), getData('key', true), getData('id', true));
