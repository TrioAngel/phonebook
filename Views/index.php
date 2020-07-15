<?php
require_once '../Core/Router.php';
require_once '../Core/init.php';

if(Session::exists('home')){
  echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();
if($user->isLoggedIn()){
?>
  <p><a href="profile.php?user=<?php echo escape($user->data()->username); ?>">Hello <mark><?php echo escape($user->data()->username); ?></mark>!!!</a></p>
  <ul>
	  <li><a href="logout.php">Log Out</a></li>
	  <li><a href="update.php">Update</a></li>
	  <li><a href="changepassword.php">Change Password</a></li>
  </ul>
<?php
	if($user->hasPermission('admin')){
		echo '<p>You are an administrator!</p>';
	}

} else {
  echo "<p>You need to <a href='login.php'>Log In</a> or <a href='register.php'>Register</a>.</p>";
}
