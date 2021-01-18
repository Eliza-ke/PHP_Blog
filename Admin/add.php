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
	$file ='image/'.($_FILES['image']['name']);
	$imageType = pathinfo($file,PATHINFO_EXTENSION);

	if($imageType !='png' && $imageType !='jpg' && $imageType !='jpeg'){
		echo "<script>alert ('Image must bepng,jpg,jpeg') </script>";
	}
	else{
		$title = $_POST['title'];
		$content = $_POST['content'];
		$image = $_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'], $file);

		$pdostatement =$pdo->prepare("INSERT INTO posts (title,content,image,author_id) VALUES (:title ,:content,:image,:author_id)");
		$result = $pdostatement->execute(
			array(
				':title' => $title,
				':content' => $content,
				':image' => $image,
				':author_id' => $_SESSION['user_id']
			)
		);
		if ($result) {
			echo "<script>alert('Successfully Added!');window.location.href='index.php' </script>";
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
                <h3 class="card-title">Create New Post</h3>
              </div>              
              <!-- /.card-header -->

              <div class="card-body">
              	<form action="add.php" method="post" enctype="multipart/form-data">
              		<div class="form-group">
              			<label>Title</label>
              			<input type="text" name="title" class="form-control" required>
              		</div>
              		<div class="form-group">
              			<label>Content</label>
              			<textarea class="form-control" name="content"></textarea>
              		</div>
              		<div class="form-group">
              			<label>Image</label>
              			<input type="file" name="image" class="form-control">
              		</div>
              		<div class="form-group">
              			<input type="submit" class="btn btn-success" value="Add">
              			<a href="index.php" type="button" class="btn btn-primary">Back</a>
              		</div>
              	</form>
              </div>

<?php include ('footer.php') ?>