<?php

chdir(__DIR__);

// Globals
global $db_user;
global $db_password;
global $db_host;
global $db_name;

// ClearDB
$clearDb = getenv('CLEARDB_DATABASE_URL');
$jawsDb = getenv('JAWSDB_URL');

if ($clearDb !== false) {
    $clearDb = strstr(substr($clearDb, strpos($clearDb, '://') + 3), '?', true);
    
    list($userAndPass, $hostAndDb) = explode('@', $clearDb);
    list($user, $pass) = explode(':', $userAndPass);
    list($host, $db) = explode('/', $hostAndDb);
    
    $db_user = $user;
    $db_password = $pass;
    $db_host = $host;
    $db_name = $db;
    
} elseif ($jawsDb !== false) {

    // $jawsDb = strstr(substr($jawsDb, strpos($jawsDb, '://') + 3), '?', true);

    list($userAndPass, $hostAndDb) = explode('@', $jawsDb);
    
    var_dump($userAndPass);
    var_dump($hostAndDb);

    list($user, $pass) = explode(':', $userAndPass);
    list($host, $db) = explode('/', $hostAndDb);
    
    
    $db_user = $user;
    $db_password = $pass;
    $db_host = $host;
    $db_name = $db;
} else {
    $db_user = getenv('DB_USER');
    $db_password = getenv('DB_PASSWORD');
    $db_host = getenv('DB_HOST');
    $db_name = getenv('DB_NAME');
}