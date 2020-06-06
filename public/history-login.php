<?php
$placeholder = require 'includes/init_page.php';
$placeholder['login_error_list'] = Tables\History::select_all($database_pdo, array(Tables\History::LOGIN_ERROR));

echo App\Templates\Page::render($placeholder);
