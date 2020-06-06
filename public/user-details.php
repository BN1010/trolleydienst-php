<?php
if(!isset($_GET['id_user'])) {
    header('location: shift.php');
    return;
}

$placeholder = require 'includes/init_page.php';
$id_user = (int)$_GET['id_user'];
$user = Tables\Users::select_user($database_pdo, $id_user);
$placeholder['user'] = $user;

echo App\Templates\Page::render($placeholder);
