<?php
$routes = [
    'getTracker',
    'getTrackers',
    'trackPackage',
    'metadata'
];
foreach ($routes as $file) {
    require __DIR__ . '/../src/routes/' . $file . '.php';
}
