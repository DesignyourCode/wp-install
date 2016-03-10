<?php

chdir(__DIR__);

$placeholders = null;
$placeholderPattern = '/\%\%([A-Z_]+)\%\%/i';
$config = file_get_contents('../wp-config.php');

preg_match_all($placeholderPattern, $config, $placeholders);

foreach ($placeholders[1] as $placeholder) {
  $env = getenv($placeholder);

  if ($env !== FALSE) {
    $config = str_replace(
      '%%' . $placeholder . '%%',
      $env,
      $config
    );
  }
}

file_put_contents('../wp-config.php', $config);
