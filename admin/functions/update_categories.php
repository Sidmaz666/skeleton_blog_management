<?php

function insertCategory($connection,$cat_name,$cat_desc,$added_user){

$cat_name = preg_replace('/\s+/','_',$cat_name);

$run_check = mysqli_query($connection, "SELECT category_name FROM blog_categories where category_name = '$cat_name' ");
 
if(mysqli_num_rows($run_check) > 0){
  return false;
} else {

  if(!empty($cat_name) && !empty($cat_desc)){

    $current_time = date('Y-m-d H:i:s');

    $insert_sql = "INSERT INTO blog_categories(category_name,category_description,added_by,added_at) VALUES ('$cat_name','$cat_desc','$added_user','$current_time')";

	$run_query = mysqli_query($connection,$insert_sql);
    	if($run_query){
	return true;
      } else {return false;}

  }


}


}

?>
