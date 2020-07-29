<?php
require_once '../Core/init.php';
require_once '../Core/Router.php';


if(!$username = Input::get('user')){
  Redirect::to('index.php');
} else {
  $user = new User($username);
  $adding = new Adding();
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
		<link rel="stylesheet" href="../Css/profie.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<title>Document</title>
	</head>
	<body>
	<header>
		<h2><i><?php echo escape($data->name);?>`s Profile</i></h2>
	</header>

	<main>
		<div class="container">
			<h3 align="right"><button class="btn btn-dark"><a href="addnumber.php">Adding Number</a></button></h3>

				<table class="table table-dark table-hover table-bordered" width="100%">
					<thead>
					<tr>
						<th scope="col">Name</th>
						<th scope="col">Number</th>
						<th scope="col">Address</th>
						<th scope="col">Email</th>
					</tr>
					</thead>
					<tbody>
             <?php
                echo $adding->results($data->id);
              ?>
					</tbody>
				</table>
		</div>
	</main>

	<footer>
		<p>With love by <i>RedAngel</i></p>
	</footer>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	</body>
	</html>
<?php
}