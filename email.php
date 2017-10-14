<?php
$placeholder = require 'includes/init_page.php';

if(isset($_POST['send']) && !empty($_POST['email_subject']) && !empty($_POST['email_message'])) {

    $placeholder['email'] = array();
    $placeholder['email']['subject'] = $_POST['email_subject'];
    $placeholder['email']['message'] = $_POST['email_message'];

    $placeholder['user_list'] = Tables\Users::select_all_email($database_pdo);

    if(empty($placeholder['user_list']))
        $placeholder['message']['error'] = 'Es wurden keine E-Mail Adresse für den Versand gefunden!';
    else {
        $placeholder['message']['success'] = 'E-Mail wurde versendet an:';

        foreach ($placeholder['user_list'] as $user) {
            $replace_with = array(
                'NAME' => $user['name']
            );
            $email_message = strtr($placeholder['email']['message'], $replace_with);

            $send_mail_plain = include 'modules/send_mail_plain.php';
            if($send_mail_plain($user['email'], $placeholder['email']['subject'], $email_message))
                $placeholder['user_list'][] = $user;
        }
    }
} else {
    $get_email_template = include 'services/get_email_template.php';
    $placeholder['email'] = $get_email_template($database_pdo);
}

$render_page = include 'includes/render_page.php';
echo $render_page($placeholder);