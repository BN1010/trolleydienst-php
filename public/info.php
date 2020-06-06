<?php
$placeholder = require 'includes/init_page.php';
$placeholder['file_list'] = Tables\Infos::select_all($database_pdo);

echo App\Templates\Page::render($placeholder);
