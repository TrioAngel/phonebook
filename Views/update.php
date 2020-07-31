<?php
require_once '../Core/init.php';
require_once '../Core/Router.php';

$user = new User();

if(!$user->isLoggedIn()){
  Redirect::to('index.php');
}

if (Input::exists()){
  if (Token::check(Input::get('token'))) {
    $validate = new Validation();
    $validation = $validate->check($_POST, array(
      'name' => array(
        'required' => TRUE,
        'min' => 2,
        'max' => 50
      )
    ));

    if ($validation->passed()) {
			try{
				$user->update(array(
					'name' => Input::get('name')
				));

				Session::flash('home', 'Your details have been updated.');
				Redirect::to('index.php');
	    } catch(Exception $e){
				die($e->getMessage());
	    }
    }
    else {
      foreach ($validation->errors() as $error) {
        echo "
          <p style='text-align: center'>$error</p>
        ";
      }
    }
  }
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
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>

	<title>Document</title>
</head>
<body>
<div class="container">
	<form action="" method="post">
		<div class="field">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" value="<?php echo escape($user->data()->name);?>">
		</div>


		<input type="submit" value="Update" class="button">
		<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	</form>

	<div class="backArrow">
		<a href="index.php"><i class='fas'>&#xf060;</i>  <span>Back to Menu</span></a>
	</div>

</div>

</body>
</html>

