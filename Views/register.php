<?php
require_once '../Core/init.php';

if(Input::exists()){
	if(Token::check(Input::get('token'))) {
    $validate = new Validation();
    $validation = $validate->check($_POST, [
      'username' => [
        'required' => TRUE,
        'min' => 2,
        'max' => 25,
        'unique' => 'users'
      ],
      'password' => [
        'required' => TRUE,
        'min' => 6
      ],
      'password_again' => [
        'required' => TRUE,
        'match' => 'password'
      ],
      'name' => [
        'required' => TRUE,
        'min' => 2,
        'max' => 50
      ]
    ]);

    if ($validation->passed()) {
    	$user = new User();
    	$salt = Hash::salt(32);
    	try {
    		$user->create(array(
          'username' => Input::get('username'),
          'password' => Hash::make(Input::get('password'), $salt),
    			'salt' => $salt,
    			'name' => Input::get('name'),
    			'joined' => date('Y-m-d H:i:s'),
    			'group' => 1
		    ));

    		Session::flash('home', 'you have been registered and now can log in.');
    		Redirect::to('../Views/index.php');

	    }catch (Exception $e){
    		die($e->getMessage());
	    }
    }
    else {
      foreach ($validation->errors() as $error) {
        echo "
          <p style='text-align: center'>$error</p>
        ";      }
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
	<form action="" method="post">
		<div class="field">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
		</div>
		<div class="field">
			<label for="password_again">Password</label>
			<input type="password" name="password" id="password">
		</div>
		<div class="field">
			<label for="password_again">Password again</label>
			<input type="password" name="password_again" id="password_again">
		</div>
		<div class="field">
			<label for="name">Name</label>
			<input type="text" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name">
		</div>
		<p>Have an account than <a href="login.php">Login !!!</a></p>
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<input type="submit" value="Register" class="button">
	</form>

</div>

</body>
</html>

