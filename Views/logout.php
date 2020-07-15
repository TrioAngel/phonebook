<?php
require_once '../Core/init.php';
require_once '../Core/Router.php';

$user = new User();
$user->logOut();

Redirect::to('index.php');