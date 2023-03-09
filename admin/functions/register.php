<?php


include_once 'core/validate_form.php';
include_once 'core/check_in_db.php';
include_once '../config.php';


function registerUser($conn,$username,$firstname,$lastname,$email,$role,$password){
  if($conn){

   $user_registration = mysqli_query($conn,"INSERT INTO request_users(first_name,last_name,username,email,role,password) VALUES('$firstname','$lastname','$username','$email','$role','$password')");

   if($user_registration){

     echo "$username has Requested For an Account. Please wait for Admin Approval!";
   
   } else {
   
   
     echo "Unable to request an account for $username!";
   
   
   }

  }
}


if (
  $_SERVER["REQUEST_METHOD"] == "POST" &&
 	 isset($_POST['registerBtn'])
	) {
	

	$check_username = json_decode(StringInfo($_POST['username'],'username',6));
	$check_firstname = json_decode(StringInfo($_POST['first_name'],'first_name',3));
	$check_lastname = json_decode(StringInfo($_POST['last_name'],'last_name',3));
	$check_email = json_decode(StringInfo($_POST['email'],'email',6));
	$check_role = json_decode(StringInfo($_POST['role'],'role',5));
	$check_password = json_decode(StringInfo($_POST['password'],'password',8));

	if(
	  $check_username->error_->total_error == 0 && 
	  $check_firstname->error_->total_error == 0 &&
	  $check_lastname->error_->total_error == 0 &&
	  $check_email->error_->total_error == 0 && 
	  $check_role->error_->total_error == 0 &&
	  $check_password->error_->total_error == 0 
	){

	  $username = $check_username->new_data;
	  $first_name = $check_firstname->new_data;
	  $last_name = $check_lastname->new_data;
	  $email = $check_email->new_data;
	  $role = $check_role->new_data;
	  $password = MD5($check_password->new_data);

	
	$check_email_already_registered_u = DatainDB($connection,'users','email',$email);
	$check_username_already_registered_u = DatainDB($connection,'users','username',$username);
	$check_email_already_registered_ru = DatainDB($connection,'request_users','email',$email);
	$check_username_already_registered_ru = DatainDB($connection,'request_users','username',$username);


	if(
	  $check_email_already_registered_u == 'FALSE' && $check_email_already_registered_ru == 'FALSE' &&
	  $check_username_already_registered_u == 'FALSE' && $check_username_already_registered_ru == 'FALSE'
	)
	{

	  registerUser($connection,$username,$first_name,$last_name,$email,$role,$password);
	  echo "$username has requested for an account. Please Wait for ADMIN Approval!";

	} else {
	  echo "User is Probably Already Registered or have send a request for account!";
	}


	} else {

	  echo "Error While Validating User Inputs!";
	
	}


	}

?>
