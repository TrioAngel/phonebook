<?php
require_once '../Core/init.php';
require_once '../Core/Router.php';

if(!$username = Input::get('user')){
  Redirect::to('index.php');
} else {
  $user = new User($username);
  if(!$user->exists()){
    Redirect::to(404);
  } else {
    $data = $user->data();
  }
  ?>
	<!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport"
		      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="../Css/style.css">
		<title>Document</title>
	</head>
	<body>
	<header>
		<h2>Hello <?php echo escape($data->name);?></h2>
	</header>

	<main>
		<h3><a href="addnumber.php">Adding Number</a></h3>


	</main>

	<footer>
		<p>With love by RedAngel</p>
	</footer>
	</body>
	</html>
<?php
}