<?php
require_once '../Core/init.php';
require_once '../Core/Router.php';

$user = new User();

if(!$user->isLoggedIn()){
  Redirect::to('index.php');
}

if (Input::exists()){
  if(Token::check(Input::get('token'))){
    $validate = new Validation();
    $validation = $validate->check($_POST, array(
      'password_current' => array(
        'required' => true,
        'min' => 6
      ),
      'password_new' => array(
        'required' => true,
        'min' => 6
      ),
      'password_new_again' => array(
        'required' => true,
        'min' => 6,
        'matches' => 'password_new'
      )
    ));

    if ($validation->passed()){
      if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password){
        echo 'Your current password is wrong!!!';
      }else{
        $salt = Hash::salt(32);
        $user->update(array(
          'password' => Hash::make(Input::get('password_new'), $salt),
          'salt' => $salt
        ));

        Session::flash('home', 'Your password has been updated.');
        Redirect::to('index.php');
      }
    }else {
      foreach ($validation->errors() as $error){
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
	<form action="" method="post">
		<div class="field">
			<label for="password_current">Current Password</label>
			<input type="password" id="password_current" name="password_current">
		</div>
		<div class="field">
			<label for="password_new">New Password</label>
			<input type="password" id="password_new" name="password_new">
		</div>
		<div class="field">
			<label for="password_new_again">New Password again!</label>
			<input type="password" id="password_new_again" name="password_new_again">
		</div>

		<input type="submit" value="Change" class="button">
		<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	</form>

</div>

</body>
</html>

