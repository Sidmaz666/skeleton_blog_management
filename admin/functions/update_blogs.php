<?php

function insertNewBlog(
  $connection,
  $blog_title,
  $blog_content,
  $blog_description,
  $blog_category,
  $blog_tags,
  $blog_image,
  $_writer,
  $_writer_role
){


  if(
  !empty($blog_title) &&
  !empty($blog_content) &&
  !empty($blog_category) 
  ) {

    $blog_tags = implode(",",$blog_tags);

    if(empty($blog_description)){
	$blog_description = "Description For".$blog_title." Not Added Yet!";
    } else {
	$blog_description = preg_replace("/[\r\n]+/",'',$blog_description);
    }	

    if(empty($blog_image)){
      $blog_image="https://i.stack.imgur.com/5ykYD.png";
    }

    $approved_status = "FALSE";
    $blog_id = md5(microtime(true).mt_Rand());


    $insert_sql = "INSERT INTO blogs(blog_title,blog_data,blog_description,blog_category,blog_tags,submited_user,submited_user_role,approved_status,blog_image,blog_id) VALUES ('$blog_title','$blog_content','$blog_description','$blog_category','$blog_tags','$_writer','$_writer_role','$approved_status','$blog_image','$blog_id')";

	$run_query = mysqli_query($connection,$insert_sql);
    	if($run_query){
	  return true;
	} else {
	  return false;
	}


  }

}

if(
  isset($_POST['edit_blog_submitBtn']) &&
  $_POST['edit_blog_user_role'] == "admin" ||  
  $_POST['edit_blog_user_role'] == "publisher"  
	){

	  $blog_title = trim($_POST['edit_blog_title']);
	  $blog_data = trim($_POST['edit_blog_content']);
	  $blog_desc = trim($_POST['edit_blog_description']);
	  $blog_category = $_POST['edit_blog_category'];
	  $blog_tags = implode(",",$_POST['edit_blog_tags']);
	  $blog_image = $_POST['edit_blog_image'];
	
	  if(empty($blog_image)){
      		$blog_image="https://i.stack.imgur.com/5ykYD.png";
	  }

	  $blog_id = $_POST['edit_blog_id'];
	  $edited_by = $_POST['edit_blog_user'];



	  
	$update_sql = "UPDATE blogs SET blog_title = '$blog_title' , blog_data = '$blog_data' , blog_description = '$blog_desc' , blog_category = '$blog_category' , blog_tags = '$blog_tags', last_updated_by = '$edited_by' , blog_image ='$blog_image' WHERE blog_id = '$blog_id' ";

	  $update_query = mysqli_query($connection,$update_sql);
	
	  if(!$update_query){
	    echo 'Failed to Update the Blog!';
	  }

}
