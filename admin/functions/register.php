<?php


include_once 'core/validate_form.php';
include_once 'core/check_in_db.php';
include_once '../config.php';


function registerUser($conn,$username,$firstname,$lastname,$email,$role,$password,$is_admin){
  if($conn){

    if(!$is_admin && $role == "admin"){
     $role = "writer";
    }

   $user_registration = mysqli_query($conn,"INSERT INTO users(first_name,last_name,username,email,role,password) VALUES('$firstname','$lastname','$username','$email','$role','$password')");

   if($user_registration){

     echo "$username Registered!";
   
   } else {
   
   
     echo "Unable to Register $username!";
   
   
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

	$check_email_already_registered = DatainDB($connection,'email',$_POST['email'],'email');
	$check_username_already_registered = DatainDB($connection,'username',$_POST['email'],'username');

//	print_r(json_encode(array($check_username,$check_firstname,$check_lastname,$check_email,$check_role,$check_password,$check_email_already_registered)));	
	if(
	  $check_username->error_->total_error == 0 && 
	  $check_firstname->error_->total_error == 0 &&
	  $check_lastname->error_->total_error == 0 &&
	  $check_email->error_->total_error == 0 && 
	  $check_role->error_->total_error == 0 &&
	  $check_password->error_->total_error == 0 &&
	  $check_email_already_registered == false &&
	  $check_username_already_registered == false
	){

	  $username = $check_username->new_data;
	  $first_name = $check_firstname->new_data;
	  $last_name = $check_lastname->new_data;
	  $email = $check_email->new_data;
	  $role = $check_role->new_data;
	  $password = MD5($check_password->new_data);

	
	  registerUser($connection,$username,$first_name,$last_name,$email,$role,$password,$is_admin_role);


	} else {
	  echo "User is Probably Already Registered!";
	}


	}

?>
