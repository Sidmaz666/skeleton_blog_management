<!--
	USING TOM-SELCT TO HANDLE TAGS
-->

<link rel="stylesheet" href="css/tom-select.css">
<script src="js/tom-select.complete.min.js" defer></script>
<script src="js/_Functions.js" defer></script>

<!--
	USING TINYMCE TO HANDLE BLOG
-->

<script src="js/tinymce/tinymce.min.js" defer></script>
<script type="module" src="js/tinymce_config.js" defer></script>


<script src="js/tom-cat_config.js" defer></script>


<?php

include_once 'functions/_Functions.php';
include_once 'functions/get_blogs.php';
include_once 'functions/update_categories.php';
include_once 'functions/update_tags.php';
include_once 'functions/update_blogs.php';

$get_user_data = $_SESSION['user'];

if(isset($_POST['new_blog_submitBtn'])){
  if(
   insertNewBlog(
	  $connection,
	  $_POST['new_blog_title'],
	  $_POST['new_blog_content'],
	  $_POST['new_blog_description'],
	  $_POST['new_blog_category'],
	  $_POST['new_blog_tags'],
	  $_POST['new_blog_image'],
	  $get_user_data['username'],
	  $get_user_data['role']
    )
  ){
    header('Refresh:0');
  } else {
    echo "Unable To Post Blog!";
  }
}


?>

<!-- USER DETAILS -->

<div>
<?="USER:".$get_user_data['username']." ROLE:".$get_user_data['role'];?>
<a href="./logout.php">  logout?</a>
</div>


<!-- 	COMMON SECTION 
	ADD POST
-->

<?php 
if($get_user_data['role'] !== "publisher"){
?>

<div class="p-3">
<h1 class="text-4xl p-2">Add New Post</h1>
<form action="" method="POST">
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Blog Title
</span>
<input type="text" name="new_blog_title" class="border-2 border-gray-700">
</label>
<textarea id="editor" 
name="new_blog_content">

</textarea>
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Blog Description
</span>
<textarea name="new_blog_description" class="border-2 border-gray-700">
</textarea>
</label>
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Category
</span>

<select id="" name="new_blog_category">

<?php

$categories = json_decode(get_categories($connection));

foreach($categories as $cat){

?>

  <option
	 data-category-description=<?=$cat->category_description;?>
	 data-category-added-by=<?=$cat->added_by;?>
	 data-category-added-time=<?=$cat->added_at;?>
	 value=<?=$cat->category_name;?> >

  <?=$cat->category_name;?>
	
  </option>

<?php }  ?>

</select>

</label>
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Tags
</span>


<select 
placeholder="Select a Tag..."
id="select_tags"
name="new_blog_tags[]"
multiple
autocomplete="off"
>

<?php 

  $tag_list = json_decode(get_tags($connection));
  foreach ($tag_list as $tag) {

?>

  <option value=<?=$tag->tag_name;?>  >
  <?=$tag->tag_name;?>
  </option>

<?php } ?>

</select>

</label>
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Cover Image Link
</span>
<input type="text" name="new_blog_image" class="border-2 border-gray-700">
</label>

<button type="submit" name="new_blog_submitBtn">Save</button>
</form>
</div>

<?php } ?>

<!-- 	ADMIN SECTION 
	ADD CATEGORY  
-->

