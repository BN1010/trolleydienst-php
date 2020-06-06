<?php
session_start();
if(empty($_SESSION)) {
    header('location: /');
    return;
}

require __DIR__ . '/../vendor/autoload.php';

include 'config.php';
$database_pdo = App\Tables\Database::get_connection();
$placeholder = array();
$placeholder['shift_types'] = App\Tables\ShiftTypes::select_all($database_pdo);
return $placeholder;
