<?php

include_once 'core/validate_form.php';
include_once 'core/check_in_db.php';

function loginUser($connection,$username,$password){

$get_data_sql = "SELECT * FROM users where username = '$username' && password = '$password'";

    $run_user_data_query = mysqli_query($connection,$get_data_sql);
    $check_existance = mysqli_num_rows($run_user_data_query);
    
    if ($check_existance > 0) {
	while ($user = mysqli_fetch_assoc($run_user_data_query)) {
		$firstName = $user['first_name'];
		$lastName = $user['last_name'];
		$userName = $user['username'];
		$email = $user['email'];
		$role = $user['role'];
		$id = $user['id'];
	}

$_SESSION['user'] = array(
  'first_name' => $firstName,
  'last_name' => $lastName,
  'fullname' => $firstName.' '.$lastName,
  'username' => $userName,
  'email' => $email,
  'role' => $role,
  'user_id' => $id
);

  } else {
    
    echo 'Wrong Username or Password';
  
  }

}

if (
  $_SERVER["REQUEST_METHOD"] == "POST" &&
 	 isset($_POST['loginBtn'])
	) {
	
	$check_username = json_decode(StringInfo($_POST['username'],'username',6));
	$check_password = json_decode(StringInfo($_POST['password'],'password',8));

	if(
	  $check_username->error_->total_error == 0 && 
	  $check_password->error_->total_error == 0 
	){

	  $username = $check_username->new_data;
	  $password = MD5($check_password->new_data);

	
	  loginUser($connection,$username,$password);


	}




	}



?>
