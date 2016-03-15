<?php

chdir(__DIR__);

if (!file_exists('../salt.php')) {
    $salts = file_get_contents('http://api.wordpress.org/secret-key/1.1/salt/');
    file_put_contents('../salt.php', "<?php \n\n" . $salts);
}