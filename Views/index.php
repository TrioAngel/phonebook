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

<?php
require_once '../Core/Router.php';
require_once '../Core/init.php';

if(Session::exists('home')){
  echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();
if($user->isLoggedIn()){
  ?>
	<div class="container">
		<div id="menu">
			<p>Hello <b><?php echo escape($user->data()->username); ?></b> !!!</p>
			<ul>
				<li><a href="profile.php?user=<?php echo escape($user->data()->id); ?>"><i class='fas fa-address-card'></i> Profile</a></li>
				<li><a href="logout.php"><i class='fas fa-door-open'></i> Log Out</a></li>
				<li><a href="update.php"><i class='fas fa-edit'></i> Update</a></li>
				<li><a href="changepassword.php"><i class='fas fa-wrench'></i> Change Password</a></li>
			</ul>
		</div>

  <?php
  if($user->hasPermission('admin')){
    echo '<p>You are an Administrator!</p></div>';
  } else{
  	echo '</div>';
  }

} else {
  echo "<div class='container'>
					<p id='begin'>You need to <a href='login.php'>Log In</a> or <a href='register.php'>Register</a>.</p>
				</div>";
}
?>
</body>
</html>

