<?php
$helpers = [
    'CommonHelper.php'
];

// 载入
foreach ($helpers as $helperFileName) {
    include __DIR__ . '/' . $helperFileName;
}