<?php
	if($get_user_data['role'] == "admin"){

	  if(isset($_POST['submit_category'])){
	    if(
	      insertCategory(
	      $connection,
	      strtolower($_POST['new_category_name']),
	      strtolower($_POST['new_category_desc']),
	      $get_user_data['username']) == false
	    ){

	      			echo "Category ALready Exists!";
	    } else {

	      header('Refresh:0');
	      //echo "Category Added";

	    }
	  }
?>

<div>
<h1 class="text-4xl p-2">Add a New Category</h1>
<form action="" method="POST">
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Category Name
</span>
<input type="text" class="border-2 border-gray-700" name="new_category_name">
</label>
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Category Description
</span>
<input type="text" class="border-2 border-gray-700" name="new_category_desc">
</label>
<button type="submit" name="submit_category">Add</button>
</form>
</div>


<!-- 	ADMIN SECTION 
	ADD TAGS
-->

<?php
	  if(isset($_POST['add_new_tag'])){
	     if( insertTags(
		$connection,
		strtolower($_POST['new_tags']),
	        $get_user_data['username']
	     )
	     ){ header('Refresh:0');}else{echo "Unable to Add Tags";}
	 	
	  }

?>

<div>
<h1 class="text-4xl p-2">Add a New Tag</h1>
<form action="" method="POST">
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Tag Name
</span>
<input type="text" class="border-2 border-gray-700" name="new_tags">
</label>
<button name="add_new_tag" type="submit">Add Tag</button>
</form>

</div>

<!--
	ADMIN SECTION
	DELETE/EDIT CATEGORIES
-->

<div>

<h1 class="text-4xl p-2">View/Delete Categories</h1>

<table>
  <tr>
    <th>#No</th>
    <th>Category Name</th>
    <th>Category Description</th>
    <th>Options</th>
  </tr>

<?php
$get_categories = json_decode(get_categories($connection));
foreach($get_categories as $cat){
?>

	<tr>
	<td>
	  <?=$cat->ROW_NUM;?>
	 </td>
	 <td>

	 <div id=<?="category_name_".$cat->id;?> ondblclick="convertDiv2Textarea(this)">

	      <?=$cat->category_name;?>

	    </div>

	</td>
	  <td>
	    <div id=<?="category_description_".$cat->id;?> ondblclick="convertDiv2Textarea(this)" >

		<?=$cat->category_description;?>

	  </div>
	</td>
	<td>
	<button onclick="delete_category(<?=$cat->id;?>,'<?=$cat->category_name;?>')">DELETE</button>
	<button 
	onclick="update_category(
	 <?=$cat->id;?>,
	 document.getElementById('category_name_<?=$cat->id;?>').textContent,
	 document.getElementById('category_description_<?=$cat->id;?>').textContent
	)" 		
	>
	UPDATE</button>
	</td>
	</tr>

<?php }  ?>

</table>

</div>

<!--
	ADMIN SECTION
	DELETE/EDIT TAGS
-->

<div>
<h1 class="text-4xl p-2">View/Delete Tags</h1>

<table>
  <tr>
    <th>#No</th>
    <th>Tag Name</th>
    <th>Options</th>
  </tr>

<?php
$get_tags = json_decode(get_tags($connection));
foreach($get_tags as $tag){
?>

	<tr>
	<td>
	  <?=$tag->ROW_NUM;?>
	 </td>
	 <td>
	 <div id=<?="tag_name_".$tag->id;?> ondblclick="convertDiv2Textarea(this)">
	  <?=$tag->tag_name;?>
	</div>
	</td>
	<td>
	<button onclick="delete_tag(<?=$tag->id;?>,'<?=$tag->tag_name;?>')">DELETE</button>
	<button 
	onclick="update_tag(
	 <?=$tag->id;?>,
	 document.getElementById('tag_name_<?=$tag->id;?>').textContent
	)" 		
	>
	UPDATE</button>
	</td>
	</tr>

<?php }  ?>

</table>

</div>

<?php } ?>

<!--
	PUBLISHER/ADMIN SECTION
	VIEW/DELETE/EDIT/APPROVE BLOG
-->

