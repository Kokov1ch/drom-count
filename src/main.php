<?php

declare(strict_types=1);

if ($argc > 3 || $argc < 2) {
    echo "Usage: php src/main.php <directory> [--sanitize] \n";
    return -1;
}

$directory = $argv[1];
$sanitize = in_array('--sanitize', $argv, true);
$sum = 0;

if (!is_dir($directory) || !is_readable($directory)) {
    echo "Error: the provided path is not a readable directory\n";
    return -1;
}

foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $fileInfo) {
    if ($fileInfo->isFile() && 'count' === $fileInfo->getFilename()) {
        $content = file_get_contents($fileInfo->getPathname());

        $content = $sanitize ? preg_replace('/[^\d.\-\s]+/', ' ', $content) : $content;

        foreach (preg_split('/\s+/', trim($content)) as $number) {
            if (is_numeric($number)) {
                $sum += (float)$number;
            }
        }
    }
}

echo "Total count: $sum\n";
