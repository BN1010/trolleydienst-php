<?php
$placeholder = require 'includes/init_page.php';
$placeholder['system_error_list'] = Tables\History::select_all($database_pdo, array(Tables\History::SYSTEM_ERROR));

echo App\Templates\Page::render($placeholder);
