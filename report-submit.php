<?php
$placeholder = require 'includes/init_page.php';

if(isset($_POST['save'])) {
	Tables\Reports::delete_old_entries($database_pdo);

	$date_from = include 'filters/post_date_from.php';

	$merge_date_and_time = include 'modules/merge_date_and_time.php';
	$shift_datetime_from = $merge_date_and_time($date_from, $_POST['time_from']);

	$report = new Models\Report(
		(int)$_POST['id_shift_type'],
		Tables\Users::select_name($database_pdo, (int)$_POST['id_user']),
		include 'filters/post_route.php',
		(int)$_POST['book'],
		(int)$_POST['brochure'],
		(int)$_POST['bible'],
		(int)$_POST['magazine'],
		(int)$_POST['tract'],
		(int)$_POST['address'],
		(int)$_POST['talk'],
        include 'filters/post_note_user.php',
		$shift_datetime_from
	);
	if(Tables\Reports::insert($database_pdo, $report))
		$placeholder['message']['success'] = 'Dein Bericht wurde gespeichert.';
	else
		$placeholder['message']['error'] = 'Dein Bericht konnte nicht gespeichert werden!';
}

$placeholder['user_list'] = Tables\Users::select_all($database_pdo);
$placeholder['route_list'] = Tables\Shifts::select_route_list($database_pdo, 1);
$placeholder['shifttype_list'] = Tables\ShiftTypes::select_all($database_pdo);

$render_page = include 'includes/render_page.php';
echo $render_page($placeholder);