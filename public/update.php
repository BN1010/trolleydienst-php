<?php
spl_autoload_register();
    
if(!Tables\Database::exists_database()) {
    header('location: install.php');
    return;
}

include 'config.php';
$database_pdo = Tables\Database::get_connection();
$placeholder = array();

if($_POST)
{
    $get_database_version = include 'services/get_database_version.php';
    $update = include 'services/update.php';
    
    try {
        $database_version = $get_database_version($database_pdo);
        $success_migrations = $update($database_pdo, $database_version);

        if($success_migrations)
            $placeholder['message']['success']  =
                'Folgende Datenbank Migrationen wurden durchgeführt: ' . implode(', ', $success_migrations);
        else
            $placeholder['message']['success'] = 'Die Datenbank ist auf dem neusten Stand.';
    } catch (Exception $exc) {
        $placeholder['message']['error'] = $exc->getMessage();
    }
}
$is_uptodate = include 'services/is_uptodate.php';
$placeholder['is_up_to_date'] = $is_uptodate($database_pdo);

echo App\Templates\Page::render($placeholder);
