<?php

chdir(__DIR__);

$placeholders = null;
$placeholderPattern = '/\%\%([A-Z_]+)\%\%/i';
$config = file_get_contents('../wp-config.php');

// ClearDB MySQL custom handling
$clearDb = getenv('CLEARDB_DATABASE_URL');

if ($clearDb !== false) {
    $clearDb = strstr(substr($clearDb, strpos($clearDb, '://') + 3), '?', true);
    
    list($userAndPass, $hostAndDb) = explode('@', $clearDb);
    list($user, $pass) = explode(':', $userAndPass);
    list($host, $db) = explode('/', $hostAndDb);
    
    $config = str_replace('%%DB_USER%%', $user, $config);
    $config = str_replace('%%DB_PASSWORD%%', $pass, $config);
    $config = str_replace('%%DB_HOST%%', $host, $config);
    $config = str_replace('%%DB_NAME%%', $db, $config);
}

// Write basic config variables
preg_match_all($placeholderPattern, $config, $placeholders);

foreach ($placeholders[1] as $placeholder) {
    $env = getenv($placeholder);

    if ($env !== FALSE) {
        $config = str_replace('%%' . $placeholder . '%%', $env, $config);
    }
}

// Write new config file
file_put_contents('../wp-config.php', $config);

// PHP Redis
$redis = getenv('REDIS_URL');

if ($redis !== false) {   
    $userini = file_get_contents('../.user.ini');

    list($redisPassword, $redisHost) = explode('@', $redis);
    list($redisUrl, $redisPass) = explode('h:', $redisPassword);

    $userini = str_replace('%%REDIS_HOST%%', $redisHost, $userini);
    $userini = str_replace('%%REDIS_PASS%%', $redisPass, $userini);

    file_put_contents('../.user.ini', $userini);
}