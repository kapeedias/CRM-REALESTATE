<?php

// Define the required packages
$packages = [
    'symfony/css-selector' => '*',
    'symfony/dom-crawler' => '*'
];

// Generate the Composer command
$command = 'composer require ';

foreach ($packages as $package => $version) {
    $command .= $package . ':' . $version . ' ';
}

// Execute the Composer command
$output = shell_exec($command);

// Display the output
echo "<pre>$output</pre>";
