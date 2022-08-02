<?php
function insertTags($connection,$tags,$added_by){

  $status=false;
  
  if(!empty($tags)){

    // Weird Algo Here
    $tags = preg_replace('/\,+/',' ',$tags);
    $tags = preg_replace('/\s+/',',',$tags);
    $tags = preg_replace('/\,+/',' ',$tags);
    $tags = preg_replace('/\s+/',',',$tags);
    
    $tags = explode(',',$tags);

foreach($tags as $tag){

$tag = preg_replace('/\s+/','_',$tag);

$run_check = mysqli_query($connection, "SELECT tag_name FROM blog_tags where tag_name = '$tag' ");
 
if(mysqli_num_rows($run_check) > 0){
  
  	unset($tags[array_search($tag,$tags)]);

	array_values($tags);

    }
}


    foreach($tags as $tag){

    $current_time = date('Y-m-d H:i:s');

    $insert_sql = "INSERT INTO blog_tags(tag_name,added_by,added_at) VALUES ('$tag','$added_by','$current_time')";

	     if(mysqli_query($connection,$insert_sql)){$status=true;}else{$status=false;}

	  }

     }
	return $status;
}
?>
