<?php
require 'config/config.php';
session_start();

if($_POST){
	$email =$_POST['email'];
	$password = $_POST['password'];

	$stmt = $pdo->prepare("SELECT * FROM user WHERE email=:email");
	$stmt->bindValue(':email',$email);
	$stmt->execute();

	$user = $stmt->fetch(PDO::FETCH_ASSOC); 

	if($user){
		if($user['password'] == $password){
			
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['name'] = $user['name'];
			$_SESSION['logged_in'] = time();

			header('location:index.php');
		}
	}
	echo "<script>alert ('Incorrect email or password') </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Blog | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition login-page">

<div class="login-box" style="background: lightgreen; padding-top: 5px;">
  <div class="login-logo">
   	<h2 style="color: green"><b>Blog</b>Login</h2>
  </div>

  <div class="card" >
    <div class="card-body login-card-body">
      <p class="login-box-msg" >Sign in to start your session</p>

      <form action="login.php" method="post">

        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="container">
            <button type="submit" class="btn btn-success btn-block">Sign In</button>
            <a href="register.php" type="button" class="btn btn-defaul btn-block">Register</a>
        </div>

      </form>

      <!--
      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
	-->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
