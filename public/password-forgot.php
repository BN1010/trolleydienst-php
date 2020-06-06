<?php
spl_autoload_register();
include 'config.php';
$database_pdo = Tables\Database::get_connection();
$placeholder = array();

if(isset($_POST['password_reset'])) {

    if(DEMO) {
        $placeholder['message']['error'] = 'In der Demo Version darf das Passwort nicht zurück gesetzt werden!';
    } else {
        $username = include 'filters/post_username.php';
        $send_to_email = include 'filters/post_email.php';

        $id_user = Tables\Users::select_id_user($database_pdo, $username, $send_to_email);

        if($id_user == 0) {
            $placeholder['message']['error'] = 'Benutzername oder E-Mail existiert nicht!';
        }
        else {
            $generate_password = include 'helpers/generate_password.php';
            $new_password = $generate_password();

            if(Tables\Users::update_password($database_pdo, $id_user, $new_password)) {

                $get_template_email_password_forgot = include 'services/get_email_template.php';
                $email_template = $get_template_email_password_forgot($database_pdo, Tables\EmailTemplates::PASSWORD_FORGOT);

                $replace_with = array(
                    'NAME' => Tables\Users::select_name($database_pdo, $id_user),
                    'PASSWORD' => $new_password
                );

                $email_template_message = strtr($email_template['message'], $replace_with);

                $send_mail_plain = include 'modules/send_mail_plain.php';

                if($send_mail_plain($send_to_email, $email_template['subject'], $email_template_message))
                    $placeholder['message']['success'] = 'Dein neues Passwort wurde an <b>' . $send_to_email . '</b> versandt.';
                else
                    $placeholder['message']['error'] =
                        'Dein Passwort konnte nicht per E-Mail versendet werden!<br><br>Bitte prüfe ob die E-Mail Adresse ' .
                        EMAIL_ADDRESS_FROM . ',<br>bei deinem Webserver Provider, für den Versand angelegt ist.';
            } else {
                $placeholder['message']['error'] = 'Dein Passwort konnte nicht geändert werden!';
            }
        }
    }
}

echo App\Templates\Page::render($placeholder);
