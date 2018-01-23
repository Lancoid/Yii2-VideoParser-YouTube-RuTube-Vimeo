<?php
$db = require __DIR__ . '/db.php';
$db['dsn'] = 'mysql:host=localhost;dbname=example_tests';

return $db;
