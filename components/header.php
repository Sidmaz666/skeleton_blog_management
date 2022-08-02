<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?=$site_title;?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href=<?php if($admin==FALSE){ echo preg_replace('/\?(c|t|a).*/','',$_SERVER['REQUEST_URI'])  == "/".$what_blog."/" ? $site_css_url_normal_home :  $site_css_url_normal_blog;
} else {echo $site_css_url_admin;}?> >
</head>
<body>
