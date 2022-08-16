<?php
//Set Appropiate Timezone
date_default_timezone_set("Asia/Kolkata");


// Name should match with the Site Root Folder Important!
$what_blog = "justmyblogs";
// Site Title
$site_title = "Welcome to Just-Blogs";
// Global CSS/Tailwind CSS Styles Not Applied to the Blog Page.
$site_css_url_normal_home = "css/style.css";
$site_css_url_admin = "../css/style.css";
// Custom Stylesheet To style Blog Page
$site_css_url_normal_blog = "css/blogLayout.css";

//$site_logo_main=""

// Social Media Links For Site Widget
$widget_facebook_link = "";
$widget_instagram_link = "";
$widget_twitter_link = "";
$widget_github_link = "https://github.com/sidmaz666";

// Database Configuration
$servername = "localhost";
$dbusername = "	id19422441_sidmaz666";
$dbpassword = "1%^x^)Xd^=$=~Yb7";
$dbname = "id19422441_blogz";


global $servername;
global $dbusername ;
global $dbpassword ;
global $dbname ;

// Automatic Creation of essential Database & Table
$connection = new mysqli($servername, $dbusername, $dbpassword);

if ($connection->connect_error) {
    $db_connection = false;
} 


// Create Database
  $dbcreate = "CREATE DATABASE IF NOT EXISTS " . $dbname;

  $connection->query($dbcreate);
    
  $connection = new mysqli($servername, $dbusername, $dbpassword, $dbname);


// Users Table
  $user_table_sql = "CREATE TABLE IF NOT EXISTS users(id int(11) AUTO_INCREMENT,
		        first_name varchar(255) NOT NULL,
		        last_name varchar(255) NOT NULL,
			email varchar(255) NOT NULL,
			username varchar(255) NOT NULL,
                        password varchar(255) NOT NULL,
                        role varchar(255) NOT NULL,
			creation_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY  (ID))";

  $connection->query($user_table_sql);


// Blog Table
  $blog_table_sql = "CREATE TABLE IF NOT EXISTS blogs(id int(11) AUTO_INCREMENT,
		        blog_title varchar(255) NOT NULL,
		        blog_data TEXT NOT NULL,
		        blog_description varchar(255) NULL DEFAULT NULL,
		        blog_category varchar(255) NOT NULL,
		        blog_tags varchar(255) NULL,
			submited_user varchar(255) NOT NULL,
			submited_user_role varchar(255) NOT NULL,
			updated_at DATETIME on update CURRENT_TIMESTAMP NULL DEFAULT NULL,
			last_updated_by varchar(255) NULL DEFAULT NULL,
  			published_at DATETIME NULL DEFAULT NULL,
  			approved_by varchar(255) NULL DEFAULT NULL,
			approved_status varchar(255) NOT NULL,
			blog_image TEXT NULL DEFAULT NULL,
			blog_id varchar(255) NOT NULL,
			creation_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY  (id),
			UNIQUE(id,blog_id)
			)";

  
  $connection->query($blog_table_sql);


// Category Table
  $category_table_sql = "CREATE TABLE IF NOT EXISTS blog_categories(id int(11) AUTO_INCREMENT,
		        category_name varchar(255) NOT NULL,
		        category_description varchar(255) NULL DEFAULT NULL,
			added_by varchar(255) NOT NULL,
			added_at DATETIME NULL DEFAULT NULL,
			creation_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY  (id),
			UNIQUE(id,category_name)
			)";

  
  $connection->query($category_table_sql);


// Tags Table
  $tag_table_sql = "CREATE TABLE IF NOT EXISTS blog_tags(id int(11) AUTO_INCREMENT,
		       	tag_name varchar(255) NOT NULL,
			added_by varchar(255) NOT NULL,
			added_at DATETIME NULL DEFAULT NULL,
			creation_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY  (id),
			UNIQUE(id,tag_name)
			)";

  
  $connection->query($tag_table_sql);

// Comment Table
  $comment_table_sql = "CREATE TABLE IF NOT EXISTS comments(id int(11) AUTO_INCREMENT,
		       	blog_id varchar(255) NOT NULL,
			username varchar(255) NOT NULL,
			email varchar(255) NOT NULL,
			comment TEXT NOT NULL,
			creation_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY  (id),
			UNIQUE(id,email)
			)";

  
  $connection->query($comment_table_sql);

  $db_connection = true;

