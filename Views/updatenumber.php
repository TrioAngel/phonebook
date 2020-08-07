<?php

require_once '../Core/init.php';

$user = new User;
$adding = new Adding();
$array = $adding->numberResult($_GET['id']);


if(!$user->isLoggedIn()){
  Redirect::to('index.php');
}

if(Input::exists()){
  if(Token::check(Input::get('token'))){
    $validate = new Validation();
    $validation = $validate->check($_POST, array(
      'name' => array(
        'required' => true,
        'min' => 2,
        'max' => 50
      ),
      'phone' => array(
        'required' => true,
        'min' => 2,
      ),
      'address' => array(
        'required' => true,
        'min' => 2,
      ),
      'email' => array(
        'required' => true,
        'min' => 2,
        'max' => 64
      )
    ));

    if ($validation->passed()){
      try {
        $adding->update($array['id'], array(
          'user_id' => $array['user_id'],
          'name' => Input::get('name'),
          'phone' => Input::get('phone'),
          'address' => Input::get('address'),
          'email' => Input::get('email')
        ));

        Redirect::to('profile.php?user=' . $array['user_id']);
      } catch (Exception $e){
        die($e->getMessage());
      }
    } else {
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
  <link rel="stylesheet" href="Css/style.css">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>

  <title>Document</title>
</head>
<body>
<div class="container">
  <form action="" method="post">
    <div class="field">
      <label for="name">Name</label>
      <input type="text" name="name" id="name" value="<?php echo escape($array['name']);?>">
    </div>
    <div class="field">
      <label for="phone">Number</label>
      <input type="text" name="phone" id="phone" value="<?php echo escape($array['phone']);?>">
    </div>
    <div class="field">
      <label for="address">Address</label>
      <input type="text" name="address" id="address" value="<?php echo escape($array['address']);?>">
    </div>
    <div class="field">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" value="<?php echo escape($array['email']);?>">
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
