<?php
session_start();


$admin = TRUE;
	
require_once '../config/site_config.php';

require_once './functions/login.php'; 
require_once './functions/register.php'; 

require_once '../components/header.php';

if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
	include_once 'editor.php';
} else {
	include_once 'auth.php';
}

require_once '../components/footer.php';

?>


