<?php
require_once '../Core/init.php';
require_once '../Core/Router.php';

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validation();
		$validation = $validate->check($_POST, [
			'surename' => [
				'required' => true,
				'min' => 2,
				'max' => 50
			],
			'number' => [
				'required' => true,
				'min' => 6,
				'max' => 64
			],
			'address' => [
				'required' => true,
				'min' => 2,
			],
			'email' => [
				'required' => true,
				'min' => 2,
				'max' => 64
			]
		]);

		if($validation->passed()){
			$adding = new Adding();
			$user = new User();
			$user_id = $user->data()->id;
			$username = $user->data()->username;

			try{
				$adding->create(array(
					'user_id' => $user_id,
					'name' => Input::get('surename'),
					'phone' => Input::get('number'),
					'address' => Input::get('address'),
					'email' => Input::get('email')
				));

				Redirect::to('profile.php?user='. $username);

			} catch (Exception $e){
				die($e->getMessage());
			}

		} else {
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
<div>
  <form action="" method="post">
    <div class="field">
      <label for="surename">Name</label>
      <input type="text" name="surename" id="surename">
    </div>
    <div class="field">
      <label for="number">Number</label>
      <input type="text" name="number" id="number">
    </div>
    <div class="field">
      <label for="address">Address</label>
      <input type="text" name="address" id="address">
    </div>
    <div class="field">
      <label for="email">Email</label>
      <input type="text" name="email" id="email">
    </div>
    <input type="submit" value="Add Number" class="button">
    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
  </form>
</div>
</body>
</html>
