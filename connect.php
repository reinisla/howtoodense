<?php
$connection = mysql_connect('localhost', 'studiest', 'mmdprojects123');
if (!$connection){
    die("Database Connection Failed" . mysql_error());
}
$select_db = mysql_select_db('studiest_login');
if (!$select_db){
    die("Database Selection Failed" . mysql_error());
}