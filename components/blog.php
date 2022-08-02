<a href="/<?=$what_blog;?>">home</a>

<?php 
	include_once 'components/core/blog_.php';

	$get_all_blogs = get_blogs($connection);

	if(isset($_GET['category']) && !empty($_GET['category']) ){
	  $get_all_blogs = get_specific_blogs($connection,'blog_category',$_GET['category']);
	}

	if(isset($_GET['author']) && !empty($_GET['author']) ){
		$get_all_blogs=get_specific_blogs($connection,'submited_user',$_GET['author']);
	}

	if(isset($_GET['tags']) && !empty($_GET['tags']) ){
		$get_all_blogs=get_specific_blogs($connection,'blog_tags',$_GET['tags']);
	}


?>



<div>
<?php
	// CATEGORY SECTION
	$get_categories	= get_category($connection);

?>
CATEGORY SECTION

<?php foreach(json_decode($get_categories) as $cat){ ?>

<span>
<a href="?category=<?=trim($cat->category_name);?>">
<?=$cat->category_name;?>
</a>

</span>

<?php } ?>

</div>




<div>
<?php
	// TAGS SECTION
	$get_tags = get_tags($connection);

?>

TAGS SECTION

<?php foreach(json_decode($get_tags) as $tg){ ?>

<span>
<a href="?tags=<?=trim($tg->tag_name);?>">
<?=$tg->tag_name;?>
</a>

</span>

<?php } ?>

</div>





<?php

//HOME PAGE/MAIN PAGE-> SECTION1
	
	if(!isset($_GET['view_blog'])){

?>

<div>

<b>BLOG SECTION</b>

<?php 
	if($get_all_blogs){
	foreach(json_decode($get_all_blogs) as $blog){
?>

<div>
<span>
<a href="?view_blog=<?=$blog->blog_id;?>">
<?=$blog->blog_title;?>
</a>
</span>
<span>

<span>Description: </span>
<span>
<?=$blog->blog_description;?>
</span>

</span>

<span>

<span>
Category: 
</span>
<span>
<a href="?category=<?=$blog->blog_category;?>">
<?=$blog->blog_category;?>
</a>
</span>

</span>

<span>

<span>
Tags: 
</span>

<span>
<?php
      foreach(explode(",",$blog->blog_tags) as $tags){
?>
<a href="?tags=<?=$tags;?>">
<?=$tags;?>
</a>
<?php } ?>
</span>


<span>
Author: 
</span>

<span>
<a href="?author=<?=$blog->submited_user;?>">
<?=$blog->submited_user;?>
</a>
</span>

</span>


<span>
Published Date: 
</span>

<span>
<?=$blog->published_at;?>
</span>


<hr>


</div>


<?php
	  }
	} else {
?>
<span>
No Post Available!
</span>

<?php
	}


?>
</div>
<?php
	}

//SINGLE BLOG VIEW/SECTION2

	if(isset($_GET['view_blog'])){

	include_once 'components/core/handleComment.php';
	
	$get_this_blog = json_decode(get_this_blog($connection,$_GET['view_blog']));

	foreach($get_this_blog as $blog){

?>

<script id="set_timer_script" defer>
	  document.title = '<?=$blog->blog_title;?>' + ' ~ Blog'
	    setTimeout(()=>{
		document.getElementById('set_timer_script').remove();	
	},400)
</script>

<div>

<div>
<?=$blog->blog_title;?>
</div>

<br>

<div>
<?=$blog->blog_data;?>
</div>

<br>

<div>
<a href="?category=<?=$blog->blog_category;?>">
<?=$blog->blog_category;?>
</a>
</div>


<div>
<?php
      foreach(explode(",",$blog->blog_tags) as $tags){
?>
<a href="?tags=<?=$tags;?>">
<?=$tags;?>
</a>
<?php } ?>
</div>


<div>
<a href="?author=<?=$blog->submited_user;?>">
<?=$blog->submited_user;?>
</a>
</div>

</div>

<br>

<div>

<script src="components/js/handleComment.js" defer></script>

<span>
COMMENT
</span>
<div>
<form action="" method="POST">

<label for="">Email:
<input type="email" id="c_email" required>
</label>

<label for="">Name:
<input type="email" id="c_name" required>
</label>

<label for="">Comment:
<textarea required id="c_comment">
</textarea>
</label>

<button onclick="postComment('<?=$blog->blog_id;?>',document.getElementById('c_email').value,document.getElementById('c_name').value,document.getElementById('c_comment').value)">Submit</button>

</form>

</div>

<br/>

<span>
COMMENTS
</span>

<?php

	  $get_data_query = mysqli_query($connection,"SELECT *, ROW_NUMBER() OVER() AS ROW_NUM FROM comments WHERE blog_id = '$blog->blog_id'");


    $check_existance = mysqli_num_rows($get_data_query);
    if($check_existance > 0){


      while($fetch_all_comments = mysqli_fetch_assoc($get_data_query)){

?>

	<hr>
	<span>
	<?=$fetch_all_comments['username'];?>
	</span>
	<br>
	<span>
	<?=$fetch_all_comments['comment'];?>
	</span>
	<br>
	<span>
	<?=$fetch_all_comments['creation_time'];?>
	</span>
	<hr>
		


<?php

    }

    }


?>

</div>



<?php 
		}
	}
?>

<!-- WIDGET SECTION -->
<div>
<span>
<a href="<?=$widget_github_link;?>">
Github
</a>

</span>
</div>
