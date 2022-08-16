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

<div class="
flex
w-full
text-white
bg-black
text-xl
p-2
justify-between
items-center
">

<span
>
<?="
<span
>
User : 
<span
class='
text-red-600
capitalize
'
>".$get_user_data['username']." 
</span>
</span>
<span>
Role : 
<span
class='capitalize
  text-yellow-300
  '
>
  ".$get_user_data['role']."
</span>
</span>
";?>
 

</span>

<div>
<a 
class="
capitalize
p-1
font-semibold
text-[#00C853]
"
href="<?=str_replace('/admin','',$_SERVER['REQUEST_URI']);?>"> Visit Site</a>
<a 
class="
capitalize
p-1 bg-white text-black font-semibold
rounded-md
"
href="./logout.php">  logout?</a>
</div>
</div>


<!-- 	COMMON SECTION 
	ADD POST
-->

<?php 
if($get_user_data['role'] !== "publisher"){
?>
 

<h1 class="text-4xl font-bold p-2 mt-5">Add New Post</h1>
<div class="p-3 hidden" id="add_new_blog_div">
<form action="" method="POST">
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Blog Title
</span>
<input type="text" name="new_blog_title" class="border-2 border-gray-700 p-2"
placeholder="Add BLog Title" value="Untitled" onclick="this.value=''"
>
</label>
<textarea id="editor" 
name="new_blog_content"
minlength="20"
>


</textarea>
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Blog Description
</span>
<textarea name="new_blog_description" class="border-2 border-gray-700
p-2
"
placeholder="Add Blog Description"
maxlength="250"
minlength="10"
>
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
<input type="url" 
class="p-2 border-2 border-black"
placeholder="Add Blog Cover"
name="new_blog_image" class="border-2 border-gray-700">
</label>

<div
class="
flex
justify-center
items-center
w-full
"
>
<button 
class="
p-2
text-2xl
w-full
m-5
flex
text-white
font-semibold
bg-black
justify-center
"
type="submit" name="new_blog_submitBtn">Post</button>
</div>
</form>
</div>


<div
class="
flex
justify-center
items-center
m-5
"
>
<button
class="
p-2
text-6xl
font-bold
font-mono
flex
justify-center
items-center
w-full
bg-gray-300
rounded-md
shadow-md
"
onclick="
document.getElementById('add_new_blog_div').classList.toggle('hidden')
this.innerText == '+' ? this.innerText = '-' : this.innerText = '+'
"
>+</button>
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



<h1 class="text-4xl p-2 font-bold">Add a New Category</h1>
<div id="add_category_div" class="p-2  hidden">
<form action="" method="POST">
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Category Name
</span>
<input type="text" class="border-2 border-gray-700 p-2"
placeholder="Add Category Name"
maxlength="250"
minlength="3"
 name="new_category_name">
</label>
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Category Description
</span>
<input type="text" class="border-2 p-2 border-gray-700"
placeholder="Add Category Details"
maxlength="250"
minlength="10"
 name="new_category_desc">
</label>
<div
class="
flex
justify-center
items-center
w-full
"
>
<button 
class="
p-2
text-2xl
w-full
m-5
flex
text-white
font-semibold
bg-black
justify-center
"
 type="submit" name="submit_category">Add</button>
</div>
</form>
</div>


<div
class="
flex
justify-center
items-center
m-5
"
>
<button
class="
p-2
text-6xl
font-bold
font-mono
flex
justify-center
items-center
w-full
bg-gray-300
rounded-md
shadow-md
"
onclick="
document.getElementById('add_category_div').classList.toggle('hidden')
this.innerText == '+' ? this.innerText = '-' : this.innerText = '+'
"
>+</button>
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

<h1 class="text-4xl p-2 font-bold">Add a New Tag</h1>
<div class="p-2 hidden" id="add_tag_div">
<form action="" method="POST">
<label
class="text-3xl text-gray-800 font-semibold p-2 m-5 flex flex-col"
 for="">
<span class="p-3">
Tag Name
</span>
<input type="text" class="border-2 p-2 border-gray-700"
placeholder="Add Tags (Tag1,Tag2..)"
 name="new_tags">
</label>

<div
class="
flex
justify-center
items-center
w-full
"
>
<button 
class="
p-2
text-2xl
w-full
m-5
flex
text-white
font-semibold
bg-black
justify-center
"
name="add_new_tag" type="submit">Add Tag</button>

</div>

</form>
</div>


<div
class="
flex
justify-center
items-center
m-5
"
>
<button
class="
p-2
text-6xl
font-bold
font-mono
flex
justify-center
items-center
w-full
bg-gray-300
rounded-md
shadow-md
"
onclick="
document.getElementById('add_tag_div').classList.toggle('hidden')
this.innerText == '+' ? this.innerText = '-' : this.innerText = '+'
"
>+</button>
</div>


<!--
	ADMIN SECTION
	DELETE/EDIT CATEGORIES
-->

<div class="
p-2
hidden
"
id="category_list_div"
>

<table
class="
m-2
w-full
text-xl
"
>
  <tr
class="
bg-black
text-white
text-2xl
p-2
"
	>
    <th
class="
p-2
border-2
"
	>#No</th>
    <th
class="
p-2
border-2
"
	>Category Name</th>
    <th
class="
p-2
border-2
"
	>Category Description</th>
    <th
class="
p-2
border-2
"
	>Options</th>
  </tr>

<?php
$get_categories = json_decode(get_categories($connection));
foreach($get_categories as $cat){
?>

	<tr
      class="
      text-xl
      text-white
      p-2
	bg-[#263238]
      "
>
	<td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
	>
	  <?=$cat->ROW_NUM;?>
	 </td>
	 <td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>

	 <div id=<?="category_name_".$cat->id;?> ondblclick="convertDiv2Textarea(this)">

	      <?=$cat->category_name;?>

	    </div>

	</td>
	  <td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
	>
	    <div id=<?="category_description_".$cat->id;?> ondblclick="convertDiv2Textarea(this)" >

		<?=$cat->category_description;?>

	  </div>
	</td>
	<td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
	>
	
<button 
class="
p-1
bg-white
text-black
rounded-full
"
onclick="delete_category(<?=$cat->id;?>,'<?=$cat->category_name;?>')">
Delete</button>


	<button 
	class="
	p-1
	bg-white
	text-black
	rounded-full
	mt-2
	md:mt-0
	"
	onclick="update_category(
	 <?=$cat->id;?>,
	 document.getElementById('category_name_<?=$cat->id;?>').textContent,
	 document.getElementById('category_description_<?=$cat->id;?>').textContent
	)" 		
	>
	Update</button>
	</td>
	</tr>

<?php }  ?>

</table>

</div>


<div
class="
flex
justify-center
items-center
m-5
"
>
<button
class="
p-2
text-3xl
font-bold
font-mono
flex
justify-center
items-center
w-full
bg-gray-300
rounded-md
shadow-md
"
onclick="
document.getElementById('category_list_div').classList.toggle('hidden')
this.innerText == 'View Category List' ? this.innerText = 'Hide Category List' : this.innerText = 'View Category List'
"
>View Category List</button>
</div>

<!--
	ADMIN SECTION
	DELETE/EDIT TAGS
-->

<div
class="p-2 hidden"
id="tag_list_div"
>

<table
class="
m-2
w-full
text-xl
"
>
  <tr
class="
bg-black
text-white
text-2xl
p-2
"
>
    <th
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>#No</th>
    <th
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>Tag Name</th>
    <th
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>Options</th>
  </tr>

<?php
$get_tags = json_decode(get_tags($connection));
foreach($get_tags as $tag){
?>

	<tr
class="
bg-[#263238]
text-white
text-xl
p-2
"
>
	<td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>
	  <?=$tag->ROW_NUM;?>
	 </td>
	 <td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>
	 <div id=<?="tag_name_".$tag->id;?> ondblclick="convertDiv2Textarea(this)">
	  <?=$tag->tag_name;?>
	</div>
	</td>
	<td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>
	<button 
class="
p-1
bg-white
text-black
rounded-full
"
onclick="delete_tag(<?=$tag->id;?>,'<?=$tag->tag_name;?>')">DELETE</button>

	<button 
	class="
	p-1
	bg-white
	text-black
	rounded-full
	mt-2
	md:mt-0
	"
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


<div
class="
flex
justify-center
items-center
m-5
"
>
<button
class="
p-2
text-3xl
font-bold
font-mono
flex
justify-center
items-center
w-full
bg-gray-300
rounded-md
shadow-md
"
onclick="
document.getElementById('tag_list_div').classList.toggle('hidden')
this.innerText == 'View Tag List' ? this.innerText = 'Hide Tag List' : this.innerText = 'View Tag List'
"
>View Tag List</button>
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
value='<?=$blog->blog_image;?>'

onclick="this.value=''"
>
</label>

<input type="hidden" name="edit_blog_id" value='<?=$blog->blog_id;?>'>
<input type="hidden" name="edit_blog_user" value='<?=$get_user_data['username'];?>'>
<input type="hidden" name="edit_blog_user_role" value='<?=$get_user_data['role'];?>'>


<div
class="
flex
justify-center
items-center
w-full
"
>
<button 
class="
p-2
text-2xl
w-full
m-5
flex
text-white
font-semibold
bg-black
justify-center
"
 type="submit" name="edit_blog_submitBtn">Update</button>
</div>


</form>
</div>

<?php
	    }}
?>




<!-- BLOG LIST SECTION -->

<div
class="
p-2
hidden
"
id="blog_list_div"
>

<table
class="
m-2
w-full
text-xl
"
>
  <tr
class="
bg-black
text-white
text-2xl
p-2
"
>
    <th
	class="
	p-2
	font-bold
	text-center
	border-2
	"
	>#No</th>
    <th
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>Blog Name</th>
    <th
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>Blog Description</th>
    <th
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>Blog Category</th>
    <th
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>Blog Tags</th>
    <th
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>Blog Author</th>
    <th
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>Approved Status</th>
    <th
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>Blog Image</th>
    <th
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>Last Edited</th>
    <th
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>Options</th>
  </tr>

<?php
$get_blogs = json_decode(get_all_blog($connection));
foreach($get_blogs as $blog){
?>

	<tr
      class="
      bg-[#263238]
      text-white
      text-xl
      p-2
      "
>
	<td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>
	  <?=$blog->ROW_NUM;?>
	 </td>
	 <td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>
	  <?=$blog->blog_title;?>
	</td>
	 <td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>
	  <?=$blog->blog_description;?>
	</td>
	 <td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>
	  <?=$blog->blog_category;?>
	</td>
	 <td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>
	  <?=$blog->blog_tags;?>
	</td>
	 <td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>
	  <?=$blog->submited_user;?>
	</td>
	 <td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>
	  <?=$blog->approved_status;?>
	</td>
	 <td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>
	  <img
	 style="
		object-fit: scale-down;
		width: 800px;
		height: 200px;
	"
	 src=<?=$blog->blog_image;?> >
	</td>
	 <td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>
	  <?php
	  if($blog->updated_at == NULL){
	    echo $blog->creation_time;	
	  } else {
	    echo $blog->updated_at;
	  }
	?>
	</td>
	<td
	class="
	p-2
	font-bold
	text-center
	border-2
	"
>
	<button 
	class="
	p-1
	bg-white
	text-black
	rounded-full
	"
onclick="edit_blog('<?=$blog->blog_id;?>','<?=$get_user_data['username'];?>','<?=$get_user_data['role'];?>')">EDIT</button>
	<!-- APPROVE -->
	<?php
  	if($blog->approved_status == "FALSE")
	{ ?>
	
	<button
	class="
	p-1
	bg-white
	text-black
	rounded-full
	mt-2
	md:mt-0
	"
 onclick="publish_blog('<?=$blog->blog_id;?>','<?=$get_user_data['username'];?>','<?=$get_user_data['role'];?>','TRUE')">PUBLISH</button>

	<?php
	} else {
	?>

	<button
	class="
	p-1
	bg-white
	text-black
	rounded-full
	mt-2
	md:mt-0
	"
 onclick="publish_blog('<?=$blog->blog_id;?>','<?=$get_user_data['username'];?>','<?=$get_user_data['role'];?>','FALSE')">UNPUBLISH</button>

	<?php
	} 
	?>

	  <button
	class="
	p-1
	bg-white
	text-black
	rounded-full
	mt-2
	md:mt-0
	"
 onclick="delete_blog('<?=$blog->blog_id;?>')">DELETE</button>
	</td>
	</tr>

<?php }  ?>

</table>

</div>


<div
class="
flex
justify-center
items-center
m-5
"
>
<button
class="
p-2
text-3xl
font-bold
font-mono
flex
justify-center
items-center
w-full
bg-gray-300
rounded-md
shadow-md
"
onclick="
document.getElementById('blog_list_div').classList.toggle('hidden')
this.innerText == 'View Blogs' ? this.innerText = 'Hide Blogs' : this.innerText = 'View Blogs'
"
>View Blogs</button>
</div>

</div>

<br>
<br>
<br>
<br>
<br>

<?php }?>



