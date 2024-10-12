#!/usr/bin/env php
<?php

/*! PHP Cowsay */

$api_url = 'https://techy-api.vercel.app/api/text';
$context = stream_context_create(array(
  'http' => array(
    'method' => 'GET'
  )
));
$response = file_get_contents($api_url, false, $context);

if($response === FALSE) {
  $response = 'Cowsay.';
}
$message = trim($response);

$lines = explode("\n", wordwrap($message, 40, "\n", true));
$max_length = 0;
foreach($lines as $line) {
  $length = mb_strwidth($line, 'UTF-8');
  if($length > $max_length) {
    $max_length = $length;
  }
}

echo ' ' . str_repeat('_', $max_length + 2) . "\n";
foreach($lines as $line) {
  printf("< %-" . $max_length . "s >\n", $line);
}
echo ' ' . str_repeat('-', $max_length + 2) . "\n";

$cow = <<<EOL
        \   ^__^
         \  (oo)\_______
            (__)\       )\/\
                ||----w |
                ||     ||
EOL;

echo $cow . "\n";
