<?php

require_once '../Core/init.php';

$user = new User;
$user_id = $user->data()->id;

$adding = new Adding();

$adding->delete($_GET['id']);

Redirect::to('profile.php?user=' . $user_id);