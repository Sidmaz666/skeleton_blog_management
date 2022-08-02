<?php

if(
  isset($_POST['action']) &&
  $_POST['action'] == "add_comment" &&
  !empty($_POST['email']) &&
  !empty($_POST['name']) &&
  !empty($_POST['blog_id']) &&
  !empty($_POST['msg'])
){
  $email = trim($_POST['email']);
  $name = trim($_POST['name']);
  $comment = trim($_POST['msg']);
  $id = $_POST['blog_id'];

  $insert_sql = "INSERT INTO comments(blog_id, username, email, comment) VALUES ('$id','$name','$email','$comment')";

	
  mysqli_query($connection,$insert_sql);

} 

?>
