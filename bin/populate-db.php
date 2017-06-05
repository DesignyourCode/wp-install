<?php

chdir(__DIR__);

// ClearDB
$clearDb = getenv('CLEARDB_DATABASE_URL');

if ($clearDb !== false) {
    $clearDb = strstr(substr($clearDb, strpos($clearDb, '://') + 3), '?', true);
    
    list($userAndPass, $hostAndDb) = explode('@', $clearDb);
    list($user, $pass) = explode(':', $userAndPass);
    list($host, $db) = explode('/', $hostAndDb);
    
    // $config = str_replace('%%DB_USER%%', $user, $config);
    // $config = str_replace('%%DB_PASSWORD%%', $pass, $config);
    // $config = str_replace('%%DB_HOST%%', $host, $config);
    // $config = str_replace('%%DB_NAME%%', $db, $config);
}

// @todo - auto support JawsDB
// @todo - fallback to individual fields for custom DB setup