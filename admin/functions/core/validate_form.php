<?php

function StringInfo(string $data,string $data_type,int $_limit){
  
  $initial_count = strlen($data);
  $new_data = strtolower(str_replace(' ', '', $data));
  $finalize_count = strlen($new_data);
  $error_ = array(
	'error_for' => $data_type,
  );


  if(empty($data)){
      $error_ = $error_ +  ['empty' => 1];
  }


  if(strlen($data) < $_limit ){
      $error_ = $error_ +  ['min_length' => 1];
  }


  if($data_type == "email"){
    if(!filter_var($data,FILTER_VALIDATE_EMAIL)){
      $error_ = $error_ +  ['invalid_email' => 1];
    }
  }


	
  $error_count = count($error_) - 1;

  $error_ = $error_ + ['total_error' => $error_count];

  array_unique($error_);


  return json_encode(array(
   'original_data' =>  $data,
   'initial_count' => $initial_count,
   'new_data' => $new_data,
   'finailze_count' => $finalize_count,
   'data_type' => $data_type,
   '_limit' => $_limit,
   'error_' => $error_,
  ));
  
}


?>
