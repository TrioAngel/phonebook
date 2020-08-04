<?php
require_once '../Core/init.php';

$user = new User();
$user->logOut();

Redirect::to('index.php');