<?php
$placeholder = require 'includes/init_page.php';
$placeholder['shift_type_list'] = Tables\ShiftTypes::select_all($database_pdo);

echo App\Templates\Page::render($placeholder);
