<?php

declare(strict_types=1);

$options = getopt('', [
    'sanitize::',
    'directory::'
]);

$directory = $options['directory'] ?? null;
$sanitize = isset($options['sanitize']);
$sum = 0;

if (!$directory) {
    echo "Usage: php src/main.php <directory> [--sanitize]\n";
    return -1;
}

if (!is_dir($directory) || !is_readable($directory)) {
    echo "Error: the provided path is not a readable directory\n";
    return -1;
}

foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file) {
    if (!$file->isFile() && 'count' !== $file->getFilename()) {
        continue;
    }

    $content = file_get_contents($file->getPathname());
    $content = $sanitize ? preg_replace('/[^\d.\-\s]+/', ' ', $content) : $content;

    foreach (preg_split('/\s+/', trim($content)) as $number) {
        if (is_numeric($number)) {
            $sum += (float) $number;
        }
    }
}

echo "Total count: $sum\n";
