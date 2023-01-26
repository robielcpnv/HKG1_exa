<?php

require '../vendor/autoload.php';
require '../app/routes.php';

define('BASE_DIR', dirname( __FILE__ ) . '/..');

Flight::register('db', '\PDO', array('mysql:host=localhost;dbname=kolok','test','test'));
require '../app/auth.php';

Flight::start();
