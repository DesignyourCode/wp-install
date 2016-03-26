<?php

$receiveData = getenv('RECEIVE_DATA');

if ($receiveData === false) {
    exit;
}

$receiveData = json_decode($receiveData, true);
$password = substr(md5($receiveData['push_metadata']['request_id']), 0, 10);

exec(
    sprintf("wp core install --title=%s --admin_user='super' --admin_password=%s --admin_email=%s --skip-email"),
    escapeshellarg($receiveData['push_metadata']['app_info']['name']),
    escapeshellarg($password),
    escapeshellarg($receiveData['push_metadata']['email'])
);

echo 'Created admin user with username "super" and password "' . $password . '"';