<?php 
	  if(
	    $get_user_data["role"] == "admin" ||
	    $get_user_data['role'] == "publisher"
	  )
	  {




?>





<div>
<h1 class="text-4xl p-2">
	VIEW/DELETE/EDIT/APPROVE BLOG
</h1>

<!-- EDIT SPECIFIC BLOG SECTION -->

<?php

	    if(isset($fetch_blog)){
	    $get_blog = json_decode($fetch_blog);
	    foreach($get_blog as $blog){

?>

<form action="" method="POST">
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Blog Title
</span>
<input type="text" name="edit_blog_title" class="border-2 border-gray-700"
value='<?=$blog->blog_title;?>'
>
</label>
<textarea id="editor_" 
name="edit_blog_content">
 <?=$blog->blog_data;?>
</textarea>
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Blog Description
</span>
<textarea name="edit_blog_description" class="border-2 border-gray-700">

 <?=preg_replace('/[\n]+/','',$blog->blog_description);?>

</textarea>
</label>
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Category
</span>

<select id="" name="edit_blog_category">

<?php

$categories = json_decode(get_categories($connection));

foreach($categories as $cat){

?>

  <option
	 data-category-description='<?=$cat->category_description;?>'
	 data-category-added-by='<?=$cat->added_by;?>'
	 data-category-added-time='<?=$cat->added_at;?>'
	 value='<?=preg_replace('/\s+/','',$cat->category_name);?>'
	
		<?php
	
  		echo preg_replace('/\s+/','',$cat->category_name) === preg_replace('/\s+/','',$blog->blog_category) ? 'selected' : '';
	
		?>

 >

  <?=$cat->category_name;?>
	
  </option>

<?php }  ?>

</select>

</label>
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Tags
</span>


<select 
placeholder="Select a Tag..."
id="edit_select_tags"
name="edit_blog_tags[]"
multiple
autocomplete="off"
>

<?php 

  $tag_list = json_decode(get_tags($connection));
  foreach ($tag_list as $tag) {

?>

  <option value='<?=$tag->tag_name;?>'
<?php
      $tag_n = $tag->tag_name;
      if(preg_match("/\b$tag_n\b/i",$blog->blog_tags)){
      echo ' selected ';
      } 
	?>
 >
  <?=$tag->tag_name;?>
  </option>

<?php } ?>

</select>

</label>
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Cover Image Link
</span>
<input type="text" name="edit_blog_image" class="border-2 border-gray-700"
value=<?=$blog->blog_image;?>
>
</label>

<input type="hidden" name="edit_blog_id" value='<?=$blog->blog_id;?>'>
<input type="hidden" name="edit_blog_user" value='<?=$get_user_data['username'];?>'>
<input type="hidden" name="edit_blog_user_role" value='<?=$get_user_data['role'];?>'>

<button type="submit" name="edit_blog_submitBtn">Save</button>


</form>
</div>

<?php
	    }}
?>




<!-- BLOG LIST SECTION -->

<table>
  <tr>
    <th>#No</th>
    <th>Blog Name</th>
    <th>Blog Description</th>
    <th>Blog Category</th>
    <th>Blog Tags</th>
    <th>Blog Author</th>
    <th>Approved Status</th>
    <th>Blog Image</th>
    <th>Last Edited</th>
    <th>Options</th>
  </tr>

<?php
$get_blogs = json_decode(get_all_blog($connection));
foreach($get_blogs as $blog){
?>

	<tr>
	<td>
	  <?=$blog->ROW_NUM;?>
	 </td>
	 <td>
	  <?=$blog->blog_title;?>
	</td>
	 <td>
	  <?=$blog->blog_description;?>
	</td>
	 <td>
	  <?=$blog->blog_category;?>
	</td>
	 <td>
	  <?=$blog->blog_tags;?>
	</td>
	 <td>
	  <?=$blog->submited_user;?>
	</td>
	 <td>
	  <?=$blog->approved_status;?>
	</td>
	 <td>
	  <img src=<?=$blog->blog_image;?> >
	</td>
	 <td>
	  <?php
	  if($blog->updated_at == NULL){
	    echo $blog->creation_time;	
	  } else {
	    echo $blog->updated_at;
	  }
	?>
	</td>
	<td>
	<button onclick="edit_blog('<?=$blog->blog_id;?>','<?=$get_user_data['username'];?>','<?=$get_user_data['role'];?>')">EDIT</button>
	<!-- APPROVE -->
	<?php
  	if($blog->approved_status == "FALSE")
	{ ?>
	
	<button onclick="publish_blog('<?=$blog->blog_id;?>','<?=$get_user_data['username'];?>','<?=$get_user_data['role'];?>','TRUE')">PUBLISH</button>

	<?php
	} else {
	?>

	<button onclick="publish_blog('<?=$blog->blog_id;?>','<?=$get_user_data['username'];?>','<?=$get_user_data['role'];?>','FALSE')">UNPUBLISH</button>

	<?php
	} 
	?>

	  <button onclick="delete_blog('<?=$blog->blog_id;?>')">DELETE</button>
	</td>
	</tr>

<?php }  ?>

</table>



</div>

<?php }?>



