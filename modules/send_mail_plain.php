<?php
return function ($to, $subject, $message) {

    $headers   = array();
    $headers[] = 'Content-type: text/plain; charset=utf-8';
    $headers[] = 'From: =?UTF-8?B?'.base64_encode(APPLICATION_NAME . ' - ' . CONGREGATION_NAME).'?=<' . EMAIL_ADDRESS_FROM . '>';
    $headers[] = 'Reply-To: ' . TEAM_NAME . ' <' . EMAIL_SUPPORT . '>';

    return mail($to, $subject, $message, implode("\r\n",$headers));
};