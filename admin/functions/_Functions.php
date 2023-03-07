<?php

if(isset($_POST['action']) &&
  $_POST['action'] == "delete" &&
  $_POST['field'] == "category"
){

  $category_name=$_POST['category_name'];
  $category_id=$_POST['category_id'];

  mysqli_query($connection,"DELETE FROM blog_categories WHERE category_name = '$category_name' && id = '$category_id' ");

}



if(isset($_POST['action']) &&
  $_POST['action'] == "update" &&
  $_POST['field'] == "category"
){

  $category_name=$_POST['category_name'];
  $category_description=$_POST['category_description'];
  $category_id=$_POST['category_id'];

  mysqli_query($connection,"UPDATE blog_categories SET category_name = '$category_name', category_description = '$category_description' WHERE id = '$category_id' ");

}


if(isset($_POST['action']) &&
  $_POST['action'] == "delete" &&
  $_POST['field'] == "tag"
){

  $tag_name=$_POST['tag_name'];
  $tag_id=$_POST['tag_id'];

  mysqli_query($connection,"DELETE FROM blog_tags WHERE tag_name = '$tag_name' && id = '$tag_id' ");

}



if(isset($_POST['action']) &&
  $_POST['action'] == "update" &&
  $_POST['field'] == "tag"
){

  $tag_name=preg_replace("/\s+/",'',preg_replace("/[\r\n]+/",'',$_POST['tag_name']));
  $tag_id=$_POST['tag_id'];

  mysqli_query($connection,"UPDATE blog_tags SET tag_name = '$tag_name' WHERE id = '$tag_id' ");

}



if(isset($_POST['action']) &&
  $_POST['action'] == "delete" &&
  $_POST['field'] == "blog"
){

  $blog_id=$_POST['blog_id'];

  mysqli_query($connection,"DELETE FROM blogs WHERE blog_id = '$blog_id' ");

}

if(isset($_POST['action']) &&
  $_POST['action'] == "approve_post" &&
  $_POST['field'] == "blog" &&
  $_POST['role'] == "admin" || $_POST['role'] == "publisher"
){

  $blog_id=$_POST['blog_id'];
  $user=$_POST['user'];
  $user_role = $_POST['role'];
  
  $publish_action=$_POST['publish_action'];

  if($publish_action == "TRUE" || $publish_action == "FALSE"){
    $publish_action=$_POST['publish_action'];
  } else {
    $publish_action = "FALSE";
  }

  $curr_datetime = date('Y-m-d H:i:s');

  mysqli_query($connection,"UPDATE blogs SET approved_status = '$publish_action' , approved_by = '$user', published_at = '$curr_datetime', last_updated_by = '$user' WHERE blog_id = '$blog_id' ");

}

if(isset($_POST['action']) &&
  $_POST['action'] == "edit_post" &&
  $_POST['field'] == "blog" 
){

  $blog_id=$_POST['blog_id'];


  $get_data_query = mysqli_query($connection,"SELECT * FROM blogs WHERE blog_id = '$blog_id' ");

    $check_existance = mysqli_num_rows($get_data_query);
    if($check_existance > 0){

	$fetch_blog = json_encode(mysqli_fetch_all($get_data_query,MYSQLI_ASSOC));
      
	return $fetch_blog;

    }

}



