<?php
// fix-permissions.php

// Path to your data directory
$path = __DIR__ . '/data';

// Check if folder exists
if (!is_dir($path)) {
    die("❌ Directory not found: $path");
}

// Try to change permissions
if (chmod($path, 0777)) {
    echo "✅ Permissions updated for $path (0777)<br>";
} else {
    echo "❌ Failed to change permissions on $path<br>";
}

// Optionally fix all files/subfolders too
$rii = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($rii as $file) {
    if ($file->isDir()) {
        chmod($file->getPathname(), 0777);
    } else {
        chmod($file->getPathname(), 0666);
    }
}

echo "✅ All files and folders inside $path updated.";
