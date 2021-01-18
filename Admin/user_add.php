<?php
require '../config/config.php';
session_start();

if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])){
  header('location: login.php');
}
if($_SESSION['role'] != 1){
   header('location: login.php');
}

if($_POST){

		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
    if(empty($_POST['role'])){
      $role = 0;
    }else {
      $role =1;
    }

    $stmt =$pdo->prepare("SELECT * FROM user WHERE email=:email");
    $stmt->bindValue(':email',$email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        echo "<script>alert('Email duplicate')</script>";
    }else{
		
    $stmt =$pdo->prepare("INSERT INTO user (name,email,password,role) VALUES (:name ,:email,:password,:role)");
		$result = $stmt->execute(
			array(
				':name' => $name,
				':email' => $email,
				':password' => $password,
				':role' => $role
			)
		);
		if ($result) {
			echo "<script>alert('Successfully Added!');window.location.href='user_list.php' </script>";
		}
	}
}	
?>

<?php include ('header.php') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
     
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <div class="card">
              <div class="card-header" style="background: #eee">
                <h3 class="card-title">Create New User Account</h3>
              </div>              
              <!-- /.card-header -->

              <div class="card-body">
              	<form action="user_add.php" method="post" enctype="multipart/form-data">
              		<div class="form-group">
              			<label>Name</label>
              			<input type="text" name="name" class="form-control" required>
              		</div>
              		<div class="form-group">
              			<label>Email</label>
              			<input type="email" name="email" class="form-control" required>
              		</div>
              		<div class="form-group">
              			<label>Password</label>
              			<input type="password" name="password" class="form-control" required>
              		</div>
                  <div class="form-group">
                    <label>Admin</label>
                    <input type="checkbox" name="role">                   
                  </div>
              		<div class="form-group">
              			<input type="submit" class="btn btn-success" value="Add">
              			<a href="user_list.php" type="button" class="btn btn-primary">Back</a>
              		</div>
              	</form>
              </div>

<?php include ('footer.php') ?>