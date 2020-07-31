<?php
  require_once '../Core/init.php';

  if(Input::exists()){
    if(Token::check(Input::get('token'))){
      $validate = new Validation();
      $validation = $validate->check($_POST, array(
        'username' => array('required' => true),
        'password' => array('required' => true)
      ));

      if($validation->passed()){
				$user = new User();

				$remember = (Input::get('remember') === 'on') ? true : false;

        $login = $user->login(Input::get('username'), Input::get('password'), $remember);

        if($login){
          Redirect::to('index.php');
        }else {
          echo '<p>Sorry, logging in failed.</p>';
        }
      }else{
        foreach ($validation->errors() as $error) {
          echo $error, '<br>';
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
	<title>Document</title>
</head>
<body>
	<div class="container">
		<form action="" method="post" >
			<div class="field">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" autocomplete="off">
			</div>
			<div class="field">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" autocomplete="off">
			</div>
			<div class="field">
				<label for="remember">
					<input type="checkbox" id="remember" name="remember"> Remember me!
				</label>
			</div>
			<p>You can <a href="register.php">Register !!!</a></p>

			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
			<input type="submit" value="Log in!!!" class="button">
		</form>

	</div>

</body>
</html>

