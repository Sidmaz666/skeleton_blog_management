<?php

function get_categories($connection){
  $get_data_query = mysqli_query($connection,"SELECT *, ROW_NUMBER() OVER() AS ROW_NUM FROM blog_categories");

  if($get_data_query){

    $check_existance = mysqli_num_rows($get_data_query);
    if($check_existance > 0){

	$fetch_all_cat = mysqli_fetch_all($get_data_query,MYSQLI_ASSOC);
      
	return json_encode($fetch_all_cat);


    }
    
  }

}



function get_tags($connection){
  $get_data_query = mysqli_query($connection,"SELECT *, ROW_NUMBER() OVER() AS ROW_NUM FROM blog_tags");

  if($get_data_query){

    $check_existance = mysqli_num_rows($get_data_query);
    if($check_existance > 0){

	$fetch_all_tag = mysqli_fetch_all($get_data_query,MYSQLI_ASSOC);
      
	return json_encode($fetch_all_tag);

    }
    
  }

}


function get_all_blog($connection){
  $get_data_query = mysqli_query($connection,"SELECT *, ROW_NUMBER() OVER() AS ROW_NUM FROM blogs");

  if($get_data_query){

    $check_existance = mysqli_num_rows($get_data_query);
    if($check_existance > 0){

	$fetch_all_blog = mysqli_fetch_all($get_data_query,MYSQLI_ASSOC);
      
	return json_encode($fetch_all_blog);

    }
    
  }

}


function get_writer_blog($connection,$user){
  $get_data_query = mysqli_query($connection,"SELECT *, ROW_NUMBER() OVER() AS ROW_NUM FROM blogs WHERE submited_user_role = 'writer' AND submited_user='$user'");

  if($get_data_query){

    $check_existance = mysqli_num_rows($get_data_query);
    if($check_existance > 0){

	$fetch_all_blog = mysqli_fetch_all($get_data_query,MYSQLI_ASSOC);
      
	return json_encode($fetch_all_blog);

    }
    
  }

}


function get_requested_users($connection){
  $get_data_query = mysqli_query($connection,"SELECT *, ROW_NUMBER() OVER() AS ROW_NUM FROM request_users");

  if($get_data_query){

    $check_existance = mysqli_num_rows($get_data_query);
    if($check_existance > 0){

	$fetch_all_blog = mysqli_fetch_all($get_data_query,MYSQLI_ASSOC);
      
	return json_encode($fetch_all_blog);

    }
    
  }

}


