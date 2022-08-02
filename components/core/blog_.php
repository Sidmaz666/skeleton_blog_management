<?php

function get_blogs($connection){
  $get_data_query = mysqli_query($connection,"SELECT *, ROW_NUMBER() OVER() AS ROW_NUM FROM blogs WHERE approved_status = 'TRUE' ORDER BY creation_time ASC");

  if($get_data_query){

    $check_existance = mysqli_num_rows($get_data_query);
    if($check_existance > 0){

	$fetch_all_blog = mysqli_fetch_all($get_data_query,MYSQLI_ASSOC);
      
	return json_encode($fetch_all_blog);

    }
    
  }

}



function get_category($connection){
  $get_data_query = mysqli_query($connection,"SELECT *, ROW_NUMBER() OVER() AS ROW_NUM FROM blog_categories ");

  if($get_data_query){

    $check_existance = mysqli_num_rows($get_data_query);
    if($check_existance > 0){

	$fetch_all_blog = mysqli_fetch_all($get_data_query,MYSQLI_ASSOC);
      
	return json_encode($fetch_all_blog);

    }
    
  }

}

function get_tags($connection){
  $get_data_query = mysqli_query($connection,"SELECT *, ROW_NUMBER() OVER() AS ROW_NUM FROM blog_tags ");

  if($get_data_query){

    $check_existance = mysqli_num_rows($get_data_query);
    if($check_existance > 0){

	$fetch_all_blog = mysqli_fetch_all($get_data_query,MYSQLI_ASSOC);
      
	return json_encode($fetch_all_blog);

    }
    
  }

}

function get_specific_blogs($connection,$filter,$filter_val){
  

  if($filter == 'blog_tags'){
  $get_data_query = mysqli_query($connection,"SELECT *, ROW_NUMBER() OVER() AS ROW_NUM FROM blogs WHERE $filter LIKE '%$filter_val%' AND  approved_status = 'TRUE' ");

  } else {
  $get_data_query = mysqli_query($connection,"SELECT *, ROW_NUMBER() OVER() AS ROW_NUM FROM blogs WHERE $filter = '$filter_val' AND  approved_status = 'TRUE' ");

  }

  if($get_data_query){

    $check_existance = mysqli_num_rows($get_data_query);
    if($check_existance > 0){

	$fetch_all_blog = mysqli_fetch_all($get_data_query,MYSQLI_ASSOC);
      
	return json_encode($fetch_all_blog);

    }
    
  }
}



function get_this_blog($connection,$blog_id){
  $get_data_query = mysqli_query($connection,"SELECT *, ROW_NUMBER() OVER() AS ROW_NUM FROM blogs WHERE approved_status = 'TRUE' AND blog_id = '$blog_id'");

  if($get_data_query){

    $check_existance = mysqli_num_rows($get_data_query);
    if($check_existance > 0){

	$fetch_all_blog = mysqli_fetch_all($get_data_query,MYSQLI_ASSOC);
      
	return json_encode($fetch_all_blog);

    }
    
  }

}

