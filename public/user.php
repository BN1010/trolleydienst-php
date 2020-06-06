<?php
$placeholder = require 'includes/init_page.php';

$user_list = Tables\Users::select_all($database_pdo);
$placeholder['user_list'] = $user_list;

echo App\Templates\Page::render($placeholder);
