<?php
include_once 'autoloader.php';

use vendor\Route;

define('APP', dirname(__FILE__) . '/app/');
Route::run();